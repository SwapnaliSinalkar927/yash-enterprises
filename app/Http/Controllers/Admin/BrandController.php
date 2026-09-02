<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{Brand,Code,Order};
use App\Http\Requests\{AdminStoreBrand,AdminUpdateBrand,ImportRequest};
use App\Imports\BrandImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if(Gate::denies('brand_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.brands.index');
    }

    public function brandList(){
        $brand = Brand::get();
       return DataTables::of($brand)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if(Gate::denies('brand_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreBrand $request)
    {
        $createBrand = Brand::create($request->validated());
        if($createBrand){
            return redirect()->route('admin.brands.index')->with([
                'status' => 'success',
                'message'  => 'Brand Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.brands.index')->with([
                'status' => 'success',
                'message'  => 'Brand not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('brand_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $brand = Brand::where('id',$id)->first();
        $total_codes = Code::where('brand_id',$id)->count();
        $total_codes_used = Code::where('brand_id',$id)->where('is_used',1)->count();
        $total_orders = Order::with(['code'])->where('brand_id',$id)->count();
        $total_order_values = Order::with(['code'])->where('brand_id',$id)->sum('value');
       
        $data_count = [
            'total_orders' => $total_orders,
            'total_codes' => $total_codes,
            'total_codes_used' => $total_codes_used,
            'total_order_values' => $total_order_values
        ];
        return view('admin.brands.show',compact('brand','data_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('brand_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $brand = Brand::where('id',$id)->first();
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateBrand $request, string $id)
    {
        $updateBrand= Brand::where('id',$id)->update($request->validated());
        if($updateBrand){
            return redirect()->route('admin.brands.index')->with([
                'status' => 'success',
                'message'  => 'Brand Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.brands.index')->with([
                'status' => 'success',
                'message'  => 'Brand not Updated successfully',
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
            $deleteOrder = Order::where('brand_id', $id)->delete();
            $deleteCode = Code::where('brand_id', $id)->delete();
            $deleteBrand = Brand::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Brand deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete Brand.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpload(ImportRequest $request){
        try {
            $brandImport = new BrandImport;
            $importDataArr = Excel::import($brandImport,$request->validated('file'));
            // dd($importDataArr);
            $totalDataCount = $brandImport->getRowCount();
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

    public function brandCodeList(Request $request){
        $brand_id = $request->get('brand_id');
        $code = Code::with(['wd','brand'])->where('brand_id',$brand_id)->get();
        return Datatables::of($code)->make(true);
    }

     public function brandOrderList(Request $request){
        $brand_id = $request->get('brand_id');
        $order = Order::with(['wholesaler','code','brand'])
        ->where('brand_id',$brand_id)
        ->get();
        return Datatables::of($order)->make(true);
    }
}
