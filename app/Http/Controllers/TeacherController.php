<?php

namespace App\Http\Controllers;

use App\Agency\Teacher;
use App\Http\Requests\TeacherStoreRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Controllers\Controller;
use App\Agency\Agency;
use App\User;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $agency_id)
    {
        $agency = Agency::find($agency_id);
        $teachers = $agency->teachers()->paginate(6);
        return view('teacher.index', ['teachers'=>$teachers,'agency'=>$agency]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($agency_id)
    {
        $agency = Agency::findOrFail($agency_id);
        try{
            $this->authorize('create', Teacher::class);
        }catch(AuthorizationException $exception){
            return redirect()->back();}
         return view('teacher.create_and_edit',['agency' => $agency]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request,$agency_id)
    {
        $data=$request->validated();
        $teacher = new Teacher($data['teacher']);
        $teacher-> agency_id = $agency_id;
        $teacher-> picture = 'images/default.gif';
        $teacher->save();
        return redirect('/home')->with('success','添加成功！')->with('details','您已添加'.$teacher->name.'老师。');


        //
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
        return view('teacher.show', ['teacher' => $teacher]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($agency_id, $teacher_id)
    {
       $teacher = Teacher::findorFail($teacher_id);
       try{
           $this->authorize('update', $teacher);
       } catch (AuthorizationException $exception){
           return redirect()->back();
       }
       return view('teacher.create_and_edit', ['teacher' => $teacher]);
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
        Teacher::find($teacher_id)->update($data['teacher']);
        $teacher = Teacher::find($teacher_id);
        return redirect()->route('home')->with('success','修改成功！')->with('details','您已修改'.$teacher->name.'老师的个人信息。');
        //
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
        $teacher -> delete();
        return redirect()->back()->with('success','删除成功！')->with('details','您已删除'.$teacher->name.'老师的所有信息。');


        //
    }
}
