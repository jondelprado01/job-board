<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\RequestRules;

class JobRequestValidation extends FormRequest
{
    use RequestRules;
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
        return array_merge($this->jobRules());
    }

    public function messages()
    {
        return array_merge($this->jobRulesMessages());
    }

}
