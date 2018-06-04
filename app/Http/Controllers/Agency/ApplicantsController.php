<?php

namespace App\Http\Controllers\Agency;

use App\Agency\Agency;
use App\Agency\Service\Plan;
use App\Applicant\Activity;
use App\Applicant\ActivityType;
use App\Applicant\Applicant;
use App\Applicant\Award;
use App\Applicant\Exam;
use App\Application\Offer;
use App\Application\University;
use App\Http\Requests\ApplicantStoreRequest;
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
        return view('applicant.create_and_edit', [
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
    public function store(ApplicantStoreRequest $request)
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
        return view('applicant.create_and_edit', [
            'applicant' => $applicant,
            'agency' => $applicant->plan->agency,
            'activity_types' => ActivityType::all(),
            'universities' => University::all(),
            'plans' => \App\Application\Plan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApplicantStoreRequest $request, $agency_id, $applicant_id)
    {
        // User privilege check
        $applicant = Applicant::find($applicant_id);
        try {
            $this->authorize('update', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->route('home');
        }
        $data = $request->validated();
        // Update Applicant Basic Information
        $applicant->update($data['applicant']);
        // Exams
        // Diff exams that got deleted and destroy them in database.
        $originalExamIds = [];
        $newExamIds = [];
        foreach ($applicant->exams as $exam) {
            array_push($originalExamIds, $exam->id);
        }
        foreach ($data['exams'] as $exam) {
            array_push($newExamIds, $exam['id']);
        }
        Exam::destroy(collect($originalExamIds)->diff($newExamIds)->all());
        // Update or create exams that did not get deleted.
        foreach ($data['exams'] as $examData) {
            $exam = Exam::updateOrCreate(['id' => $examData['id']], $examData);
        }
        if ($data['applicant_type'] === 'standard') {
            // Activities
            // Diff activities that got deleted and destroy them in database.
            $originalActivityIds = [];
            $newActivityIds = [];
            foreach ($applicant->activities as $activity) {
                array_push($originalActivityIds, $activity->id);
            }
            foreach ($data['activities'] as $activity) {
                array_push($newActivityIds, $activity['id']);
            }
            Activity::destroy(collect($originalActivityIds)->diff($newActivityIds)->all());
            // Update or create activities that did not get deleted.
            foreach ($data['activities'] as $activityData) {
                $activity = Activity::updateOrCreate(['id' => $activityData['id']], $activityData);
            }
            // Awards
            // Diff awards that got deleted and destroy them in database.
            $originalAwardIds = [];
            $newAwardIds = [];
            foreach ($applicant->awards as $award) {
                array_push($originalAwardIds, $award->id);
            }
            foreach ($data['awards'] as $activity) {
                array_push($newAwardIds, $award['id']);
            }
            Award::destroy(collect($originalAwardIds)->diff($newAwardIds)->all());
            // Update or create awards that did not get deleted.
            foreach ($data['awards'] as $awardData) {
                $award = Award::updateOrCreate(['id' => $awardData['id']], $awardData);
            }
            // Offers
            $originalOfferIds = [];
            $newOfferIds = [];
            foreach ($applicant->offers as $offer) {
                array_push($originalOfferIds, $offer->id);
            }
            foreach ($data['offers'] as $activity) {
                array_push($newOfferIds, $offer['id']);
            }
            Offer::destroy(collect($originalOfferIds)->diff($newOfferIds)->all());
            // Update or create awards that did not get deleted.
            foreach ($data['offers'] as $offerData) {
                $offer = Offer::updateOrCreate(['id' => $offerData['id']], $offerData);
            }
        }
        return redirect()->route('home');
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
