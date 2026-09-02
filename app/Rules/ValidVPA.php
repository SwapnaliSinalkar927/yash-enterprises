<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidVPA implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      
        $isUpiId = preg_match('/^[0-9A-Za-z.-]{2,256}\@?(paytm|okicici|oksbi|okaxis|okhdfcbank|ybl|upi|axl|okbizicici)$/', $value);

        return $isUpiId;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid VPA.';
    }
}
