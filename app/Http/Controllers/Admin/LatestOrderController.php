<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{LatestOrder};
use DB;

class LatestOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('latest_order_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.latest-orders.index');
    }

    public function latestOrderList(Request $request)
    {
        $wdId = $request->get('wd_id');
        $brandId = $request->get('brand_id');
        $wholesalerId = $request->get('wholesaler_id');

         $order = LatestOrder::with(['latestWholesaler', 'latestCode', 'brand'])
        ->when($wdId, function ($query) use ($wdId) {
            $query->whereHas('latest_code', function ($q) use ($wdId) {
                $q->where('latest_wd_id', $wdId);
            });
        })
        ->when($brandId, function ($query, $brandId) {
            return $query->where('brand_id', $brandId);
        })
         ->when($wholesalerId, function ($query, $wholesalerId) {
            return $query->where('latest_wholesaler_id', $wholesalerId);
        })
        ->get();
   
        return DataTables::of($order)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $delete = Order::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete wholesaler.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
