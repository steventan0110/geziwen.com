<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'applicant_type' => 'required|in:standard,language',
            'applicant.surname' => 'required',
            'applicant.plan' => 'required|integer',
            'applicant.introduction' => 'required',
            'exams.*.type' => 'required|in:toefl,ielts,sat,act,ap,sat2',
            'exams.*.score' => 'required|array',
            'exams.*.score.total' => 'required_unless:applicant_type,language|integer|nullable',
            'activities.*.type_id' => 'required|integer',
            'activities.*.name' => 'required',
            'activities.*.description' => 'required',
            'awards.*.name' => 'required',
            'awards.*.received_on' => 'required',
            'awards.*.description' => 'required',
            'offers.*.university_id' => 'required|integer',
            'offers.*.plan_id' => 'required|integer'
        ];
    }
}
