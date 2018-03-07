<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;

class ApplicantController extends Controller
{
    public function view(Request $request, $id) {
        $applicant = Applicant::findOrFail($id);
        return view('applicant.view', [
            'profile' => $applicant,
            'agency' => $applicant->agency,
            'tests' => [
                'toefls' => $applicant->toefl()->get(),
                'sats' => $applicant->sat()->get(),
                'satSubjects' => $applicant->satSubject()->get(),
                'ieltss' => $applicant->ielts()->get(),
                'aps' => $applicant->ap()->get()
            ],
            'activities' => $applicant->activity()->get(),
            'awards' => $applicant->award()->get()
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
