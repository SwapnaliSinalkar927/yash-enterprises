<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{WD,Code,Order};
use Gate;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\{AdminAddWD,AdminEditWD,ImportRequest};
use App\Imports\WDImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class WDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('wd_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.wd.index');
    }

    public function wdList()
    {
       $wd = WD::get();
       return DataTables::of($wd)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('wd_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.wd.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminAddWD $request)
    {
        $addWD= WD::create($request->validated());
        if($addWD){
            return redirect()->route('admin.wds.index')->with([
                'status' => 'success',
                'message'  => 'WD Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.wds.index')->with([
                'status' => 'success',
                'message'  => 'WD not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('wd_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wd = WD::where('id',$id)->first();
        $total_codes = Code::where('wd_id',$id)->count();
        $total_codes_used = Code::where('wd_id',$id)->where('is_used',1)->count();
        $total_orders = Order::with(['code'])
        ->whereHas('code', function ($query) use ($id) {
            $query->where('wd_id', $id);
        })->count();
       $total_brand_count = Order::join('codes', 'orders.code_id', '=', 'codes.id') // join codes to access wd_id
                        ->join('brands', 'orders.brand_id', '=', 'brands.id') // join brands to get brand name
                        ->where('codes.wd_id', $id) // filter by wd_id from codes table
                        ->select(
                            'orders.brand_id',
                            'brands.name as brand_name',
                            DB::raw('SUM(orders.value) as total_value')
                        )
                        ->groupBy('orders.brand_id', 'brands.name')
                        ->get();
        // dd($total_brand_count);
        $data_count = [
            'total_orders' => $total_orders,
            'total_codes' => $total_codes,
            'total_codes_used' => $total_codes_used,
            'total_brand_count' => $total_brand_count
        ];
        return view('admin.wd.show', compact('wd','data_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('wd_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wd = WD::where('id',$id)->first();
        return view('admin.wd.edit', compact('wd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditWD $request, string $id)
    {
        $updateWD= WD::where('id',$id)->update($request->validated());
        if($updateWD){
            return redirect()->route('admin.wds.index')->with([
                'status' => 'success',
                'message'  => 'WD Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.wds.index')->with([
                'status' => 'success',
                'message'  => 'WD not Updated successfully',
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
            $codeIds = Code::where('wd_id', $id)->pluck('id');
            $orderDelete = Order::whereIn('code_id', $codeIds)->delete();
            $codeDelete = Code::where('wd_id', $id)->delete();
            $delete = WD::where('id',$id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'WD deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete WD.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpload(ImportRequest $request){
        try {
            $wdImport = new WDImport;
            $importDataArr = Excel::import($wdImport,$request->validated('file'));
            // dd($importDataArr);
            $totalDataCount = $wdImport->getRowCount();
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

    public function wdCodeList(Request $request){
        $wd_id = $request->get('wd_id');
        $order = Code::with(['wd','brand'])->where('wd_id',$wd_id)->get();
        return Datatables::of($order)->make(true);
    }

     public function wdOrderList(Request $request){
        $wd_id = $request->get('wd_id');
        $order = Order::with(['wholesaler','code','brand'])
        ->whereHas('code', function ($query) use ($wd_id) {
            $query->where('wd_id', $wd_id);
        })
        ->get();
        return Datatables::of($order)->make(true);
    }
}
