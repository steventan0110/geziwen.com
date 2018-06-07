<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanStoreRequest extends FormRequest
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
//            'plan' => 'required|Integer',
            'plan.name' => 'required',
            'plan.price' => 'required',
            'plan.introduction' => 'required',
            'features.*.name' => 'required',
            'steps.*.name' => 'required',
            'steps.*.period' => 'required',
            'steps.*.introduction' => 'required'
        ];
    }
}
