<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Code};

class AdminEditCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->input('id');
        return [
            'code' => [
            'required',
            function ($attribute, $value, $fail) use ($id) {
                $exists = Code::where('code', $value)
                    ->where('id', '!=', $id)  // Make sure the ID is not the same as the current row
                    ->exists();

                if ($exists) {
                    $fail('The code has already been taken.');
                }
            }
        ],
            'value' => 'required|numeric',
            'is_used' => 'required',
            'status' => 'required'
        ];
    }
}
