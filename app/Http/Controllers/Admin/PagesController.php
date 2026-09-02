<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Customer,LoginHistory,WholesalerLoginHistory,Wholesaler,State,Order,LatestWD,LatestWholesaler,LatestOrder};
use Gate;
use DataTables;
use DB;
use App\Http\Controllers\Admin\DashboardController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\CustomerPayoutAccount;

class PagesController extends Controller
{
    public function index()
    {
    //    $regions = LatestWD::whereNotNull('region')
    //                 ->where('region', '!=', '')
    //                 ->distinct()
    //                 ->pluck('region');
    //     $regionSession = Session::get('region');
        // dd($regions);

        // $wholesaler = LatestWholesaler::where('mobile_number',"1234123233")->first();

        // $totalOrderValue = LatestOrder::where('latest_wholesaler_id', $wholesaler->id)
        //                     ->pluck('value')
        //                     ->sum(function ($value) {
        //                         return (float) $value;
        //                     });
        // dd($totalOrderValue);


        return view('admin.pages.index');
    }

    public function profile()
    {
        $currentUser = \Auth::user();
        $currentUser->load('roles:id,slug,name');

        return view('admin.pages.profile', compact('currentUser'));
    }

    public function loginHistory()
    {
        if(Gate::denies('login_history_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        // $loginHistories = LoginHistory::with('user:id,name')->get();
        return view('admin.pages.login-histories');
    }
    public function loginHistoryList()
    {
        $loginHistories = LoginHistory::with('user:id,name')->get();
        // return view('admin.pages.login-histories', compact('loginHistories'));
        return Datatables::of($loginHistories)->make(true);
    }

    public function homePage()
    {
        return view('admin.dashboard');
    }

    public function makePayout(){
        // $name = "Swapnali Sinalkar";
        // $mobile = "8669271864";
        // $upiId = "8669271864@ybl";
        // $amount = "1";

        $name = "Komal Sapkal";
        $mobile = "7666463502";
        $upiId = "komalsapkalsk08@okicici";
        $amount = "1";

        $key = 'rzp_test_T522Q8RQTKFq74';
        $secret = 'r02sh9JXM1OeQ3zpWqOv1EX8';

        $account = CustomerPayoutAccount::where('customer_mobile', $mobile)->first();

        if (!$account) {

            // Create Contact
            $contactPayload = [
                'name'    => $name,
                'contact' => $mobile,
                'type'    => 'customer'
            ];

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://api.razorpay.com/v1/contacts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_USERPWD => $key . ':' . $secret,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
                CURLOPT_POSTFIELDS => json_encode($contactPayload),
            ]);

            $contactResponse = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (empty($contactResponse['id'])) {
                return response()->json([
                    'success' => false,
                    'response' => $contactResponse
                ]);
            }

            // Create Fund Account
            $fundPayload = [
                'account_type' => 'vpa',
                'contact_id'   => $contactResponse['id'],
                'vpa' => [
                    'address' => $upiId
                ]
            ];

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://api.razorpay.com/v1/fund_accounts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_USERPWD => $key . ':' . $secret,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
                CURLOPT_POSTFIELDS => json_encode($fundPayload),
            ]);

            $fundResponse = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (empty($fundResponse['id'])) {
                return response()->json([
                    'success' => false,
                    'response' => $fundResponse
                ]);
            }

            $account = CustomerPayoutAccount::create([
                'customer_name'   => $name,
                'customer_mobile' => $mobile,
                'contact_id'      => $contactResponse['id'],
                'fund_account_id' => $fundResponse['id'],
                'vpa_address'     => $upiId,
                'account_type'    => 'vpa',
                'is_active'       => 1,
            ]);
        }

        // Create Payout
        $payoutPayload = [
            'account_number'       => "2323230062819289",
            'fund_account_id'      => $account->fund_account_id,
            'amount'               => $amount * 100,
            'currency'             => 'INR',
            'mode'                 => 'UPI',
            'purpose'              => 'refund',
            'queue_if_low_balance' => true,
            'reference_id'         => 'REF_' . time(),
            'narration'            => 'Customer Payout'
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.razorpay.com/v1/payouts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_USERPWD => $key . ':' . $secret,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($payoutPayload),
        ]);

        $payoutResponse = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $accountUpdate = CustomerPayoutAccount::where('id',$account->id)->update([
            'pay_id' => $payoutResponse['id'] ?? null,
        ]);

        return response()->json($payoutResponse);
    }

    public function checkPayoutStatus(Request $request)
    {
        $payoutId = 'pout_T52wL1y6Q8tND7';

        $key = 'rzp_test_T522Q8RQTKFq74';
        $secret = 'r02sh9JXM1OeQ3zpWqOv1EX8';

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.razorpay.com/v1/payouts/' . $payoutId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $key . ':' . $secret,
            CURLOPT_HTTPGET => true,
        ]);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            return response()->json([
                'success' => false,
                'message' => curl_error($ch)
            ], 500);
        }

        curl_close($ch);

        $payoutDetails = json_decode($response, true);

        dd($payoutDetails);

        // return response()->json([
        //     'success'       => true,
        //     'payout_id'     => $payoutDetails['id'] ?? null,
        //     'status'        => $payoutDetails['status'] ?? null,
        //     'amount'        => isset($payoutDetails['amount'])
        //                         ? $payoutDetails['amount'] / 100
        //                         : null,
        //     'utr'           => $payoutDetails['utr'] ?? null,
        //     'reference_id'  => $payoutDetails['reference_id'] ?? null,
        //     'description'   => $payoutDetails['status_details']['description'] ?? null,
        //     'full_response' => $payoutDetails
        // ]);
    }

}
