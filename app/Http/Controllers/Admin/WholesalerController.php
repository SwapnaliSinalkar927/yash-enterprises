<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{Wholesaler,State,City,Pincode,Code,WholesalerLoginHistory,WholesalerPaymentDetail,Payout,Order,WD};
use App\Http\Requests\{AdminStoreWholesalerRequest,ImportRequest,AdminEditWholesalerRequest};
use App\Imports\WholesalerImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class WholesalerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('wholesaler_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.wholesalers.index');
    }

    public function wholesalerList(Request $request){
        $wholesalers = Wholesaler::all();
        return Datatables::of($wholesalers)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('wholesaler_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.wholesalers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreWholesalerRequest $request)
    {
        $createWholesaler= Wholesaler::create($request->validated());

        if($createWholesaler){
            return redirect()->route('admin.wholesalers.index')->with([
                'status' => 'success',
                'message'  => 'Wholesaler Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.wholesalers.index')->with([
                'status' => 'success',
                'message'  => 'Wholesaler not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('wholesaler_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wholesaler = Wholesaler::where('id', $id)->first();
        // $code_used = 24;
        $total_orders = Order::where('wholesaler_id',$wholesaler->id)->count();
        $total_brand_count = Order::where('wholesaler_id', $wholesaler->id)
                            ->join('brands', 'orders.brand_id', '=', 'brands.id')
                            ->select('orders.brand_id', 'brands.name as brand_name', DB::raw('SUM(orders.value) as total_value'))
                            ->groupBy('orders.brand_id', 'brands.name')
                            ->get();
        // dd($total_brand_count);
        $data_count = [
            'total_orders' => $total_orders,
            'total_brand_count' => $total_brand_count
        ];

        return view('admin.wholesalers.show',compact('wholesaler','data_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('wholesaler_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wholesaler = Wholesaler::where('id',$id)->first();

        return view('admin.wholesalers.edit',compact('wholesaler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditWholesalerRequest $request, string $id)
    {
        $updateWholesaler = Wholesaler::where('id',$id)->update($request->validated());

        if($updateWholesaler){
            return redirect()->route('admin.wholesalers.index')->with([
                'status' => 'success',
                'message'  => 'Wholesaler Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.wholesalers.index')->with([
                'status' => 'success',
                'message'  => 'Wholesaler not updated successfully',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         DB::beginTransaction();

        try {
            $orderDelete = Order::where('wholesaler_id', $id)->delete();
            $deleteLoginHistories = WholesalerLoginHistory::where('wholesaler_id', $id)->delete();
            $delete = Wholesaler::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Wholesaler deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete wholesaler.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpload(ImportRequest $request){
        try {
            $wholesalerImport = new WholesalerImport;
            $importDataArr = Excel::import($wholesalerImport,$request->validated('file'));
            $totalDataCount = $wholesalerImport->getRowCount();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $dataError['rows'] = $failure->row();
                $dataError['attribute'] = $failure->attribute();
                $dataError['errors'] = $failure->errors();
                $dataError['values'] = $failure->values();
            }
            return back()->with('upload-failed',$dataError);
        }
        return back()->with('upload-success','File uploaded successfully');
    }

    public function wholesalerLoginHistory(){
        if(Gate::denies('wholesaler_login_history_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.wholesalers.login-history');
    }

    public function wholesalerLoginHistoryList(){
        $wholesalerLoginHistories = WholesalerLoginHistory::with([
            'wholesaler',
        ])->get();
        return Datatables::of($wholesalerLoginHistories)->make(true);
    }

    public function wholesalerOrderList(Request $request){
        $wholesaler_id = $request->get('wholesaler_id');
        $order = Order::with(['code','brand'])->where('wholesaler_id',$wholesaler_id)->get();
        return Datatables::of($order)->make(true);
    }
}
