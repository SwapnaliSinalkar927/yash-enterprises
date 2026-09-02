<?php

return [
    'phone.required' => 'ఫోన్ నంబర్ అవసరం.',
    'phone.string'   => 'ఫోన్ నంబర్ సంఖ్యలుగా ఉండాలి.',
    'phone.regex'    => 'ఫోన్ నంబర్ తప్పనిసరిగా 12 అంకెలు ఉండాలి.',

    'language.required' => 'భాషను ఎంచుకోవడం తప్పనిసరి.',
    'language.string'   => 'భాష ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'language.in'       => 'భాష ఈ ఎంపికలలో ఒకటి కావాలి (English, हिन्दी, ଓଡ଼ିଆ, తెలుగు).',

    'full_name.required' => 'పూర్తి పేరు అవసరం.',
    'full_name.string'   => 'పూర్తి పేరు ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'full_name.max'      => 'పూర్తి పేరు 255 అక్షరాలను మించకూడదు.',
    'full_name.regex'    => 'పూర్తి పేరులో చెల్లని అక్షరాలు లేదా సంఖ్యలు ఉన్నాయి.',

    'pincode.required' => 'పిన్ కోడ్ అవసరం.',
    'pincode.string'   => 'పిన్ కోడ్ సంఖ్యలుగా ఉండాలి.',
    'pincode.regex'    => 'పిన్ కోడ్ తప్పనిసరిగా 6 అంకెలు ఉండాలి.',
    'pincode.invalid'  => 'ఇచ్చిన పిన్ కోడ్ చెల్లదు.',

    'wd_code.required' => 'WD కోడ్ అవసరం.',
    'wd_code.string'   => 'WD కోడ్ సంఖ్యలుగా ఉండాలి.',
    'wd_code.invalid'  => 'ఇచ్చిన WD కోడ్ చెల్లదు.',
    'wd_code.regex'    => 'WD కోడ్ ఫార్మాట్ చెల్లదు (ఉదా: AB1234).',

    'payment_mode.required' => 'చెల్లింపు విధానం అవసరం.',
    'payment_mode.string'   => 'చెల్లింపు విధానం ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'payment_mode.in'       => 'చెల్లింపు విధానం UPI లేదా Bank Details మాత్రమే కావాలి.',

    'upi.required' => 'UPI ID అవసరం.',
    'upi.string'   => 'UPI ID ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'upi.regex'    => 'UPI ID సరైన ఫార్మాట్‌లో ఉండాలి (ఉదా: abc@bank).',

    'bank_account_number.required' => 'బ్యాంక్ ఖాతా నంబర్ అవసరం.',
    'bank_account_number.string'   => 'బ్యాంక్ ఖాతా నంబర్ ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'bank_account_number.regex'    => 'బ్యాంక్ ఖాతా నంబర్ సంఖ్యలు మాత్రమే ఉండాలి.',
    'bank_account_number.min'      => 'బ్యాంక్ ఖాతా నంబర్ కనీసం 9 అంకెలు ఉండాలి.',
    'bank_account_number.max'      => 'బ్యాంక్ ఖాతా నంబర్ గరిష్టంగా 18 అంకెలు మాత్రమే ఉండాలి.',

    'bank_ifsc_code.required' => 'IFSC కోడ్ అవసరం.',
    'bank_ifsc_code.string'   => 'IFSC కోడ్ ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'bank_ifsc_code.regex'    => 'IFSC కోడ్ సరైన ఫార్మాట్‌లో ఉండాలి (ఉదా: ABCD0123456).',

    'order_detail.required' => 'ఆర్డర్ వివరాలు అవసరం.',
    'order_detail.string'   => 'ఆర్డర్ వివరాలు ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'order_detail.in'       => 'ఆర్డర్ వివరాలు ఇచ్చిన ఎంపికలలో ఒకటి కావాలి (Option 1, Option 2).',

    'bundle_quantity.required' => 'బండిల్ పరిమాణం అవసరం.',
    'bundle_quantity.string'   => 'బండిల్ పరిమాణం ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'bundle_quantity.regex'    => 'బండిల్ పరిమాణం ఒక సంఖ్యగా ఉండాలి.',

    'reference_id.required' => 'రిఫరెన్స్ ID అవసరం.',
    'reference_id.string'   => 'రిఫరెన్స్ ID ఒక స్ట్రింగ్‌గా ఉండాలి.',

    'coupon_code.required' => 'కూపన్ కోడ్ అవసరం.',
    'coupon_code.string'   => 'కూపన్ కోడ్ ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'coupon_code.size'     => 'కూపన్ కోడ్ తప్పనిసరిగా 5 అక్షరాలుగా ఉండాలి.',
    'coupon_code.invalid'  => 'ఇచ్చిన కూపన్ కోడ్ చెల్లదు.',
    'coupon_code.used'     => 'ఈ కూపన్ కోడ్ ఇప్పటికే ఉపయోగించబడింది.',
    'coupon_code.inactive' => 'ఈ కూపన్ కోడ్ యాక్టివ్‌లో లేదు.',

    'reward_status.required' => 'బహుమతి స్థితి అవసరం.',
    'reward_status.string'   => 'బహుమతి స్థితి ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'reward_status.in'       => 'బహుమతి స్థితి Yes లేదా No మాత్రమే కావాలి.',

    'quantum_of_sale.required' => 'విక్రయ పరిమాణం అవసరం.',
    'quantum_of_sale.regex'    => 'విక్రయ పరిమాణం ఒక సంఖ్యగా ఉండాలి.',

    'user_type.invalid' => 'పైన పేర్కొన్న రకాలలో ఒకదాన్ని ఎంచుకోండి.',
    'user_type.string'  => 'రకం ఒక స్ట్రింగ్‌గా ఉండాలి.',
    'user_type.required'=> 'రకం అవసరం.',

    'tl_mobile_number.required' => 'టీమ్ లీడర్ మొబైల్ నంబర్ అవసరం.',
    'tl_mobile_number.string'   => 'టీమ్ లీడర్ మొబైల్ నంబర్ సంఖ్యలుగా ఉండాలి.',
    'tl_mobile_number.regex'    => 'టీమ్ లీడర్ మొబైల్ నంబర్ తప్పనిసరిగా 10 అంకెలు ఉండాలి.',
    'tl_mobile_number.invalid'  => 'ఇచ్చిన టీమ్ లీడర్ మొబైల్ నంబర్ చెల్లదు.',
];
