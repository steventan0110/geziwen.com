<?php

namespace App\Http\Controllers;

use App\Agency\Teacher;
use App\Http\Requests\TeacherStoreRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Agency\Agency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgencyTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $agency)
    {
        $agency = Agency::find($agency);
        $teachers = $agency->teachers()->paginate(6);
        return view('teacher.index', ['teachers'=>$teachers,'agency'=>$agency]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $agencyId)
    {
        $agency = Agency::findOrFail($agencyId);
        try {
            $this->authorize('create', Teacher::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        if (Auth::user()->role === 'geziwen') {
            if ($agency->manager->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接'.$request->url().'属于恶意操作，请不要再尝试！');
            } else {
                return view('teacher.create_and_edit', ['agency' => $agency]);
            }
        } else if (Auth::user()->role == 'agency') {
            if ($agency->user->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接' . $request->url() . '属于恶意操作，请不要再尝试！');
            }
            return view('teacher.create_and_edit', ['agency' => $agency]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request, $agency_id)
    {
        $data = $request->validated();
        $teacher = new Teacher($data['teacher']);
        if ($request->hasFile('picture')) {
            if ($teacher->picture !== 'teachers/default_teacher.gif') {
                Storage::disk('local')->delete($teacher->picture);
            }
            $picture = $request->file('picture')->storePublicly('teachers', 'local');
            $teacher->picture = $picture;
        }
        else {
            $teacher->picture = 'teachers/default_teacher.gif';
        }
        $teacher->agency_id = $agency_id;
        $teacher->save();
        return redirect('home')
            ->with('type', 'success')
            ->with('title', '添加成功！')
            ->with('details', '您已添加'.$teacher->name.'老师。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$agency_id,$teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        $teacher->applicants = $teacher->applicants()->limit(5)->get();
        return view('teacher.show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $agency_id, $teacher_id)
    {
        $agency = Agency::findOrFail($agency_id);
        $teacher = Teacher::findOrFail($teacher_id);
        try{
            $this->authorize('update', $teacher);
        } catch (AuthorizationException $exception){
            return redirect()->back();
        }
        if (Auth::user()->role == 'geziwen') {
            if (Auth::user()->id != $agency->manager->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接' . $request->url() . '属于恶意操作，请勿再尝试！');
            } else {
                return view('teacher.create_and_edit', ['teacher' => $teacher]);
            }
        } else if (Auth::user()->role == 'agency') {
            if ($agency->user->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接' . $request->url() . '属于恶意操作，请勿再尝试！');
            } else {
                return view('teacher.create_and_edit', ['teacher' => $teacher]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherStoreRequest $request, $agency_id, $teacher_id)
    {
        $data = $request->validated();
        $teacher = Teacher::find($teacher_id);
        if ($request->hasFile('picture')) {
            if ($teacher->picture !== 'teachers/default_teacher.gif') {
                Storage::disk('local')->delete($teacher->picture);
            }
            $picture = $request->file('picture')->storePublicly('teachers', 'local');
            $teacher->picture = $picture;
            $teacher->save();
        }
//        $data['teacher']['picture'] = $picture;
        $teacher->update($data['teacher']);

        return redirect()->route('home')
            ->with('type', 'success')
            ->with('title','修改成功！')
            ->with('detail','您已修改'.$teacher->name.'老师的个人信息。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($agency_id,$teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        try{
            $this->authorize('update', $teacher);
        } catch (AuthorizationException $exception){
            return redirect()->back();
        }
        $teacher->delete();
        return redirect()->back()
            ->with('type', 'success')
            ->with('title','删除成功！')
            ->with('detail','您已删除'.$teacher->name.'老师的所有信息。');
    }
}
