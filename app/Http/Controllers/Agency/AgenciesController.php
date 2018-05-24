<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Agency;
use App\Http\Requests\AgencyCreateRequest;
use App\Http\Requests\AgencyInviteRequest;
use App\Http\Requests\AgencyStoreRequest;
use App\Http\Requests\AgencyUpdateRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();
        $array = ['id' => 1, 'id2' => 2];
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
    public function store(AgencyUpdateRequest $request)
    {
        $data = $request->validated();
        $agency = new Agency($data['agency']);
        $agency->verified = false;
        $agency->published = false;
        $agency->logo = 'images/default.gif';
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
        Agency::find($id)->update($data['agency']);
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
