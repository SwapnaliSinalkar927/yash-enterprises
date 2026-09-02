<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{City,State,Wholesaler,Order};
use App\Http\Requests\{AdminStoreCityRequest,ImportRequest,AdminEditCityRequest};
use App\Imports\CityImport;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('city_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.city.index');
    }

    public function cityList(){
        $city = City::with(['state'])->get();
        return Datatables::of($city)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('city_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $states = State::all();
        return view('admin.city.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreCityRequest $request)
    {
        $storeCity = City::create($request->validated());
        if($storeCity){
            return redirect()->route('admin.cities.index')->with([
                'status' => 'success',
                'message'  => 'City Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.cities.index')->with([
                'status' => 'success',
                'message'  => 'City not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('city_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $city = City::with(['state'])->where('id',$id)->first();
        $wholesaler = Wholesaler::where('city_id',$id)->count();
        $orderCount = Order::with(['wholesaler','code'])
                        ->when($id, function($query) use ($id){
                            $query->whereHas('wholesaler',function ($query) use ($id){
                                $query->where('city_id', $id);
                            });
                        })->count();
        $codeUsedCount = Code::with(['orders','orders.wholesaler'])
        ->when($id, function($query) use ($id){
            $query->whereHas('orders.wholesaler', function ($query) use ($id) {
                $query->where('city_id', $id);
            });
        })->count();
        $data = [
            'wholesaler' => $wholesaler,
            'codeUsedCount' => $codeUsedCount,
            'orderCount' => $orderCount,
        ];
        return view('admin.city.show',compact('city','data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('city_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $city = City::where('id',$id)->first();
        $states = State::all();
        return view('admin.city.edit',compact('city','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditCityRequest $request, string $id)
    {
        $updateCity = City::where('id',$id)->update([
            'name' => $request->validated('name'),
            'state_id' => $request->validated('state_id'),
            'status' => $request->validated('status'),
        ]);
        if($updateCity){
            return redirect()->route('admin.cities.index')->with([
                'status' => 'success',
                'message'  => 'City Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.cities.index')->with([
                'status' => 'success',
                'message'  => 'City not updated successfully',
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

    public function bulkCityUpload(ImportRequest $request){
        try {
            $CityImport = new CityImport;
            $importDataArr = Excel::import($CityImport,$request->validated('file'));
            $totalDataCount = $CityImport->getRowCount();
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

    public function getCities($state_id){
        $cities = City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function cityWholesalerList(Request $request){
        $city_id = $request->input('city_id');
        $wholesaler = Wholesaler::where('city_id',$city_id)->withCount('orders')->get();
        return Datatables::of($wholesaler)->make(true);
    }

    public function cityOrderList(Request $request){
        $city_id = $request->input('city_id');
        $order = Order::with(['wholesaler','code'])
                        ->when($city_id, function($query) use ($city_id){
                            $query->whereHas('wholesaler',function ($query) use ($city_id){
                                $query->where('city_id', $city_id);
                            });
                        })->get();
        return Datatables::of($order)->make(true);
    }
}
