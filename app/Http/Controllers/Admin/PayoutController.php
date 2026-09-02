<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{Payout};

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payouts.index');
    }

    public function payoutList(Request $request){
        $wholesaler_id = $request->get('wholesaler_id');
        $payout_status = $request->get('payout_status');

        $payout_status = isset($payout_status) ? (int)$payout_status : null;
        $payouts = Payout::with('wholesaler')
        ->when($wholesaler_id, function($query) use ($wholesaler_id){
            $query->where('wholesaler_id', $wholesaler_id);
        })
        ->when(!is_null($payout_status), function($query) use ($payout_status) {
            $query->where('status', $payout_status);
        })
        ->get();
        return Datatables::of($payouts)->make(true);
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
        //
    }
}
