<?php

namespace App\Http\Requests;

use App\Rules\DistrictLeaderRule;
use App\Rules\LeadersCountRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateRegionLeaderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstName' => ['required', 'string', 'max:50'],
            'middleName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'max:15'],
            'post_id' =>  [
                new DistrictLeaderRule($this->input('side_id'), $this->input('post_id'), $this->input('table'), $this->input('side_column')),
                new LeadersCountRule(3, 'leader_region', 'wj_kamat_siasa_M'),
                new LeadersCountRule(13, 'leader_region', 'wj_h_kuu_M')
            ]
        ];
    }


    public function messages()
    {
        return [
            'firstName.required' => "Tafadhali jaza jina la Kwanza",
            'middleName.required' => "Tafadhali jaza jina la Kati",
            'lastName.required' => "Tafadhali jaza jina la Mwisho",
            'phone.required' => "Tafadhali jaza Namba ya simu",
            '*.string' => "Ni lazima Lina lihusishe maneno pekee",
            '*.max' => "Jina linahusisha Herufi    Zisizozidi Hamsini",
        ];
    }
}
