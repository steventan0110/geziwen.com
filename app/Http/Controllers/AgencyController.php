<?php

namespace App\Http\Controllers;

use App\Agency\Agency;
use App\Http\Requests\AgencyCreateRequest;
use App\Http\Requests\AgencyUpdateRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();
        return view('agency.index', ['agencies' => $agencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->authorize('create', Agency::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        return view('agency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyCreateRequest $request)
    {
        $data = $request->validated();
        $agency = new Agency($data['agency']);
        $agency->verified = false;
        $agency->published = false;
        $agency->logo = 'logos/default.gif';
        $agency->thumbnail = 'thumbnails/default.svg';
        $agency->manager_id = \Auth::user()->id;
        $agency->save();
        $user = new User([
            'name' => $agency->name,
            'email' => $agency->email,
            'password' => bcrypt('secret'),
            'role' => 'agency',
            'link' => $agency->id
        ]);
        $user->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = Agency::findOrFail($id);
        $agency->applicants = $agency->applicants()->limit(5)->get();
        $agency->teachers = $agency->teachers()->limit(6)->get();
        return view('agency.show', compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::findOrFail($id);
        try {
            $this->authorize('update', $agency);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        return view('agency.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $agency = Agency::find($id);
        try {
            $this->authorize('update', $agency);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        $agency->update($data['agency']);
        if ($request->hasFile('logo')) {
            if ($agency->logo !== 'logos/default.gif') {
                Storage::disk('local')->delete($agency->logo);
            }
            $agency->logo = $request->file('logo')->storePublicly('logos', 'local');
        }
        if ($request->hasFile('thumbnail')) {
            if ($agency->thumbnail !== 'thumbnails/default.svg') {
                Storage::disk('local')->delete($agency->thumbnail);
            }
            $agency->thumbnail = $request->file('thumbnail')->storePublicly('thumbnails', 'local');
        }
        $agency->update();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
