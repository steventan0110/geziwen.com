<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AgencyUpdateRequest extends FormRequest
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
            'agency.name' => 'required|max:100',
            'agency.introduction' => 'required|max:200',
            'agency.address' => 'required|max:100',
            'agency.telephone' => 'required|between:8,20',
            'agency.website' => 'required|url',
            'agency.started_on' => 'required|date',
            'agency.email' => 'required|email'
        ];
    }
}
