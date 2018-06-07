<?php

namespace App\Http\Controllers;

use App\Agency\Service\Feature;
use App\Agency\Service\Plan;
use App\Agency\Service\Step;
use App\Http\Requests\PlanStoreRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agency\Agency;
use Illuminate\Support\Facades\Auth;

class AgencyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $agency_id)
    {
        $agency = Agency::find($agency_id);
        $plans = $agency->plans()->paginate(6);
        return view('plan.index', ['plans'=>$plans, 'agency'=>$agency]);
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
            $this->authorize('create', Plan::class);
        }catch(AuthorizationException $exception){
            return redirect()->back();}
        return view('plan.create_and_edit', ['agency' => $agency]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanStoreRequest $request, $agency_id)
    {
        try {
            $this->authorize('create', Plan::class);
        } catch (AuthorizationException $exception) {
            return redirect()->back();
        }
        $data = $request->validated();
        $agency = Agency::find($agency_id);
        $plan = $agency->plans()->create($data['plan']);
        $plan->features()->createMany(array_key_exists('features', $data) ? $data['features'] : []);
        $plan->steps()->createMany(array_key_exists('steps', $data) ? $data['steps'] : []);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $agency_id, $plan_id) {
        $plan = Plan::findOrFail($plan_id);
        $plan->applicants = $plan->applicants()->limit(5)->get();
        return view('plan.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($agency_id, $plan_id)
    {
        $plan = Plan::findorFail($plan_id);
        $agency = $plan->agency;
        try{
            $this->authorize('update', $plan);
        } catch (AuthorizationException $exception){
            return redirect()->back();
        }
        return view('plan.create_and_edit', ['plan' => $plan, 'agency' => $agency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(planStoreRequest $request, $agency_id, $plan_id)
    {
        $plan = Plan::find($plan_id);
        try {
            $this->authorize('update', $plan);
        } catch (AuthorizationException $exception) {
            return redirect()->route('home');
        }
        $data = $request->validated();

        // Update Plan Basic Information
        $plan->update($data['plan']);

        // Features
        // Diff Features that got deleted and destroy them in database.
        $originalFeatureIds = [];
        $newFeatureIds = [];
        foreach ($plan->features as $feature) {
            array_push($originalFeatureIds, $feature->id);
        }
        if (array_key_exists('features', $data)) {
            foreach ($data['features'] as $feature) {
                array_push($newFeatureIds, $feature['id']);
            }
        }
        Feature::destroy(collect($originalFeatureIds)->diff($newFeatureIds)->all());
        // Update or create features that did not get deleted.
        if (array_key_exists('features', $data)) {
            foreach ($data['features'] as $featureData) {
                $feature = feature::updateOrCreate(['id' => $featureData['id']], $featureData);
            }
        }

        // Steps
        // Diff Steps that got deleted and destroy them in database.
        $originalStepIds = [];
        $newStepIds = [];
        foreach ($plan->steps as $step) {
            array_push($originalStepIds, $step->id);
        }
        if (array_key_exists('steps', $data)) {
            foreach ($data['steps'] as $step) {
                array_push($newStepIds, $step['id']);
            }
        }
        Step::destroy(collect($originalStepIds)->diff($newStepIds)->all());
        // Update or create steps that did not get deleted.
        if (array_key_exists('steps', $data)) {
            foreach ($data['steps'] as $stepData) {
                $step = step::updateOrCreate(['id' => $stepData['id']], $stepData);
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
    public function destroy($agency_id,$plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        try{
            $this->authorize('update', $plan);
        } catch (AuthorizationException $exception){
            return redirect()->back();
        }
        $plan -> delete();
        return redirect()->back();


        //
    }
}
