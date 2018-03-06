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
                'toefl' => $applicant->toefl()->get(),
                'sat' => $applicant->sat()->get(),
                'satSubject' => $applicant->satSubject()->get(),
                'ielts' => $applicant->ielts()->get(),
                'ap' => $applicant->ap()->get()
            ],
            'activity' => $applicant->activity()->get(),
            'award' => $applicant->award()->get()
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
