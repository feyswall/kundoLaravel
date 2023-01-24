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
            'jimbo' => ['required', 'string', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            '*.required' => "Tafadhali jaza jina la :attribute",
            '*.string' => "Ni lazima Lina  la :attribute lihusishe maneno pekee",
            '*.max' => "Jina la :attribute linahusisha Herufi Zisizozidi Hamsini",
        ];
    }

}
