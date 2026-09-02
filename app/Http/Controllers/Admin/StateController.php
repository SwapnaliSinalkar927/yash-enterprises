<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use DataTables;
use App\Models\{State,Wholesaler,Order,Code};
use App\Http\Requests\{AdminStoreStateRequest,ImportRequest,AdminEditStateRequest};
use App\Imports\StateImport;
use Maatwebsite\Excel\Facades\Excel;


class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('state_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        return view('admin.states.index');
    }

    public function stateList(){
        $states = State::all();
        return Datatables::of($states)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('state_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreStateRequest $request)
    {
        // dd($request->validated());
        $state = State::create($request->validated());
        if($state){
            return redirect()->route('admin.states.index')->with([
                'status' => 'success',
                'message'  => 'State Created Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.states.index')->with([
                'status' => 'success',
                'message'  => 'State not created successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Gate::denies('state_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $state = State::where('id',$id)->first();
        $wholesaler = Wholesaler::where('state_id',$id)->count();
        $orderCount = Order::with(['wholesaler','code'])
                        ->when($id, function($query) use ($id){
                            $query->whereHas('wholesaler',function ($query) use ($id){
                                $query->where('state_id', $id);
                            });
                        })->count();

        $codeUsedCount = Code::with(['orders','orders.wholesaler'])
                        ->when($id, function($query) use ($id){
                            $query->whereHas('orders.wholesaler', function ($query) use ($id) {
                                $query->where('state_id', $id);
                            });
                        })->count();
        $data = [
            'wholesaler' => $wholesaler,
            'codeUsedCount' => $codeUsedCount,
            'orderCount' => $orderCount
        ];
        return view('admin.states.show',compact('state','data','orderCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Gate::denies('state_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $state = State::where('id',$id)->first();
        return view('admin.states.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminEditStateRequest $request, string $id)
    {
        // dd($request->validated());
        $updateState = State::where('id',$id)->update([
            'name' => $request->validated('name'),
            'status' => $request->validated('status'),
        ]);
        if($updateState){
            return redirect()->route('admin.states.index')->with([
                'status' => 'success',
                'message'  => 'State Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.states.index')->with([
                'status' => 'success',
                'message'  => 'State not updated successfully',
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

    public function bulkStatesUpload(ImportRequest $request){
        try {
            $StateImport = new StateImport;
            $importDataArr = Excel::import($StateImport,$request->validated('file'));
            $totalDataCount = $StateImport->getRowCount();
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

    public function stateWholesalerList(Request $request){
        $state_id = $request->input('state_id');
        $wholesaler = Wholesaler::where('state_id',$state_id)->withCount('orders')->get();
        return Datatables::of($wholesaler)->make(true);
    }

    public function stateOrderList(Request $request){
        $state_id = $request->input('state_id');
        $order = Order::with(['wholesaler','code'])
                        ->when($state_id, function($query) use ($state_id){
                            $query->whereHas('wholesaler',function ($query) use ($state_id){
                                $query->where('state_id', $state_id);
                            });
                        })->get();
        return Datatables::of($order)->make(true);
    }
}
