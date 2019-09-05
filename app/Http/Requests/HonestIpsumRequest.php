<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HonestIpsumRequest extends FormRequest
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
            'element_count' => 'nullable|numeric|min:1|max:999',
            'element' => 'nullable',
            'career' => 'nullable|string',
            'length' => 'nullable|numeric|min:1|max:999'
        ];
    }
}
