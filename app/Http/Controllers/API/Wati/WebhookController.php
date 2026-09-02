<?php

namespace App\Http\Controllers\API\Wati;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\{Wholesaler, Pincode, Code, Brand, Order,LatestWholesaler,LatestCode,LatestOrder,TeamLeader};
use Log, DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    /**
     * Handle check user response.
     */

    // public function storeLocation(Request $request)
    // {
    //     \Log::info('📩 WATI Webhook Data: ', $request->all());
    //     $lat = null;
    //     $lng = null;
    //     $address = null;

    //     $mobile_number = $request->waId ?? null;

    //     // Case 1: data array contains location info
    //     if (is_array($request->data)) {
    //         $lat = $request->data['latitude'] ?? null;
    //         $lng = $request->data['longitude'] ?? null;
    //         $address = $request->data['address'] ?? null;
    //     }

    //     // Case 2: location shared as text link
    //     elseif ($request->type === 'location' && $request->text) {
    //         preg_match('/@?(-?\d+\.\d+),(-?\d+\.\d+)/', $request->text, $matches);
    //         if (count($matches) === 3) {
    //             $lat = $matches[1];
    //             $lng = $matches[2];
    //         } else {
    //             \Log::warning("Could not parse coordinates from text: " . $request->text);
    //         }
    //     }

    //     if ($lat && $lng && $mobile_number) {
    //         $wholesaler = Latestwholesaler::where('mobile_number', $mobile_number)->first();

    //         if ($wholesaler && (!$wholesaler->lat || !$wholesaler->long)) {
    //             $wholesaler->update([
    //                 'lat' => $lat,
    //                 'long' => $lng
    //             ]);
    //         }
    //         $this->sendLocationCapturedMessage($mobile_number);
    //     }

    //     return response()->json(['status' => 'ok']);
    // }

   public function storeLocation(Request $request)
    {
        \Log::info("Capture Location");
        $lat = null;
        $lng = null;
        $address = null;
        $pincode = null;
        $mobile_number = $request->waId ?? null;

        // Case 1: data array contains location info
        if (is_array($request->data)) {
            $lat = $request->data['latitude'] ?? null;
            $lng = $request->data['longitude'] ?? null;
            $address = $request->data['address'] ?? null;
        }
        // Case 2: location shared as text link
        elseif ($request->type === 'location' && $request->text) {
            preg_match('/@?(-?\d+\.\d+),(-?\d+\.\d+)/', $request->text, $matches);
            if (count($matches) === 3) {
                $lat = $matches[1];
                $lng = $matches[2];
            } else {
                \Log::warning("Could not parse coordinates from text: " . $request->text);
            }
        }

        // If lat/lng found, get pincode using Google Maps
        if ($lat && $lng && $mobile_number) {
            try {
                $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'latlng' => "$lat,$lng",
                    'key' => 'AIzaSyDgv1TBtYp6aWJdoDNEyNvMX97oeGDt-38',
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    if (!empty($data['results'][0]['address_components'])) {
                        foreach ($data['results'][0]['address_components'] as $component) {
                            if (in_array('postal_code', $component['types'])) {
                                $pincode = $component['long_name'];
                            }
                        }

                        // Capture formatted address if available
                        $address = $address ?? ($data['results'][0]['formatted_address'] ?? null);
                    }
                } else {
                    \Log::warning("Google API failed for lat:$lat lng:$lng | Status: " . $response->status());
                }
            } catch (\Exception $e) {
                \Log::error("Google Reverse Geocode failed: " . $e->getMessage());
            }

            // Update wholesaler info
            $wholesaler = Latestwholesaler::where('mobile_number', $mobile_number)->first();

            if ($wholesaler) {
                $updateData = [
                    'lat' => $lat,
                    'long' => $lng,
                ];

                Latestwholesaler::where('mobile_number', $mobile_number)->update([
                     'lat' => $lat,
                     'long' => $lng,
                     'address' => $address,
                     'pincode' => $pincode
                ]);

                // $wholesaler->update($updateData);

                \Log::info('Location & Pincode saved:', $updateData);
            }

            $this->sendLocationCapturedMessage($mobile_number);
        }

        return response()->json(['status' => 'ok']);
    }


    private function sendLocationCapturedMessage($waId)
    {
        $tenantId = '457465'; 
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6ImxldHNlbGV2YXRlMjAyNUBnbWFpbC5jb20iLCJuYW1laWQiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiZW1haWwiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDYvMTcvMjAyNiAwNDoyMToxMSIsInRlbmFudF9pZCI6IjQ1NzQ2NSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.JJhFk1CGo7ZW_sTtJrDZCYdx0R4Cv9ewTA0Qbx_exPY';
        $baseUrl = 'https://live-mt-server.wati.io';
        $channelNumber = '919004773102';
        // $url = "{$baseUrl}/{$tenantId}/api/v1/sendSessionMessage/{$waId}";

        // $wholesaler = Latestwholesaler::where('mobile_number', $waId)->first();

        // $lang = $wholesaler?->lang; // Safe null access

        // if ($lang === "hi") {
        //     $text = 'धन्यवाद! आपका लाइव लोकेशन सफलतापूर्वक प्राप्त कर लिया गया है।';
        // } else {
        //     $text = 'Thank you! Your live location has been captured successfully.';
        // }
        

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $token,
        //     'Accept' => 'application/json',
        // ])->asForm()->post($url, [
        //     'messageText' => $text,
        //     'channelPhoneNumber' => $channelNumber,
        // ]);

        // \Log::info('Location confirmation sent', [
        //     '$channelNumber' => $channelNumber,
        //     'waId' => $waId,
        //     'response_status' => $response->status(),
        //     'response_body' => $response->body(),
        // ]);

         $url = "{$baseUrl}/{$tenantId}/api/v1/sendSessionMessage/{$waId}";

        $wholesaler = Latestwholesaler::where('mobile_number', $waId)->first();
        // $wholesaler = Latestwholesaler::where('mobile_number', $waId)->first();

        $lang = $wholesaler?->lang; // Safe null access


        if ($lang === "hi") {
            $text = "धन्यवाद! आपका लाइव लोकेशन सफलतापूर्वक प्राप्त कर लिया गया है।\nयह चैट खत्म हो गई है। नई चैट शुरू करने के लिए बस 'Hi' या 'Hello' लिखें।";
        } else {
            $text = "Thank you! Your live location has been captured successfully.\nThis chat session has ended. To start a new chat, just type 'Hi' or 'Hello'.";
        }


        // $text = 'Thank you! Your live location has been captured successfully.';

        $url = "{$baseUrl}/{$tenantId}/api/v1/sendSessionMessage/{$waId}"
            . "?messageText=" . urlencode($text)
            . "&channelPhoneNumber={$channelNumber}";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post($url);

        \Log::info('Location confirmation sent', [
            'waId'           => $waId,
            'url'            => $url,
            'response_status' => $response->status(),
            'response_body'   => $response->body(),
        ]);
    }

    public function checkUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $wholesaler = Wholesaler::where('mobile_number', $validator->validated()['phone'])->first();

        if(!$wholesaler){
            return response()->json(['message' => 'Wholesaler does not exists.'], 400);
        }

        $requiredFields = ['full_name', 'mobile_number'];

        foreach ($requiredFields as $field) {
            if (is_null($wholesaler->$field)) {
                return response()->json(['message' => 'Wholesaler does not exist.'], 400);
            }
        }

        return response()->json([
            'message' => 'Wholesaler exists.',
            'data' => [
                'full_name' => $wholesaler->full_name
            ]
        ], 200);
    }

    /**
     * Handle name response.
     */
    public function handleName(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'full_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!\d+$)(?!.*(?:हिन्दी ⏺|English ⏺))(?!^[A-Z]{2}[0-9]{4}$).*$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'full_name.required' => __('custom_validation.full_name.required'),
            'full_name.string' => __('custom_validation.full_name.string'),
            'full_name.max' => __('custom_validation.full_name.max'),
            'full_name.regex' => __('custom_validation.full_name.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        Wholesaler::updateOrCreate([
            'mobile_number' => $validator->validated()['phone']
        ],[
            'full_name' => $validator->validated()['full_name']
        ]);

        return response()->json(['message' => 'Name saved successfully.'], 200);
    }

    /**
     * Handle pincode response.
     */
    public function handlePincode(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $pincode = $request->input('pincode');
        // $pincode = convertHindiToEnglishNumber($pincode);

        // $request->merge(['pincode' => $pincode]);

        // Now pass the converted pincode to the validator
        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'pincode' => [
                'required',
                'string',
                'regex:/^\d{6}$/'
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'pincode.required' => __('custom_validation.pincode.required'),
            'pincode.string' => __('custom_validation.pincode.string'),
            'pincode.regex' => __('custom_validation.pincode.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        NewWholesaler::updateOrCreate([
            'mobile_number' => $validator->validated()['phone'],
        ],[
            'pincode' => $validator->validated()['pincode'],
        ]);

        return response()->json(['message' => 'Pincode saved successfully.'], 200);
    }

    /**
     * Handle coupon code response.
     */
    /*public function handleCouponCode(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'coupon_code' => [
                'required',
                'string',
                'min:13',
                function ($attribute, $value, $fail) {
                    $coupon = Code::where('code', $value)->first();

                    if (!$coupon) {
                        $fail(__('custom_validation.coupon_code.invalid'));
                        return;
                    }

                    if ($coupon->is_used) {
                        $fail(__('custom_validation.coupon_code.used'));
                        return;
                    }

                    if (!$coupon->status) {
                        $fail(__('custom_validation.coupon_code.inactive'));
                        return;
                    }
                }
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'coupon_code.required' => __('custom_validation.coupon_code.required'),
            'coupon_code.string' => __('custom_validation.coupon_code.string'),
            'coupon_code.size' => __('custom_validation.coupon_code.size')
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();
        try {
            $wholesalerId = Wholesaler::whereMobileNumber($validator->validated()['phone'])->value('id');

            if(!$wholesalerId){
                return response()->json(['message' => 'Wholesaler not found.'], 400);
            }

            $code = Code::with('brand')->whereCode($validator->validated()['coupon_code'])->first();

            if(!$code){
                return response()->json(['message' => 'Invalid coupon code.'], 400);
            }

            $order = Order::create([
                'wholesaler_id' => $wholesalerId,
                'code_id' => $code->id,
                'value' => $code->value,
                'brand_id' => $code->brand_id
            ]);

            \Log::info($order);

            $code->is_used = true;
            $code->used_at = now();
            $code->save();

            $brands = Brand::orderBy('name')->get();

            $orderTotals = Order::query()
                ->select('brand_id', \DB::raw('SUM(value) as total_value'))
                ->where('orders.wholesaler_id', $wholesalerId)
                ->groupBy('brand_id')
                ->pluck('total_value', 'brand_id');

            $totalOrderValue = $brands->map(function ($brand) use ($orderTotals) {
                return [
                    'name' => $brand->name,
                    'total_value' => $orderTotals[$brand->id] ?? 0
                ];
            });

            DB::commit();

            return response()->json([
                'message' => 'coupon_code saved successfully.',
                'current_order_value' => $code->value,
                'current_order_brand' => $code->brand->name ?? null,
                'total_order_value' => $totalOrderValue
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong while saving the coupon.',
                'error' => $e->getMessage()
            ], 500);
        }
    }*/

    public function handleCouponCode(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'coupon_code' => 'required|string'
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'coupon_code.required' => __('custom_validation.coupon_code.required'),
            'coupon_code.string' => __('custom_validation.coupon_code.string'),
        ]);

        \Log::info($request->coupon_code);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        // Normalize codes (split by space, newline, comma, tab)
        $rawCodes = preg_split('/[\s,]+/', trim($request->coupon_code));
        $couponCodes = array_filter(array_map('trim', $rawCodes));

        return $this->processCoupons($couponCodes, $request->phone);
    }

    private function processCoupons(array $couponCodes, $phone)
    {
        $wholesalerId = Wholesaler::whereMobileNumber($phone)->value('id');
        if (!$wholesalerId) {
            return response()->json(['message' => 'Wholesaler not found.'], 400);
        }

        $success = [];
        $failed = [];
        $currentOrderTotals = [];

        DB::beginTransaction();
        try {
            foreach ($couponCodes as $codeValue) {
                $code = Code::with('brand')->where('code', $codeValue)->first();

                if (!$code) {
                    $failed[] = "❌ $codeValue - Invalid code";
                    continue;
                }

                if ($code->is_used) {
                    $failed[] = "❌ $codeValue - Code already used";
                    continue;
                }

                if (!$code->status) {
                    $failed[] = "❌ $codeValue - Code inactive";
                    continue;
                }

                // Create order
                Order::create([
                    'wholesaler_id' => $wholesalerId,
                    'code_id' => $code->id,
                    'value' => $code->value,
                    'brand_id' => $code->brand_id
                ]);

                // Update code
                $code->is_used = true;
                $code->used_at = now();
                $code->save();

                $brandName = $code->brand->name ?? 'Unknown';

                $success[] = [
                    'code' => $codeValue,
                    'brand' => $brandName,
                    'value' => $code->value
                ];

                // Track per-brand totals in this request
                $currentOrderTotals[$brandName] = ($currentOrderTotals[$brandName] ?? 0) + $code->value;
            }

            DB::commit();

            // All-time total order value per brand
            $brands = Brand::orderBy('name')->get();
            $orderTotals = Order::select('brand_id', DB::raw('SUM(value) as total_value'))
                ->where('wholesaler_id', $wholesalerId)
                ->groupBy('brand_id')
                ->pluck('total_value', 'brand_id');

            $totalOrderValue = $brands->map(function ($brand) use ($orderTotals) {
                return [
                    'name' => $brand->name,
                    'total_value' => $orderTotals[$brand->id] ?? 0
                ];
            })->values();

            // Format current order totals into array
            $currentOrderValue = $brands->map(function ($brand) use ($currentOrderTotals) {
                return [
                    'name' => $brand->name,
                    'total_value' => $currentOrderTotals[$brand->name] ?? 0
                ];
            })->values();

            return response()->json([
                'message' => 'Bulk coupon codes processed.',
                'total_success' => count($success),
                'total_failed' => count($failed),
                'current_order_value' => $currentOrderValue,
                'total_order_value' => $totalOrderValue,
                'failed_codes'  => implode("\n", $failed)
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong while processing bulk coupons.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Handle reward status response.
     */
    public function handleRewardStatus(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $rewardStatus = str_replace(' ⏺', '', $request->input('reward_status'));

        $request->merge([
            'reward_status' => match ($rewardStatus) {
                'Yes', 'हाँ' => 1,
                'No', 'नहीं' => 0,
                default => $rewardStatus,
            },
        ]);


        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'reward_status' => [
                'required',
                'integer',
                Rule::in([1, 0]),
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'reward_status.required' => __('custom_validation.reward_status.required'),
            'reward_status.string' => __('custom_validation.reward_status.string'),
            'reward_status.in' => __('custom_validation.reward_status.in'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $wholesalerId = Wholesaler::whereMobileNumber($validator->validated()['phone'])->value('id');

        if(!$wholesalerId){
            return response()->json(['message' => 'Wholesaler not found.'], 400);
        }

        Order::updateOrCreate([
            'wholesaler_id' => $wholesalerId,
        ],[
            'reward_status' => $validator->validated()['reward_status']
        ]);

        return response()->json(['message' => 'Reward status saved successfully.'], 200);
    }

    public function convertLanguageToLocale($language)
    {
        $languageToLocale = [
            'English' => 'en',
            'हिन्दी' => 'hi',
            'ଓଡ଼ିଆ' => 'or',
            'తెలుగు' => 'te',
        ];

        return isset($languageToLocale[$language]) ? $languageToLocale[$language] : $language;
    }

    public function setLocale($language)
    {
        $language = str_replace(' ⏺', '', $language);
        $language = $this->convertLanguageToLocale($language);
        app()->setLocale($language);
    }

    //Test
    public function welcomeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $mobile_number = $validator->validated()['phone'];
        \Log::info('mobile Number: ' .$validator->validated()['phone']);

        if(!$mobile_number){
            return response()->json(['message' => 'Wholesaler does not exists.'], 400);
        }
        else{
            return response()->json(['message' => 'Mobile Number not exists.'], 200);
        }
    }

     public function getUserName(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            'user_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!\d+$)(?!.*(?:हिन्दी ⏺|English ⏺))(?!^[A-Z]{2}[0-9]{4}$).*$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'user_name.required' => __('custom_validation.full_name.required'),
            'user_name.string' => __('custom_validation.full_name.string'),
            'user_name.max' => __('custom_validation.full_name.max'),
            'user_name.regex' => __('custom_validation.full_name.regex'),
        ]);
         \Log::info('Name: ' .$validator->validated()['user_name']);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        return response()->json(['message' => 'Name saved successfully.'], 200);
    }

    public function deleteWholesalers(Request $request)
    {
        $mobileNumbers = explode(',', $request->query('mobile_number'));

        if (empty($mobileNumbers)) {
            return response()->json(['message' => 'No mobile numbers provided.'], 400);
        }

        $deleted = [];
        $notFound = [];

        DB::beginTransaction();
        try {
            foreach ($mobileNumbers as $mobile) {
                $mobile = trim($mobile);

                $wholesaler = Wholesaler::where('mobile_number', $mobile)->first();

                if (!$wholesaler) {
                    $notFound[] = $mobile;
                    continue;
                }

                $wholesalerId = $wholesaler->id;

                // Get code IDs from orders
                $codeIds = Order::where('wholesaler_id', $wholesalerId)->pluck('code_id');

                // Reset code usage
                Code::whereIn('id', $codeIds)->update([
                    'is_used' => 0,
                    'used_at' => null
                ]);

                // Delete orders
                Order::where('wholesaler_id', $wholesalerId)->delete();

                // Delete the wholesaler
                $wholesaler->delete();

                $deleted[] = $mobile;
            }

            DB::commit();

            return response()->json([
                'message' => 'Deletion process completed.',
                'deleted_mobile_numbers' => $deleted,
                'not_found_mobile_numbers' => $notFound,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong during deletion.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveImage(Request $request){
        $userNumber = $request->input('phone');
        $image = $request->input('user_image'); // can be URL or mediaId

        \Log::info("Saving image for: " . $image);

    $tenantId = '457465'; // Or config('constants.wati.tenant_id')
    $baseUrl = "https://live-mt-server.wati.io/{$tenantId}/api/v1/getMedia";
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI0NDhhZjZlYi1jYzEwLTQ0NzctYWQ1ZC05MGNhYjc3NzU5ZDkiLCJ1bmlxdWVfbmFtZSI6ImxldHNlbGV2YXRlMjAyNUBnbWFpbC5jb20iLCJuYW1laWQiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiZW1haWwiOiJsZXRzZWxldmF0ZTIwMjVAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDgvMDUvMjAyNSAxMTo0MzoyMCIsInRlbmFudF9pZCI6IjQ1NzQ2NSIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.C7xIFA-sn3Kw7R0NRfSR6usKEo8-IIP25qUCDxYgapo';

    if (! filter_var($image, FILTER_VALIDATE_URL)) {
        // If WATI sent mediaId (fileName)
        $url = $baseUrl . "?fileName=" . urlencode($image);

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
            'Accept'        => '*/*',
        ])->get($url);
    } else {
        // If already a URL
        $response = Http::get($image);
    }

    if ($response->successful()) {
        $fileName = "user_images/{$userNumber}_" . time() . ".jpg";
        Storage::disk('public')->put($fileName, $response->body());
        return response()->json(['message' => 'Image saved successfully..'], 200);
    }

    \Log::error("Image fetch failed", [
        'url'    => $url ?? $image,
        'status' => $response->status(),
        'body'   => $response->body(),
    ]);

    return response()->json(['message' => 'Image failed to save.'], 422);

    }

    private function getImageExtension($contentType)
    {
        return match ($contentType) {
            'image/jpeg', 'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            default => 'jpg',
        };
    }

    public function saveLocation(Request $request){
         \Log::info("Saving image for: ");
        return response()->json(['message' => 'Image failed to save.'], 200);
    }

    public function checkNewUser(Request $request)
    {
         Log::info('checkNewUser API called', [
            'request' => $request->all()
        ]);
        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                // 'regex:/^\d{12}$/',
                'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
        ]);

        if ($validator->fails()) {
            Log::warning('Phone validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);

            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

         Log::info('Searching wholesaler', [
            'phone' => $validator->validated()['phone']
        ]);

        $mobile = $validator->validated()['phone'];

        // If 10 digits, prepend 91
        if (strlen($mobile) == 10) {
            $mobile = '91' . $mobile;
        }
        
         $wholesaler = LatestWholesaler::where('mobile_number', $mobile)->first();

        if(!$wholesaler){
             Log::warning('Wholesaler not found', [
            'phone' => $mobile
        ]);
            return response()->json(['message' => 'Wholesaler does not exists.'], 400);
        }

        $requiredFields = ['full_name', 'mobile_number'];

        foreach ($requiredFields as $field) {
            if (is_null($wholesaler->$field)) {
                return response()->json(['message' => 'Wholesaler does not exist.'], 400);
            }
        }

        return response()->json([
            'message' => 'Wholesaler exists.',
            'data' => [
                'full_name' => $wholesaler->full_name
            ]
        ], 200);

        return response()->json(['message' => 'Name saved successfully.'], 200);
    }

    public function newName(Request $request){
        $this->setLocale($request->input('language', 'en'));
        $rawLanguage = $request->input('language');
        //  \Log::info('Language selected: ' . $rawLanguage);
        $cleanedLanguage = str_replace(' ⏺', '', $rawLanguage);
        $localeCode = $this->convertLanguageToLocale($cleanedLanguage);
        //  \Log::info('Language selected: ' .  $localeCode);

         Log::info('newName API called', [
            'request' => $request->all()
        ]);

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                // 'regex:/^\d{12}$/',
                 'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
            ],
            'full_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!\d+$)(?!.*(?:हिन्दी ⏺|English ⏺))(?!^[A-Z]{2}[0-9]{4}$).*$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'full_name.required' => __('custom_validation.full_name.required'),
            'full_name.string' => __('custom_validation.full_name.string'),
            'full_name.max' => __('custom_validation.full_name.max'),
            'full_name.regex' => __('custom_validation.full_name.regex'),
        ]);

          if ($validator->fails()) {

                Log::warning('Validation failed', [
                    'errors' => $validator->errors()->toArray(),
                    'request' => $request->all()
                ]);

                return response()->json([
                    'error' => $validator->errors(),
                ], 422);
            }

            $mobile = $validator->validated()['phone'];

            // If 10 digits, prepend 91
            if (strlen($mobile) == 10) {
                $mobile = '91' . $mobile;
            }

        LatestWholesaler::updateOrCreate([
            'mobile_number' => $mobile
        ],[
            'full_name' => $validator->validated()['full_name'],
            'lang' => $localeCode,
        ]);

        return response()->json(['message' => 'Name saved successfully.'], 200);
    }

    public function newPincode(Request $request)
    {
        $this->setLocale($request->input('language', 'en'));

        $pincode = $request->input('pincode');
        $pincode = convertHindiToEnglishNumber($pincode);

        $request->merge(['pincode' => $pincode]);

        // Now pass the converted pincode to the validator
        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                // 'regex:/^\d{12}$/',
                'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
            ],
            'pincode' => [
                'required','string', 'regex:/^\d{6}$/',
                function ($attribute, $value, $fail) {
                    $pincode = Pincode::where('code', $value)->first();
                    if (!$pincode) {
                        $fail(__('custom_validation.pincode.invalid'));
                    }
                }
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'pincode.required' => __('custom_validation.pincode.required'),
            'pincode.string' => __('custom_validation.pincode.string'),
            'pincode.regex' => __('custom_validation.pincode.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $mobile = $validator->validated()['phone'];

        // If 10 digits, prepend 91
        if (strlen($mobile) == 10) {
            $mobile = '91' . $mobile;
        }

        LatestWholesaler::updateOrCreate([
            'mobile_number' => $mobile,
        ],[
            'pincode' => $validator->validated()['pincode'],
        ]);

        return response()->json(['message' => 'Pincode saved successfully.'], 200);
    }

    public function newUpiId(Request $request){
         $this->setLocale($request->input('language', 'en'));
         \Log::info('Language selected: ' . $request->input('language'));
          $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                // 'regex:/^\d{12}$/',
                'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
            ],
            'upi_id' => [
            'required',
            'string',
            'regex:/^[0-9A-Za-z.\-]{2,256}@(ibl|okhdfc|okicici|oksbi|okaxis|okhdfcbank|ybl|upi|axis|okbi|yesbankltd|axl|okbizicici|okbizaxis)$/i',
            ],
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'upi_id.required' => __('custom_validation.upi.required'),
            'upi_id.string' => __('custom_validation.upi.string'),
            'upi_id.regex' => __('custom_validation.upi.regex'),
        ]);

         if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $mobile = $validator->validated()['phone'];

        // If 10 digits, prepend 91
        if (strlen($mobile) == 10) {
            $mobile = '91' . $mobile;
        }

          LatestWholesaler::updateOrCreate([
            'mobile_number' => $mobile,
        ],[
            'upi_id' => $validator->validated()['upi_id'],
        ]);

        return response()->json(['message' => 'Upi Id saved successfully.'], 200);

    }

    public function newQuantumSale(Request $request){
        $this->setLocale($request->input('language', 'en'));
        $request->merge([
            'quantum_of_sale' => trim(preg_replace('/\s+/u', '', $request->input('quantum_of_sale')))
        ]);
        $validator = Validator::make($request->all(), [
             'phone' => [
                    'required',
                    'string',
                    // 'regex:/^\d{12}$/',
                    'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
                ],
                'quantum_of_sale' => [
                    'required',
                    'regex:/^(0|[1-9][0-9]*)(\.[0-9]+)?$/',
                ],
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'quantum_of_sale.required' => __('custom_validation.quantum_of_sale.required'),
            'quantum_of_sale.regex' => __('custom_validation.quantum_of_sale.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        $mobile = $validator->validated()['phone'];

        // If 10 digits, prepend 91
        if (strlen($mobile) == 10) {
            $mobile = '91' . $mobile;
        }

        LatestWholesaler::updateOrCreate([
            'mobile_number' => $mobile,
        ],[
            'quantum_of_sale' => $validator->validated()['quantum_of_sale'],
        ]);
        return response()->json(['message' => 'Qunatum of sale saved successfully.'], 200);
    }
    
    public function newCouponCode(Request $request){
        $this->setLocale($request->input('language', 'en'));

        $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                // 'regex:/^\d{12}$/',
                'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
            ],
            'coupon_code' => 'required|string'
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'coupon_code.required' => __('custom_validation.coupon_code.required'),
            'coupon_code.string' => __('custom_validation.coupon_code.string'),
        ]);

        \Log::info($request->coupon_code);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        // Normalize codes (split by space, newline, comma, tab)
        $rawCodes = preg_split('/[\s,]+/', trim($request->coupon_code));
        $couponCodes = array_filter(array_map('trim', $rawCodes));

        return $this->newProcessCoupons($couponCodes, $request->phone);
    }

    private function newProcessCoupons(array $couponCodes, $phone)
    {
        $wholesalerId = LatestWholesaler::whereMobileNumber($phone)->value('id');
        if (!$wholesalerId) {
            return response()->json(['message' => 'Wholesaler not found.'], 400);
        }

        $success = [];
        $failed = [];
        $currentOrderTotals = [];

        DB::beginTransaction();
        try {
            foreach ($couponCodes as $codeValue) {
                $code = LatestCode::with('brand')->where('code', $codeValue)->first();

                if (!$code) {
                    $failed[] = "❌ $codeValue - Invalid code";
                    continue;
                }

                if ($code->is_used) {
                    $failed[] = "❌ $codeValue - Code already used";
                    continue;
                }

                if (!$code->status) {
                    $failed[] = "❌ $codeValue - Code inactive";
                    continue;
                }

                // Create order
                LatestOrder::create([
                    'latest_wholesaler_id' => $wholesalerId,
                    'latest_code_id' => $code->id,
                    'value' => $code->value,
                    'brand_id' => $code->brand_id
                ]);

                // Update code
                $code->is_used = true;
                $code->used_at = now();
                $code->save();

                $brandName = $code->brand->name ?? 'Unknown';

                $success[] = [
                    'code' => $codeValue,
                    'brand' => $brandName,
                    'value' => $code->value
                ];

                // Track per-brand totals in this request
                $currentOrderTotals[$brandName] = ($currentOrderTotals[$brandName] ?? 0) + $code->value;
            }

            DB::commit();

            // All-time total order value per brand
            $brands = Brand::orderBy('name')->get();
            $orderTotals = LatestOrder::select('brand_id', DB::raw('SUM(value) as total_value'))
                ->where('latest_wholesaler_id', $wholesalerId)
                ->groupBy('brand_id')
                ->pluck('total_value', 'brand_id');

            $totalOrderValue = $brands->map(function ($brand) use ($orderTotals) {
                return [
                    'name' => $brand->name,
                    'total_value' => $orderTotals[$brand->id] ?? 0
                ];
            })->values();

            // Format current order totals into array
            $currentOrderValue = $brands->map(function ($brand) use ($currentOrderTotals) {
                return [
                    'name' => $brand->name,
                    'total_value' => $currentOrderTotals[$brand->name] ?? 0
                ];
            })->values();

            $wholesaler = LatestWholesaler::whereMobileNumber($phone)->first();
            if(!$wholesaler->lat || !$wholesaler->long){
                $lat = 0;
            }
            else{
                $lat = 1;
            }

            return response()->json([
                'message' => 'Bulk coupon codes processed.',
                'total_success' => count($success),
                'total_failed' => count($failed),
                'current_order_value' => $currentOrderValue,
                'total_order_value' => $totalOrderValue,
                'lat' => $lat,
                'failed_codes'  => implode("\n", $failed)
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong while processing bulk coupons.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

//    public function latestCouponCode(Request $request)
//     {
//         \Log::info('All data ', $request->all());
//         $this->setLocale($request->input('language', 'en'));

//         $validator = Validator::make($request->all(), [
//             'phone' => ['required','string','regex:/^\d{12}$/'],
//             'coupon_code' => [
//                 'required','string','size:13',
//                 function ($attribute, $value, $fail) {
//                     $coupon = LatestCode::where('code', $value)->first();
//                     if (!$coupon) $fail(__('custom_validation.coupon_code.invalid'));
//                     elseif ($coupon->is_used) $fail(__('custom_validation.coupon_code.used'));
//                     elseif (!$coupon->status) $fail(__('custom_validation.coupon_code.inactive'));
//                 }
//             ]
//         ], [
//             'phone.required' => __('custom_validation.phone.required'),
//             'phone.string' => __('custom_validation.phone.string'),
//             'phone.regex' => __('custom_validation.phone.regex'),
//             'coupon_code.required' => __('custom_validation.coupon_code.required'),
//             'coupon_code.string' => __('custom_validation.coupon_code.string'),
//             'coupon_code.size' => __('custom_validation.coupon_code.size')
//         ]);

//         if ($validator->fails()) {
//             return response()->json(['error' => $validator->errors()], 422);
//         }

//         DB::beginTransaction();
//         try {
//             $wholesaler = LatestWholesaler::whereMobileNumber($validator->validated()['phone'])->first();
//             if(!$wholesaler) return response()->json(['message' => 'Wholesaler not found.'], 400);

//             $code = LatestCode::with('brand')->whereCode($validator->validated()['coupon_code'])->first();

//             // Punch order
//             $order = LatestOrder::create([
//                 'latest_wholesaler_id' => $wholesaler->id,
//                 'latest_code_id' => $code->id,
//                 'value' => $code->value,
//                 'brand_id' => $code->brand_id
//             ]);

//             $code->update([
//                 'is_used' => true,
//                 'used_at' => now()
//             ]);

//             // Total order value per brand
//             $brands = Brand::orderBy('name')->get();
//             $orderTotals = LatestOrder::select('brand_id', DB::raw('SUM(value) as total_value'))
//                 ->where('latest_wholesaler_id', $wholesaler->id)
//                 ->groupBy('brand_id')
//                 ->pluck('total_value', 'brand_id');

//             $totalOrderValue = $brands->map(fn($brand) => [
//                 'name' => $brand->name,
//                 'total_value' => $orderTotals[$brand->id] ?? 0
//             ])->values();
//             \Log::info('📩 WATI Webhook Data: ', $totalOrderValue);

//             DB::commit();

//             return response()->json([
//                 'message' => 'Coupon code saved successfully.',
//                 'current_order_value' => $code->value,
//                 'total_order_value' => $totalOrderValue,
//                 'current_order_brand' => $code->brand->name ?? null,
//             ]);

//         } catch (\Throwable $e) {
//             DB::rollBack();
//             return response()->json([
//                 'message' => 'Something went wrong while saving the coupon.',
//                 'error' => $e->getMessage()
//             ], 500);
//         }
//     }

public function latestCouponCode(Request $request)
{
     $this->setLocale($request->input('language', 'en'));

    // Step 1: Validate input
    $validator = Validator::make($request->all(), [
        'phone' => ['required','string','regex:/^(\d{10}|\d{12})$/',],
        'coupon_code' => [
            'required','string',
            function ($attribute, $value, $fail) {
                $coupon = LatestCode::where('code', $value)->first();
                if (!$coupon) {
                    $fail(__('custom_validation.coupon_code.invalid'));
                } elseif ($coupon->is_used) {
                    $fail(__('custom_validation.coupon_code.used'));
                } elseif (!$coupon->status) {
                    $fail(__('custom_validation.coupon_code.inactive'));
                }
            }
        ]
    ], [
        'phone.required' => __('custom_validation.phone.required'),
        'phone.string' => __('custom_validation.phone.string'),
        'phone.regex' => __('custom_validation.phone.regex'),
        'coupon_code.required' => __('custom_validation.coupon_code.required'),
        'coupon_code.string' => __('custom_validation.coupon_code.string'),
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => $validator->errors(), // For WATI: {{coupon_code_error}} or {{all_coupon_errors}}
        ], 422);
    }

    DB::beginTransaction();
    try {
        // $phone = $validator->validated()['phone'];
        $phone = $validator->validated()['phone'];

        // If 10 digits, prepend 91
        if (strlen($phone) == 10) {
            $phone = '91' . $phone;
        }

        $couponCode = $validator->validated()['coupon_code'];

        // Get wholesaler
        $wholesaler = LatestWholesaler::whereMobileNumber($phone)->first();
        if (!$wholesaler) {
            return response()->json([
                'message' => 'Wholesaler not found.',
                'error' => ['coupon_code' => ["❌ {$couponCode} - Wholesaler not found"]],
            ], 400);
        }

        if($request->input('language')){
            $rawLanguage1 = $request->input('language');
            $cleanedLanguage1 = str_replace(' ⏺', '', $rawLanguage1);
            $localeCode1 = $this->convertLanguageToLocale($cleanedLanguage1);

            if($localeCode1 != $wholesaler->lang){
                LatestWholesaler::whereMobileNumber($phone)->update([
                    'lang' => $localeCode1
                ]);
            }
         }

        // Get coupon
        $coupon = LatestCode::with('brand')->whereCode($couponCode)->first();

        // Punch order
        $order = LatestOrder::create([
            'latest_wholesaler_id' => $wholesaler->id,
            'latest_code_id' => $coupon->id,
            'value' => $coupon->value,
            'brand_id' => $coupon->brand_id
        ]);

        // Mark coupon as used
        $coupon->update([
            'is_used' => true,
            'used_at' => now()
        ]);

        // Calculate total order values per brand
        $brands = Brand::orderBy('name')->get();
        // $orderTotals = LatestOrder::select('brand_id', DB::raw('SUM(value) as total_value'))
        //     ->where('latest_wholesaler_id', $wholesaler->id)
        //     ->groupBy('brand_id')
        //     ->pluck('total_value', 'brand_id');

        // $totalOrderValue = $brands->map(fn($brand) => [
        //     'name' => $brand->name,
        //     'total_value' => $orderTotals[$brand->id] ?? 0
        // ])->values();
        $totalOrderValue = LatestOrder::where('latest_wholesaler_id', $wholesaler->id)
                            ->pluck('value')
                            ->sum(function ($value) {
                                return (float) $value;
                            });

        $totalOrderValue1 = number_format($totalOrderValue, 2, '.', '');

        if(!$wholesaler->lat || !$wholesaler->long){
            $lat = 0;
        }else{
            $lat = 1;
        }
        // \Log::info('Total Value', [
        //     'total_order_value' => $totalOrderValue->toArray()
        // ]);

        $formattedCouponValue = rtrim(rtrim($coupon->value, '0'), '.');


        DB::commit();

        return response()->json([
            'message' => 'Coupon code saved successfully.',
            'current_order_value' => $formattedCouponValue,
            'current_order_brand' => $coupon->brand->name ?? null,
            'total_order_value' => $totalOrderValue1,
            'lat' => $lat
        ], 200);

    } catch (\Throwable $e) {
        DB::rollBack();
        \Log::error('Error saving coupon', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Something went wrong while saving the coupon.',
            'error' => ['coupon_code' => ["❌ {$couponCode} - {$e->getMessage()}"]],
        ], 500);
    }
}

private function packsToRupees(int $packs): int
{
    return match ($packs) {
        40  => 50,
        100 => 150,
        200 => 400,
        default => 0, // safety fallback
    };
}


public function newUserType(Request $request){    
    $this->setLocale($request->input('language', 'en'));
 
    $validator = Validator::make($request->all(), [
        'phone' => ['required','string'],
        'user_type' => [
            'required','string',
        ]
    ], [
        'phone.required' => __('custom_validation.phone.required'),
        'phone.string' => __('custom_validation.phone.string'),
        // 'phone.regex' => __('custom_validation.phone.regex'),
        'user_type.required' => __('custom_validation.user_type.required'),
        'user_type.string' => __('custom_validation.user_type.string'),
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => $validator->errors(), // For WATI: {{coupon_code_error}} or {{all_coupon_errors}}
        ], 422);
    }

    $value = $validator->validated()['user_type'];

    $mapping = [
        'होलसेलर' => 'Wholesaler',
        'रिटेलर' => 'Retailer',
        'हॉकर' => 'Hawker',
        'એસડબ્લ્યુડી' => 'SWD',
        'રિટેલર' => 'Retailer',
        'હોકર' => 'Hawker',
        'Wholesaler' => 'Wholesaler',
        'Retailer' => 'Retailer',
        'Hawker' => 'Hawker',
    ];

    $englishValue = $mapping[$value]; 
    $mobile = $validator->validated()['phone'];

    // If 10 digits, prepend 91
    if (strlen($mobile) == 10) {
        $mobile = '91' . $mobile;
    }

    LatestWholesaler::updateOrCreate([
        'mobile_number' => $mobile,
    ],[
        'type' => $englishValue,
    ]);
    return response()->json(['message' => 'User type saved successfully.'], 200);
}

public function getTLMobileNumber(Request $request){
    $this->setLocale($request->input('language', 'en'));
          $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ],
            // 'upi_id' => [
            // 'required',
            // 'string',
            // 'regex:/^[0-9A-Za-z.\-]{2,256}@(ibl|okhdfc|okicici|oksbi|okaxis|okhdfcbank|ybl|upi|axis|okbi|yesbankltd|axl|okbizicici|okbizaxis)$/i',
            // ],
            'tl_mobile_number' => [
            'required','string','regex:/^\d{10}$/',
                function ($attribute, $value, $fail) {
                    $tl = TeamLeader::where('mobile_number', $value)->exists();
                    if (!$tl) {
                        $fail(__('custom_validation.tl_mobile_number.invalid'));
                        return;
                    } 
                    // elseif ($coupon->is_used) {
                    //     $fail(__('custom_validation.coupon_code.used'));
                    // } elseif (!$coupon->status) {
                    //     $fail(__('custom_validation.coupon_code.inactive'));
                    // }
                }
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
            'tl_mobile_number.required' => __('custom_validation.tl_mobile_number.required'),
            'tl_mobile_number.string' => __('custom_validation.tl_mobile_number.string'),
            'tl_mobile_number.regex' => __('custom_validation.tl_mobile_number.regex'),
        ]);

         if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

        //   LatestWholesaler::updateOrCreate([
        //     'mobile_number' => $validator->validated()['phone'],
        // ],[
        //     'upi_id' => $validator->validated()['upi_id'],
        // ]);

        $tlData = TeamLeader::where('mobile_number',$validator->validated()['tl_mobile_number'])->first();

       if ($tlData) {
            LatestWholesaler::updateOrCreate([
                'mobile_number' => $validator->validated()['phone'],
            ],[
                'team_leader_id' => $tlData->id,
            ]);
            return response()->json(['message' => 'Team Leader exists.',
                'data' => [
                    'tl_name' => $tlData->name,
                ]
            ], 200);
        } 

        // return response()->json(['message' => 'tl updated saved successfully.'], 200);
}

