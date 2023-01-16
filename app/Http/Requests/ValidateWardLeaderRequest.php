<?php

namespace App\Http\Requests;

use App\Rules\LeadersCountRule;
use App\Rules\ModelExistsRule;
use App\Rules\WardLeadersRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateWardLeaderRequest extends FormRequest
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
        $idadi_wajumbe_wilaya = 5;
        return [
            'firstName' => ['required', 'string', 'max:50'],
            'middleName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'max:15'],
            'post_id' =>  [
                new WardLeadersRule($this->input('side_id'), $this->input('post_id'), $this->input('table'), $this->input('side_column')),
                new LeadersCountRule($idadi_wajumbe_wilaya, 'leader_ward', 'mj_mkutano_mkuu_W')
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