<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Agency;
use App\Agency\Service\Plan;
use App\Applicant\ActivityType;
use App\Applicant\Applicant;
use App\Application\University;
use App\Http\Requests\ApplicantCreateRequest;
use App\Http\Requests\ApplicantUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $agency_id)
    {
        $agency = Agency::find($agency_id);
        $applicants = $agency->applicants()->paginate(15);
        return view('applicant.index', [
            'applicants' => $applicants,
            'agency' => $agency
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->authorize('create', Applicant::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        $agency = \Auth::user()->agency;
        return view('applicant.create', [
            'agency' => $agency,
            'activity_types' => ActivityType::all(),
            'universities' => University::all(),
            'plans' => \App\Application\Plan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantCreateRequest $request)
    {
        try {
            $this->authorize('create', Applicant::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        $data = $request->validated();
        $plan = Plan::find($request['applicant']['plan']);
        $applicant = $plan->applicants()->create($data['applicant']);
        $applicant->exams()->createMany(array_key_exists('exams', $data) ? $data['exams'] : []);
        if ($data['applicant_type'] === 'standard') {
            $applicant->activities()->createMany(array_key_exists('activities', $data) ? $data['activities'] : []);
            $applicant->awards()->createMany(array_key_exists('awards', $data) ? $data['awards'] : []);
            $applicant->offers()->createMany(array_key_exists('offers', $data) ? $data['offers'] : []);
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($agency_id, $applicant_id)
    {
        $applicant = Applicant::find($applicant_id);
        try {
            $this->authorize('view', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        return view('applicant.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($agency_id, $applicant_id)
    {
        $applicant = Applicant::find($applicant_id);
        try {
            $this->authorize('update', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        return view('applicant.edit', [
            'applicant' => $applicant,
            'agency' => $applicant->plan->agency
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicantUpdateRequest $request, $agency_id, $applicant_id)
    {
        $applicant = Applicant::find($applicant_id);
        $data = $request->validated();
        try {
            $this->authorize('update', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->route('home');
        }
        $applicant->update($data['applicant']);
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $agency_id, $applicant_id)
    {
        $applicant = Applicant::find($applicant_id);
        try {
            $this->authorize('delete', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        $applicant->delete();
        return redirect()->back();
    }
}
