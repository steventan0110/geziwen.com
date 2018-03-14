<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant\Applicant;

class ApplicantController extends Controller
{
    public function view(Request $request, $id) {
        $applicant = Applicant::findOrFail($id);
        return view('applicant.view', [
            'profile' => $applicant,
            'agency' => $applicant->plan->agency,
            'exams' => $applicant->exams(),
            'activities' => $applicant->activity()->get(),
            'awards' => $applicant->award()->get(),
            'offers' => $applicant->offers()->get()
        ]);
    }

    public function create() {
        return "create";
    }

    public function edit() {
        return "edit";
    }

    public function delete() {
        return "delete";
    }

}
