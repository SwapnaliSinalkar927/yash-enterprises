<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidVPA;
use Illuminate\Validation\Rule;

class AdminEditWholesalerRequest extends FormRequest
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
        return [
            'full_name' => 'required',
            'mobile_number' => 'required|digits:10|unique:wholesalers,mobile_number,' . $this->route('wholesaler') . ',id',
            'pincode' => 'sometimes',
            'status' => 'required',
        ];
    }
}
