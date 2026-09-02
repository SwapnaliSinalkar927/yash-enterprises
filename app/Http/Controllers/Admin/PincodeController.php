<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{Pincode,City,Wholesaler,Order};
use App\Http\Requests\{AdminStorePincodeRequest,ImportRequest,AdminEditPincodeRequest};
use App\Imports\PincodeImport;
use Maatwebsite\Excel\Facades\Excel;

class PincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('pincode_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.pincodes.index');
    }

    public function pincodeList(){
        $pincodeList = Pincode::with(['city','city.state'])->get();
        return Datatables::of($pincodeList)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('pincode_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $cities = City::all();
        return view('admin.pincodes.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStorePincodeRequest $request)
    {
        $storePincode = Pincode::create($request->validated());
        if($storePincode){
            return redirect()->route('admin.pincodes.index')->with([
                'status' => 'success',
                'message'  => 'Pincode Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.pincodes.index')->with([
                'status' => 'success',
                'message'  => 'Pincode not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('pincode_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $pincode = Pincode::with(['city','city.state'])->where('id',$id)->first();
        $wholesaler = Wholesaler::where('pincode_id',$id)->count();
        $orderCount = Order::with(['wholesaler','code'])
                        ->when($id, function($query) use ($id){
                            $query->whereHas('wholesaler',function ($query) use ($id){
                                $query->where('pincode_id', $id);
                            });
                        })->count();
        $codeUsedCount = Code::with(['orders','orders.wholesaler'])
                        ->when($id, function($query) use ($id){
                            $query->whereHas('orders.wholesaler', function ($query) use ($id) {
                                $query->where('pincode_id', $id);
                            });
                        })->count();
        $data = [
            'wholesaler' => $wholesaler,
            'codeUsedCount' => $codeUsedCount,
            'orderCount' => $orderCount,
        ];
        return view('admin.pincodes.show',compact('pincode','data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('pincode_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $pincode = Pincode::with(['city'])->where('id',$id)->first();
        $cities = City::all();
        return view('admin.pincodes.edit',compact('pincode','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditPincodeRequest $request, string $id)
    {
        $updatePincode = Pincode::where('id',$id)->update([
            'code' => $request->validated('code'),
            // 'area' => $request->validated('area'),
            'city_id' => $request->validated('city_id'),
            'status' => $request->validated('status'),
        ]);
        if($updatePincode){
            return redirect()->route('admin.pincodes.index')->with([
                'status' => 'success',
                'message'  => 'Pincode Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.pincodes.index')->with([
                'status' => 'success',
                'message'  => 'Pincode not updated successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function bulkPincodesUpload(ImportRequest $request){
        try {
            $PincodeImport = new PincodeImport;
            $importDataArr = Excel::import($PincodeImport,$request->validated('file'));
            $totalDataCount = $PincodeImport->getRowCount();
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

    public function getPincodes($city_id){
        $pincodes = Pincode::where('city_id', $city_id)
                ->select('id', 'code') // Select id, code, and area
                ->get();
        return response()->json($pincodes);
    }

    public function pincodeWholesalerList(Request $request){
        $pincode_id = $request->input('pincode_id');
        $wholesaler = Wholesaler::where('pincode_id',$pincode_id)->withCount('orders')->get();
        return Datatables::of($wholesaler)->make(true);
    }

    public function pincodeOrderList(Request $request){
        $pincode_id = $request->input('pincode_id');
        $order = Order::with(['wholesaler','code'])
                        ->when($pincode_id, function($query) use ($pincode_id){
                            $query->whereHas('wholesaler',function ($query) use ($pincode_id){
                                $query->where('pincode_id', $pincode_id);
                            });
                        })->get();
        return Datatables::of($order)->make(true);
    }
}
