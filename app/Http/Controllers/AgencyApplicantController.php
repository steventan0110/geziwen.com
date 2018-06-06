<?php

namespace App\Http\Controllers;

use Auth;
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

class AgencyApplicantController extends Controller
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
    public function create(Request $request, $agencyId)
    {
        $agency = Agency::find($agencyId);
        try {
            $this->authorize('create', Applicant::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back()
                ->with('type', 'danger')
                ->with('title', '您无权访问该链接！')
                ->with('detail', '访问链接'.$request->url().'属于恶意操作，请勿再尝试！');
        }
        if (Auth::user()->role === 'geziwen') {
            if ($agency->manager->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接'.$request->url().'属于恶意操作，请勿再尝试！');
            } else {
                return view('applicant.create_and_edit', [
                    'agency' => $agency,
                    'activity_types' => ActivityType::all()
                ]);
            }
        } else if (Auth::user()->role == 'agency') {
            if ($agency->user->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接'.$request->url().'属于恶意操作，请勿再尝试！');
            } else {
                return view('applicant.create_and_edit', [
                    'agency' => $agency,
                    'activity_types' => ActivityType::all()
                ]);
            }
        }
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
        return redirect('home');
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
    public function edit(Request $request, $agencyId, $applicantId) {
        $agency = Agency::find($agencyId);
        $applicant = Applicant::find($applicantId);
        try {
            $this->authorize('update', $applicant);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        if (Auth::user()->role == 'geziwen') {
            if (Auth::user()->id != $agency->manager->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接' . $request->url() . '属于恶意操作，请勿再尝试！');
            } else {
                return view('applicant.create_and_edit', [
                    'applicant' => $applicant,
                    'agency' => $applicant->plan->agency,
                    'activity_types' => ActivityType::all(),
                    'universities' => University::all(),
                    'plans' => \App\Application\Plan::all()
                ]);
            }
        } else if (Auth::user()->role == 'agency') {
            if ($agency->user->id != Auth::user()->id) {
                return redirect('home')
                    ->with('type', 'danger')
                    ->with('title', '您无权访问该链接！')
                    ->with('detail', '访问链接' . $request->url() . '属于恶意操作，请勿再尝试！');
            } else {
                return view('applicant.create_and_edit', [
                    'applicant' => $applicant,
                    'agency' => $applicant->plan->agency,
                    'activity_types' => ActivityType::all(),
                    'universities' => University::all(),
                    'plans' => \App\Application\Plan::all()
                ]);
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
        if (array_key_exists('exams', $data)) {
            foreach ($data['exams'] as $exam) {
                array_push($newExamIds, $exam['id']);
            }
        }
        Exam::destroy(collect($originalExamIds)->diff($newExamIds)->all());
        // Update or create exams that did not get deleted.
        if (array_key_exists('exams', $data)) {
            foreach ($data['exams'] as $examData) {
                $exam = Exam::updateOrCreate(['id' => $examData['id']], $examData);
            }
        }
        if ($data['applicant_type'] === 'standard') {
            // Activities
            // Diff activities that got deleted and destroy them in database.
            $originalActivityIds = [];
            $newActivityIds = [];
            foreach ($applicant->activities as $activity) {
                array_push($originalActivityIds, $activity->id);
            }
            if (array_key_exists('activities', $data)) {
                foreach ($data['activities'] as $activity) {
                    array_push($newActivityIds, $activity['id']);
                }
            }
            Activity::destroy(collect($originalActivityIds)->diff($newActivityIds)->all());
            // Update or create activities that did not get deleted.
            if (array_key_exists('activities', $data)) {
                foreach ($data['activities'] as $activityData) {
                    $activity = Activity::updateOrCreate(['id' => $activityData['id']], $activityData);
                }
            }
            // Awards
            // Diff awards that got deleted and destroy them in database.
            $originalAwardIds = [];
            $newAwardIds = [];
            foreach ($applicant->awards as $award) {
                array_push($originalAwardIds, $award->id);
            }
            if (array_key_exists('awards', $data)) {
                foreach ($data['awards'] as $award) {
                    array_push($newAwardIds, $award['id']);
                }
            }
            Award::destroy(collect($originalAwardIds)->diff($newAwardIds)->all());
            // Update or create awards that did not get deleted.
            if (array_key_exists('awards', $data)) {
                foreach ($data['awards'] as $awardData) {
                    $award = Award::updateOrCreate(['id' => $awardData['id']], $awardData);
                }
            }
            // Offers
            // Diff offers that go deleted and destroy them in database
            $originalOfferIds = [];
            $newOfferIds = [];
            foreach ($applicant->offers as $offer) {
                array_push($originalOfferIds, $offer->id);
            }
            if (array_key_exists('offers', $data)) {
                foreach ($data['offers'] as $activity) {
                    array_push($newOfferIds, $offer['id']);
                }
            }
            Offer::destroy(collect($originalOfferIds)->diff($newOfferIds)->all());
            // Update or create awards that did not get deleted.
            if (array_key_exists('offers', $data)) {
                foreach ($data['offers'] as $offerData) {
                    $offer = Offer::updateOrCreate(['id' => $offerData['id']], $offerData);
                }
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
        config('auth.defaults'); // ['guard' => 'web', 'passwords' => 'users'];
        return redirect()->back();
    }
}
