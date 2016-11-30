<?php

namespace Lynk\Http\Requests\Links;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkFormRequest extends FormRequest
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
            'url' => 'required|url',
            'code' => 'alpha_dash|unique:links,code',
        ];
    }
}
