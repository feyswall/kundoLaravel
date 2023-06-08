<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Rules\DistrictLeaderRule;
use App\Rules\LeadersCountRule;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class ValidateDistrictLeaderRequest extends FormRequest
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
        if ($this->input('withLeader') == 'true'){
            return [];
        }
        $post = Post::find($this->input('post_id'));
        $idadi = $post->numberCount;
        return [
            'firstName' => ['required', 'string', 'max:50'],
            'middleName' => ['required', 'string', 'max:50'],
            'lastName' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'max:15', new PhoneNumber()],
            'post_id' =>  [
//                new DistrictLeaderRule($this->input('side_id'), $this->input('post_id'), $this->input('table'), $this->input('side_column')),
                new LeadersCountRule($idadi, 'district_leader', $post->deep, "district_id", $this->input('side_id')),
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
