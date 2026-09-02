<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SlugMatchesName;

class StorePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('permission_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name'
            ],
            'slug' => [
                'required',
                'string',
                'unique:permissions,slug',
                new SlugMatchesName($this->name)
            ],
            'parent_id' => [
                'required_without:is_parent',
            ],
            'status' => [
                'required'
            ]
        ];
    }
}
