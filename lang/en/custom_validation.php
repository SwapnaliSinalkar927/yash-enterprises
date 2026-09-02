<?php

return [
    'phone.required' => 'The phone number is required.',
    'phone.string' => 'The phone number must be numeric.',
    'phone.regex' => 'The phone number must be exactly 12 digits.',

    'language.required' => 'The language is required.',
    'language.string' => 'The language must be a string.',
    'language.in' => 'The language must be one of the specified options (English, हिन्दी).',

    'full_name.required' => 'The full name is required.',
    'full_name.string' => 'The full name must be a string.',
    'full_name.max' => 'The full name must not exceed 255 characters.',
    'full_name.regex' => 'The full name contains invalid characters, patterns, or is numeric.',

    'pincode.required' => 'The pincode is required.',
    'pincode.string' => 'The pincode must be numeric.',
    'pincode.regex' => 'The pincode must be exactly 6 digits.',
    'pincode.invalid' => 'The provided pincode is not valid.',

    'wd_code.required' => 'The wd code is required.',
    'wd_code.string' => 'The wd code must be numeric.',
    'wd_code.invalid' => 'The provided wd code is not valid.',
    'wd_code.regex' => 'The wd code format is invalid. (e.g., AB1234).',

    'payment_mode.required' => 'The payment mode is required.',
    'payment_mode.string' => 'The payment mode must be a string.',
    'payment_mode.in' => 'The payment mode must be either UPI or Bank Details.',

    'upi.required' => 'The UPI ID is required.',
    'upi.string' => 'The UPI ID must be a string.',
    'upi.regex' => 'The UPI ID must be a valid format (e.g., abc@bank).',

    'bank_account_number.required' => 'The bank account number is required.',
    'bank_account_number.string' => 'The bank account number must be a string.',
    'bank_account_number.regex' => 'The bank account number must contain only digits.',
    'bank_account_number.min' => 'The bank account number must be at least 9 digits long.',
    'bank_account_number.max' => 'The bank account number must not exceed 18 digits.',

    'bank_ifsc_code.required' => 'The IFSC code is required.',
    'bank_ifsc_code.string' => 'The IFSC code must be a string.',
    'bank_ifsc_code.regex' => 'The IFSC code must follow the standard format (e.g., ABCD0123456).',

    'order_detail.required' => 'The order detail is required.',
    'order_detail.string' => 'The order detail must be a string.',
    'order_detail.in' => 'The order detail must be one of the specified options (Option 1, Option 2).',

    'bundle_quantity.required' => 'The bundle quantity is required.',
    'bundle_quantity.string' => 'The bundle quantity must be a string.',
    'bundle_quantity.regex' => 'The bundle quantity must be number',

    'reference_id.required' => 'The reference id is required.',
    'reference_id.string' => 'The reference id must be a string.',

    'coupon_code.required' => 'The coupon code is required.',
    'coupon_code.string' => 'The coupon code must be a string.',
    'coupon_code.size' => 'The coupon code must be exactly 5 characters long.',
    'coupon_code.invalid' => 'The provided coupon code is not valid.',
    'coupon_code.used' => 'The provided coupon code has already been used.',
    'coupon_code.inactive' => 'The provided coupon code is not active.',

    'reward_status.required' => 'The reward status is required.',
    'reward_status.string' => 'The reward status must be a string.',
    'reward_status.in' => 'The reward status must be one of the following: Yes, No.',

    'quantum_of_sale.required' => 'Quantum of sale is required.',
    'quantum_of_sale.regex' => 'Quantum of sale should be a number',

    'user_type.invalid' => 'Choose from above mentioned types',
    'user_type.string' => 'Type must be a string.',
    'user_type.required' => 'Type is required.',

    'tl_mobile_number.required' => 'The team leader mobile number is required.',
    'tl_mobile_number.string' => 'The team leader mobile number must be numeric.',
    'tl_mobile_number.regex' => 'The team leader mobile number must be exactly 10 digits.',
    'tl_mobile_number.invalid' => 'The provided team leader mobile number is not valid.',
];