public function latestHasLocation(Request $request){
    $validator = Validator::make($request->all(), [
            'phone' => [
                'required',
                'string',
                'regex:/^\d{12}$/',
            ]
        ], [
            'phone.required' => __('custom_validation.phone.required'),
            'phone.string' => __('custom_validation.phone.string'),
            'phone.regex' => __('custom_validation.phone.regex'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 422);
        }

         $wholesaler = LatestWholesaler::whereMobileNumber($validator->validated()['phone'])->first();
         if(!$wholesaler->lat || !$wholesaler->long){
                return response()->json(['message' => 'Lat Long do not exist'], 500);
            }else{
                // $lat = 1;
                 return response()->json(['message' => 'Lat Long exist'], 200);
            }
}

public function checkSummary(Request $request){
    $this->setLocale($request->input('language', 'en'));
    $validator = Validator::make($request->all(), [
        'phone' => [
            'required',
            'string',
            'regex:/^(\d{10}|\d{12})$/', // Allow 10 or 12 digits
        ]
    ], [
        'phone.required' => __('custom_validation.phone.required'),
        'phone.string' => __('custom_validation.phone.string'),
        'phone.regex' => __('custom_validation.phone.regex'),
    ]);

    if ($validator->fails()) {
        Log::warning('Phone validation failed', [
            'errors' => $validator->errors()->toArray()
        ]);

        return response()->json([
            'message' => $validator->errors()->first()
        ], 422);
    }

    $mobile = $validator->validated()['phone'];

    // If 10 digits, prepend 91
    if (strlen($mobile) == 10) {
        $mobile = '91' . $mobile;
    }

    $wholesaler = LatestWholesaler::whereMobileNumber($mobile)->first();

    if(!$wholesaler)
    {
        Log::warning('Wholesaler not found', [
            'phone' => $mobile
        ]);
        return response()->json(['message' => 'Wholesaler does not exists.'], 400);
    }

    $totalOrderValue = LatestOrder::where('latest_wholesaler_id', $wholesaler->id)
                            ->pluck('value')
                            ->sum(function ($value) {
                                return (float) $value;
                            });

    $total_order_value_sum = number_format($totalOrderValue, 2, '.', '');

     return response()->json([
            'message' => 'Summary Details',
            'total_order_value_sum' => $total_order_value_sum
        ], 200);
}


}
