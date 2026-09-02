<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{WholesalerSurveyDetail};

class SendOtpRequest extends FormRequest
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
            'name'    => 'required',
            'wd_code'    => 'required|exists:wds,code',
            'mobile_number' => [
                'required',
                'numeric',
                'digits:10',
                function ($attribute, $value, $fail) {
                    $mobileNumber = $this->input('mobile_number');
                    $existingCustomer = WholesalerSurveyDetail::where('mobile_number', $mobileNumber)->where('verified_otp',1)->first();
                    if ($existingCustomer) {
                        $fail('mobile_number already exist');
                    }
                }
            ]
        ];
    }
}
