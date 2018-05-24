<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Agency;
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
        return view('agency.index', ['agencies' => $agencies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $agency = new Agency($data);
        $agency->verified = false;
        $agency->logo = 'images/default.gif';
        $agency->save();
        return view('agency.applied', compact('agency'));
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
        return view('agency.edit', compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::findOrFail($id);
        $agency->name = $request->get('name');
        $agency->introduction = $request->get('introduction');
        $agency->address = $request->get('address');
        $agency->telephone = $request->get('telephone');
        $agency->website = $request->get('website');
        $agency->email = $request->get('email');
        $agency->started_on = $request->get('started_on');
        $agency->save();
        return view('agency.show', compact('agency'));
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
