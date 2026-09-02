<?php

return [
    'phone.required' => 'फोन नंबर आवश्यक है।',
    'phone.string' => 'फोन नंबर केवल संख्याएँ होनी चाहिए।',
    'phone.regex' => 'फोन नंबर ठीक 12 अंकों का होना चाहिए।',

    'language.required' => 'भाषा आवश्यक है।',
    'language.string' => 'भाषा एक स्ट्रिंग होनी चाहिए।',
    'language.in' => 'भाषा को निर्दिष्ट विकल्पों में से एक होना चाहिए (English, हिन्दी)।',


    'full_name.required' => 'पूरा नाम आवश्यक है।',
    'full_name.string' => 'पूरा नाम एक स्ट्रिंग होना चाहिए।',
    'full_name.max' => 'पूरा नाम 255 वर्णों से अधिक नहीं हो सकता।',
    'full_name.regex' => 'पूरा नाम में अमान्य वर्ण, पैटर्न हैं या यह केवल संख्यात्मक है।',
    'name_saved_successfully' => 'नाम सफलतापूर्वक सहेजा गया।',

    'pincode.required' => 'पिनकोड आवश्यक है।',
    'pincode.string' => 'पिनकोड केवल संख्याएँ होनी चाहिए।',
    'pincode.regex' => 'पिनकोड बिल्कुल 6 अंकों का होना चाहिए।',
    'pincode.invalid' => 'दिया गया पिनकोड अवैध है।',

    'wd_code.required' => 'WD कोड आवश्यक है।',
    'wd_code.string' => 'WD कोड संख्यात्मक होना चाहिए।',
    'wd_code.invalid' => 'दिया गया WD कोड अवैध है।',
    'wd_code.regex' => 'WD कोड का प्रारूप अमान्य है। (जैसे, AB1234)',

    'payment_mode.required' => 'भुगतान मोड आवश्यक है।',
    'payment_mode.string' => 'भुगतान मोड एक स्ट्रिंग होना चाहिए।',
    'payment_mode.in' => 'भुगतान मोड UPI या बैंक विवरण में से एक होना चाहिए।',

    'upi.required' => 'UPI ID आवश्यक है।',
    'upi.string' => 'UPI ID एक स्ट्रिंग होना चाहिए।',
    'upi.regex' => 'UPI ID एक मान्य प्रारूप में होना चाहिए (जैसे, abc@bank)।',

    'bank_account_number.required' => 'बैंक खाता नंबर आवश्यक है।',
    'bank_account_number.string' => 'बैंक खाता नंबर एक स्ट्रिंग होना चाहिए।',
    'bank_account_number.regex' => 'बैंक खाता नंबर में केवल अंक होने चाहिए।',
    'bank_account_number.min' => 'बैंक खाता नंबर कम से कम 9 अंकों का होना चाहिए।',
    'bank_account_number.max' => 'बैंक खाता नंबर 18 अंकों से अधिक नहीं होना चाहिए।',

    'bank_ifsc_code.required' => 'IFSC कोड आवश्यक है।',
    'bank_ifsc_code.string' => 'IFSC कोड एक स्ट्रिंग होना चाहिए।',
    'bank_ifsc_code.regex' => 'IFSC कोड को मानक प्रारूप का पालन करना चाहिए (जैसे, ABCD0123456)।',

    'order_detail.required' => 'आर्डर विवरण आवश्यक है।',
    'order_detail.string' => 'आर्डर विवरण एक स्ट्रिंग होना चाहिए।',
    'order_detail.in' => 'आर्डर विवरण में से एक निर्दिष्ट विकल्प होना चाहिए (विकल्प 1, विकल्प 2)।',

    'bundle_quantity.required' => 'बंडल मात्रा आवश्यक है।',
    'bundle_quantity.string' => 'बंडल मात्रा एक स्ट्रिंग होनी चाहिए।',
    'bundle_quantity.regex' => 'बंडल मात्रा एक संख्या होनी चाहिए।',

    'reference_id.required' => 'संदर्भ आईडी आवश्यक है।',
    'reference_id.string' => 'संदर्भ आईडी एक स्ट्रिंग होनी चाहिए।',

    'coupon_code.required' => 'कूपन कोड आवश्यक है।',
    'coupon_code.string' => 'कूपन कोड एक स्ट्रिंग होना चाहिए।',
    'coupon_code.size' => 'कूपन कोड को ठीक 5 अक्षरों का होना चाहिए।',
    'coupon_code.invalid' => 'दिया गया कूपन कोड अवैध है।',
    'coupon_code.used' => 'दिया गया कूपन कोड पहले ही उपयोग किया जा चुका है।',
    'coupon_code.inactive' => 'दिया गया कूपन कोड सक्रिय नहीं है।',

    'reward_status.required' => 'पुरस्कार स्थिति आवश्यक है।',
    'reward_status.string' => 'पुरस्कार स्थिति एक स्ट्रिंग होनी चाहिए।',
    'reward_status.in' => 'पुरस्कार स्थिति निम्न में से एक होनी चाहिए: हाँ, नहीं।',

     'quantum_of_sale.required' => 'बिक्री की मात्रा आवश्यक है।',
    'quantum_of_sale.regex' => 'बिक्री की मात्रा केवल संख्या होनी चाहिए।',

    'user_type.invalid' => 'ऊपर दिए गए प्रकार में से चयन करें',
    'user_type.string' => 'ऊपर दिए गए प्रकार में से चयन करें',
    'user_type.required' => 'ऊपर दिए गए प्रकार में से चयन करें',

    'tl_mobile_number.required' => 'टीम लीडर का मोबाइल नंबर आवश्यक है।',
    'tl_mobile_number.string'   => 'टीम लीडर का मोबाइल नंबर केवल अंकों में होना चाहिए।',
    'tl_mobile_number.regex'    => 'टीम लीडर का मोबाइल नंबर ठीक 10 अंकों का होना चाहिए।',
    'tl_mobile_number.invalid'  => 'दिया गया टीम लीडर का मोबाइल नंबर मान्य नहीं है।',

];
