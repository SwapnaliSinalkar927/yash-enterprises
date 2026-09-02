<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('export_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $tableValue = $this->input('table');
        return [
            'table'    => 'required',
            'startDateTime' => 'required',
            'endDateTime' => 'required',
            'payment_method' => [
                $tableValue === 'wholesaler_rzp_upload' ? 'required' : 'sometimes',
            ],
        ];
    }
}
