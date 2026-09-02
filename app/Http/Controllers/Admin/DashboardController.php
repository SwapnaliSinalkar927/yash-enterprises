<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Wholesaler,Code,WholesalerLoginHistory,Payout,Order,WD,Pincode,State,City,LatestWholesaler,LatestCode,LatestOrder,LatestWD};
use DB;
use DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function countData(){
        // $wholesalerCount = LatestWholesaler::count();
        $regionSession = Session::get('region');
     
        $totalCodeQuery = LatestCode::query();
        $usedCodeQuery  = LatestCode::query();
        $ordersQuery    = LatestOrder::query();
        $wdsQuery       = LatestWD::query();

        // Apply region filter only if session region exists
        if (!empty($regionSession)) {
            $totalCodeQuery->whereHas('latestWd', function($query) use ($regionSession) {
                $query->where('region', $regionSession);
            });

            $usedCodeQuery->whereHas('latestWd', function($query) use ($regionSession) {
                $query->where('region', $regionSession);
            });

            $ordersQuery->whereHas('latestCode.latestWd', function($query) use ($regionSession) {
                $query->where('region', $regionSession);
            });

            $wdsQuery->where('region', $regionSession);
        }
        
        // Get counts
        $totalCode = $totalCodeQuery->count();
        $usedCode  = $usedCodeQuery->where('is_used', 1)->count();
        $orders    = $ordersQuery->count();
        $wds       = $wdsQuery->count();

        if (!empty($regionSession)) {
            $swd = LatestWholesaler::where('type', 'SWD')
                ->whereHas('latestOrders.latestCode.latestWd', function ($query) use ($regionSession) {
                    $query->where('region', $regionSession);
                })
                ->count();

            $retailer = LatestWholesaler::where('type', 'Retailer')
                ->whereHas('latestOrders.latestCode.latestWd', function ($query) use ($regionSession) {
                    $query->where('region', $regionSession);
                })
                ->count();

            $hawker = LatestWholesaler::where('type', 'Hawker')
                ->whereHas('latestOrders.latestCode.latestWd', function ($query) use ($regionSession) {
                    $query->where('region', $regionSession);
                })
                ->count();
        } else {
            // No region filter
            $swd = LatestWholesaler::where('type', 'SWD')->count();
            $retailer = LatestWholesaler::where('type', 'Retailer')->count();
            $hawker = LatestWholesaler::where('type', 'Hawker')->count();
        }

        $data = [
            'swd' => $swd,
            'retailer' => $retailer,
            'hawker' => $hawker,
            'totalCode' => $totalCode,
            'usedCode' => $usedCode,
            'orders' => $orders,
            'wds' => $wds
        ];

        // dd($data);
        return response()->json($data);
    }

    public function wholesalerParticipation(Request $request){
    //     // Latest Order Date
    //     $latestDate = Order::max('created_at');
    //     $latestDate = Carbon::parse($latestDate);

    
    //    // Calculate the last 7 days
    //     $startDate = $latestDate->copy()->subDays(6)->startOfDay();

    //   // Query to get orders grouped by date for the last 7 days
    //     $orderData = Order::selectRaw('DATE(created_at) as order_date, COUNT(*) as order_count')
    //     ->whereBetween('created_at', [$startDate, $latestDate->endOfDay()])
    //     ->groupBy('order_date')
    //     ->orderBy('order_date', 'desc')
    //     ->get();

    //     $lastSevenDays = [];
    //     for ($i = 0; $i < 7; $i++) {
    //         $date = $latestDate->copy()->subDays($i)->toDateString();
    //         $orderCount = $orderData->firstWhere('order_date', $date)?->order_count ?? 0;
    //         $lastSevenDays[] = [
    //             'date' => $date,
    //             'order_count' => $orderCount,
    //         ];
    //     }
    //     $lastSevenDays = collect($lastSevenDays)->sortBy('date')->values()->all();

    // Latest Order Date
        $regionSession = Session::get('region');

        // Get latest order date
        $latestDate = LatestOrder::max('created_at');
        if (!$latestDate) {
            return response()->json([]); // no data
        }

        $latestDate = Carbon::parse($latestDate);

        // Calculate last 7 days range
        $startDate = $latestDate->copy()->subDays(6)->startOfDay();

        // Build query for order counts (with optional region filter)
        $orderData = LatestOrder::selectRaw('DATE(created_at) as order_date, COUNT(*) as order_count')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestCode.latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->whereBetween('created_at', [$startDate, $latestDate->endOfDay()])
            ->groupBy('order_date')
            ->orderBy('order_date', 'desc')
            ->get();

        // Prepare last 7 days array (even for missing days)
        $lastSevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $latestDate->copy()->subDays($i)->toDateString();
            $orderCount = $orderData->firstWhere('order_date', $date)?->order_count ?? 0;

            $lastSevenDays[] = [
                'date' => $date,
                'order_count' => $orderCount,
            ];
        }

        $lastSevenDays = collect($lastSevenDays)->sortBy('date')->values()->all();

        return response()->json($lastSevenDays);
    }

    public function topWholesalerList(){
        // $wholesalers = Wholesaler::with('orders') // Include the `wd` relationship
        //             ->withCount('orders') // Count related `orders`
        //             ->having('orders_count', '>', 0)
        //             ->orderBy('orders_count', 'desc') // Order by the order count in descending order
        //             ->limit(10) // Limit to the top 10
        //             ->get();

        // $wholesalers = $wholesalers->map(function ($wholesaler) {
        //     $brandSums = $wholesaler->orders
        //         ->groupBy('brand_id')
        //         ->map(function ($orders, $brandId) {
        //             return [
        //                 'brand_id' => $brandId,
        //                 'brand_name' => optional($orders->first()->brand)->name,
        //                 'total_value' => $orders->sum('value'),
        //             ];
        //         })->values();

        //     $wholesaler->brand_sums = $brandSums;
        //     return $wholesaler;
        // });
                    $regionSession = Session::get('region');

                $wholesalers = LatestWholesaler::with('latestOrders.brand') // Include orders + brand
                ->withCount(['latestOrders as latest_orders_count' => function ($query) use ($regionSession) {
                    // Apply region filter inside the count query
                    if (!empty($regionSession)) {
                        $query->whereHas('latestCode.latestWd', function ($q) use ($regionSession) {
                            $q->where('region', $regionSession);
                        });
                    }
                }])
                ->when(!empty($regionSession), function ($query) use ($regionSession) {
                    // Apply region filter for the main query too
                    $query->whereHas('latestOrders.latestCode.latestWd', function ($q) use ($regionSession) {
                        $q->where('region', $regionSession);
                    });
                })
                ->having('latest_orders_count', '>', 0)
                ->orderBy('latest_orders_count', 'desc')
                ->limit(10)
                ->get();

            // Map brand-wise totals for each wholesaler
            $wholesalers = $wholesalers->map(function ($wholesaler) use ($regionSession) {
                $filteredOrders = $wholesaler->latestOrders;

                // Filter orders by region again (for safety)
                if (!empty($regionSession)) {
                    $filteredOrders = $filteredOrders->filter(function ($order) use ($regionSession) {
                        return optional($order->latestCode->latestWd)->region === $regionSession;
                    });
                }

                $brandSums = $filteredOrders
                    ->groupBy('brand_id')
                    ->map(function ($orders, $brandId) {
                        return [
                            'brand_id'   => $brandId,
                            'brand_name' => optional($orders->first()->brand)->name,
                            'total_value'=> $orders->sum('value'),
                        ];
                    })->values();

                $wholesaler->brand_sums = $brandSums;
                return $wholesaler;
            });

        // dd($wholesalers);

        return Datatables::of($wholesalers)->make(true);
    }

    public function locationWiseSale(){
        // $ordersByBrand = Order::join('codes', 'orders.code_id', '=', 'codes.id')
        //                 ->join('wds', 'codes.wd_id', '=', 'wds.id')
        //                 ->select(
        //                     'wds.id as brand_id',
        //                     'wds.code as brand_name',
        //                     'wds.location',
        //                     'wds.tb'
        //                 )
        //                 ->selectRaw('SUM(orders.value) as total_value')
        //                 ->groupBy('wds.id', 'wds.code', 'wds.location', 'wds.tb')
        //                 ->orderByDesc('total_value') // or ->orderBy('total_value', 'desc')
        //                 ->limit(5)
        //                 ->get();

        //   $ordersByLocation = LatestOrder::join('latest_wholesalers', 'latest_orders.latest_wholesaler_id', '=', 'latest_wholesalers.id')
        //                 // ->join('latest_wds', 'latest_codes.latest_wd_id', '=', 'latest_wds.id')
        //                 ->select(
        //                     'latest_wholesalers.id as wholesaler_id',
        //                     'latest_wholesalers.pincode as wholesaler_pincode',
        //                 )
        //                 ->selectRaw('SUM(latest_orders.value) as total_value')
        //                 ->groupBy('latest_wholesalers.id', 'latest_wholesalers.pincode')
        //                 ->orderByDesc('total_value') // or ->orderBy('total_value', 'desc')
        //                 ->limit(5)
        //                 ->get();

       $regionSession = Session::get('region');

        $ordersByLocation = LatestOrder::join('latest_wholesalers', 'latest_orders.latest_wholesaler_id', '=', 'latest_wholesalers.id')
            ->join('latest_codes', 'latest_orders.latest_code_id', '=', 'latest_codes.id')
            ->join('latest_wds', 'latest_codes.latest_wd_id', '=', 'latest_wds.id')
            ->select(
                'latest_wholesalers.pincode as wholesaler_pincode',
                DB::raw('COUNT(DISTINCT latest_wholesalers.id) as wholesaler_count'),
                DB::raw('SUM(latest_orders.value) as total_value')
            )
            ->whereNotNull('latest_wholesalers.pincode')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->where('latest_wds.region', $regionSession);
            })
            ->groupBy('latest_wholesalers.pincode')
            ->orderByDesc('total_value')
            ->limit(5)
            ->get();
                      
        return response()->json($ordersByLocation);

    }

    public function wdWiseSale(){
        //  $ordersByBrand = LatestOrder::join('latest_codes', 'latest_orders.latest_code_id', '=', 'latest_codes.id')
        //                 ->join('latest_wds', 'latest_codes.latest_wd_id', '=', 'latest_wds.id')
        //                 ->select(
        //                     'latest_wds.id as wd_id',
        //                     'latest_wds.code as wd_code',
        //                     'latest_wds.location',
        //                     'latest_wds.tb'
        //                 )
        //                 ->selectRaw('SUM(latest_orders.value) as total_value')
        //                 ->groupBy('latest_wds.id', 'latest_wds.code', 'latest_wds.location', 'latest_wds.tb')
        //                 ->orderByDesc('total_value') // or ->orderBy('total_value', 'desc')
        //                 ->limit(5)
        //                 ->get();

        $regionSession = Session::get('region');

        $ordersByBrand = LatestOrder::join('latest_codes', 'latest_orders.latest_code_id', '=', 'latest_codes.id')
            ->join('latest_wds', 'latest_codes.latest_wd_id', '=', 'latest_wds.id')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->where('latest_wds.region', $regionSession);
            })
            ->select(
                'latest_wds.id as wd_id',
                'latest_wds.code as wd_code',
                'latest_wds.location',
                'latest_wds.tb'
            )
            ->selectRaw('
                SUM(latest_orders.value) as total_value,
                COUNT(DISTINCT latest_orders.latest_wholesaler_id) as unique_wholesalers
            ')
            ->groupBy('latest_wds.id', 'latest_wds.code', 'latest_wds.location', 'latest_wds.tb')
            ->orderByDesc('total_value')
            ->limit(5)
            ->get();

        return response()->json($ordersByBrand);
        // dd($ordersByBrand);
    }

    public function payoutData(){

        $totalPayout = WholesalerLoginHistory::count();
        $payoutCredited = Payout::where('status',1)->count();
        $payoutFailed = Payout::where('status',0)->count();
        $payoutProcessing = Payout::where('status',2)->count();
        $payoutPending = $totalPayout - ($payoutCredited+$payoutFailed+$payoutProcessing);

        $data = [
            'payoutCredited' => $payoutCredited,
            'payoutFailed' => $payoutFailed,
            'payoutProcessing' => $payoutProcessing,
            'payoutPending' => $payoutPending,
        ];

        return response()->json($data);
    }

    public function brandWiseSale(){
        $ordersByBrand = Order::selectRaw('brand_id, SUM(value) as total_value')
            ->groupBy('brand_id')
            ->get();

        // Optionally, map brand names
        $data = $ordersByBrand->map(function ($order) {
            $brandName = optional($order->brand)->name ?? 'Unknown';
            return [
                'brand' => $brandName,
                'value' => (int) $order->total_value,
            ];
        });

        return response()->json($data);
    }

    public function wholesalerLoginHistory(){
        $latestDate = WholesalerLoginHistory::max('created_at');

        // If you want it as Carbon instance
        $latestDate = Carbon::parse($latestDate);

        $startDate = $latestDate->copy()->subDays(6)->startOfDay();

        $loginData = WholesalerLoginHistory::selectRaw('DATE(created_at) as login_date, COUNT(*) as value')
            ->whereBetween('created_at', [$startDate, $latestDate])
            ->groupBy('login_date')
            ->orderBy('login_date')
            ->get()
            ->keyBy('login_date');

        // Prepare chart data
        $chartData = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateStr = $date->toDateString();

            $chartData[] = [
                'date' => $date->timestamp * 1000,
                'value' => $loginData[$dateStr]->value ?? 0,
                'bullet' => $i === 6
            ];
        }
        // dd($chartData);
        return response()->json($chartData);
    }

    public function orderByUsertype(){
        $regionSession = Session::get('region');

        // SWD Orders
        $swdOrders = LatestOrder::whereHas('latestWholesaler', function ($query) {
                $query->where('type', 'SWD');
            })
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestCode.latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->sum('value');

        // Retailer Orders
        $retailerOrders = LatestOrder::whereHas('latestWholesaler', function ($query) {
                $query->where('type', 'Retailer');
            })
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestCode.latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->sum('value');

        // Hawker Orders
        $hawkerOrders = LatestOrder::whereHas('latestWholesaler', function ($query) {
                $query->where('type', 'Hawker');
            })
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestCode.latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->sum('value');

        $data = [
            'swdOrders' => $swdOrders,
            'retailerOrders' => $retailerOrders,
            'hawkerOrders' => $hawkerOrders
        ];

        return response()->json($data);
    }

    public function couponUtilization(){
       $regionSession = Session::get('region');

        // Coupon 0.5 used
        $couponUsed06 = LatestCode::where('is_used', '1')
            ->where('value', '0.60')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

        // Coupon 0.5 total
        $coupon06 = LatestCode::where('value', '0.60')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

        // Coupon 1 used
        $couponUsed20 = LatestCode::where('is_used', '1')
            ->where('value', '2.00')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

        // Coupon 1 total
        $coupon20 = LatestCode::where('value', '2.00')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

         // Coupon 1 used
        $couponUsed50 = LatestCode::where('is_used', '1')
            ->where('value', '2.00')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

        // Coupon 1 total
        $coupon50 = LatestCode::where('value', '5.00')
            ->when(!empty($regionSession), function ($query) use ($regionSession) {
                $query->whereHas('latestWd', function ($q) use ($regionSession) {
                    $q->where('region', $regionSession);
                });
            })
            ->count();

       $data = [
            'couponUsed06' => $couponUsed06,
            'coupon06' => $coupon06,
            'couponUsed20' => $couponUsed20,
            'coupon20' => $coupon20,
            'couponUsed50' => $couponUsed50,
            'coupon50' => $coupon50,
        ];
        // dd($data);

        return response()->json($data);
    }

    public function setRegionSession(Request $request){
        // dd($request->input('region'));
        $region = $request->input('region');
       Session::put('region',  $request->input('region'));

        $data = [
            'message' => 'Region session set successfully',
        ];
          return response()->json(['success' => true]);
    }
}
