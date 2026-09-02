<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SlugMatchesName;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('permission_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('permission')->id;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($id),
            ],
            'slug' => [
                'required',
                'string',
                Rule::unique('permissions')->ignore($id),
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
