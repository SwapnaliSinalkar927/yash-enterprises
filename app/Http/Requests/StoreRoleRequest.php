<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SlugMatchesName;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('role_edit');
    }

    public function prepareForValidation()
    {
        $permissions = $this->input('permissions', []);
        $parentPermissions = $this->input('parent_permissions', []);

        // Merge the permissions and parent_permissions arrays
        $mergedPermissions = array_merge($permissions, $parentPermissions);

        // Set the mergedPermissions as the value of the 'merged_permissions' field
        $this->merge([
            'permissions' => $mergedPermissions,
        ]);
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
                'unique:roles,name'
            ],
            'slug' => [
                'required',
                'string',
                'unique:roles,slug',
                new SlugMatchesName($this->name)
            ],
            'permissions' => [
                'required',
                'array'
            ],
            'permissions.*' => [
                'required',
            ],
            'status' => [
                'required'
            ]
        ];
    }
}
