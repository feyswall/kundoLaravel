<?php

namespace App\Http\Requests;

use App\Rules\UniqueName;
use Illuminate\Foundation\Http\FormRequest;

class ValidateStateRequest extends FormRequest
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
            'jimbo' => ['required', 'string', 'max:50',
                new UniqueName( $this->input('district_id'), 'states' )
            ]
        ];
    }

    public function messages()
    {
        return [
            'jimbo.required' => "Tafadhali jaza jina la jimbo",
            'jimbo.string' => "Ni lazima Lina  la jimbo lihusishe maneno pekee",
            'jimbo.max' => "Jina la Jombo linahusisha Herufi    Zisizozidi Hamsini",
        ];
    }

}
