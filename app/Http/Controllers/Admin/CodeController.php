<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\GenerateCode;
use App\Http\Requests\{GenerateCodeRequest,ChangeCodeValueRequest,AdminEditCode};
use Gate;
use DataTables;
use App\Models\{Code,Wholesaler,Order,WD,Brand};
use Illuminate\Support\Facades\DB;

class CodeController extends Controller
{
    public function index(){
        if(Gate::denies('code_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        return view('admin.generate-code.index');
    }
    public function generateCodeList(Request $request){
        $wdId = $request->get('wd_id');
        $brandId = $request->get('brand_id');

        $query = Code::with(['wd', 'brand'])
          ->when($wdId, function ($query, $wdId) {
            return $query->where('wd_id', $wdId);
        })
        ->when($brandId, function ($query, $brandId) {
            return $query->where('brand_id', $brandId);
        })
        ->select('codes.*');

        return DataTables::of($query)
            ->addColumn('code', function ($code) {
                if (!$code->code) {
                    return '<i class="text-danger">NA</i>';
                }

                if (Gate::allows('code_access')) {
                    $url = route('admin.generate-codes.show', $code->id);
                    return '<a href="' . $url . '">' . e($code->code) . '</a>';
                }

                return e($code->code);
            })
            ->editColumn('created_at', function ($code) {
                return $code->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('is_used', function ($code) {
                return $code->is_used ? '<span class="badge badge-pill badge-soft-success font-size-11">Yes</span>' : '<span class="badge badge-pill badge-soft-danger font-size-11">No</span>';
            })
          ->editColumn('status', function ($code) {
                return $code->status
                    ? '<span class="badge badge-pill badge-soft-success font-size-11">Active</span>'
                    : '<span class="badge badge-pill badge-soft-danger font-size-11">Inactive</span>';
            })
            ->addColumn('wd_code', function ($code) {
                if (!$code->wd) {
                    return '<i class="text-danger">NA</i>';
                }

                if (Gate::allows('wd_access')) {
                    $url = route('admin.wds.show', $code->wd->id);
                    return '<a href="' . $url . '">' . e($code->wd->code) . '</a>';
                }

                return e($code->wd->code);
            })
            ->addColumn('brand_name', function ($code) {
                 if (!$code->brand) {
                    return '<i class="text-danger">NA</i>';
                }

                if (Gate::allows('brand_access')) {
                    $url = route('admin.brands.show', $code->brand->id);
                    return '<a href="'.$url.'">'.$code->brand->name.'</a>';
                }

                return e($code->brand->name);
            })
            ->addColumn('actions', function ($code) {
                $buttons = '';
                if (auth()->user()->can('code_show')) {
                    $buttons .= '<a href="'.route('admin.generate-codes.show', $code->id).'"  class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover view-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="View"> <span class="nav-icon-wrap"><i class="ri-eye-fill"></i></span></a>';
                }
                if (auth()->user()->can('code_edit')) {
                    $buttons .= '<a href="'.route('admin.generate-codes.edit', $code->id).'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover view-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="View"> <span class="nav-icon-wrap"><i class="ri-eye-fill"></i></span></a>';
                }
                if (auth()->user()->can('code_delete')) {
                    $buttons .= '<button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover delete-button" data-id="'.$code->id.'"data-bs-original-title="Delete"> <span class="nav-icon-wrap"><i class="ri-delete-bin-6-fill"></i></span></button>';
                }
                return $buttons;
            })
            ->rawColumns(['code','actions','wd_code', 'brand_name','is_used','status']) // allow HTML buttons
            ->make(true);
    }
    
    public function create(){
        if(Gate::denies('code_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wds = WD::all();
        $brands = Brand::all();
        return view('admin.generate-code.create',compact('wds','brands'));
    }

    public function store(GenerateCodeRequest $request){
        $wdId = $request->validated('wd_id');
        $brandId = $request->validated('brand_id');
        $codesCount = $request->validated('code_count');
        $codesValue = $request->validated('code_value');

        $latestBatch = Code::max('batch') ?? 0;
        $currentBatch = $latestBatch + 1;
        // dd($codesCount);

        $chunkSize = 1000;
        
        $chunks = (int) ceil($codesCount / $chunkSize);
        

        for ($i = 0; $i < $chunks; $i++) {
            $currentChunkSize = ($i === $chunks - 1) ? $codesCount - ($i * $chunkSize) : $chunkSize;
            GenerateCode::dispatch($currentChunkSize, $codesValue, $currentBatch, $wdId, $brandId);
        }

        return back()->with([
            'status' => 'success',
            'message' => "{$codesCount} Codes Generated Successfully"
        ])
        ->withInput($request->validated());
    }

    public function show(string $id){
        if(Gate::denies('code_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $codeDetail = Code::with(['brand','wd'])->where('id',$id)->first();
        $order = Order::where('code_id',$id)->latest()->first();

        return view('admin.generate-code.show',compact('codeDetail','order'));
    }

    public function edit(string $id){
        if(Gate::denies('code_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $codeDetail = Code::where('id',$id)->first();
        return view('admin.generate-code.edit',compact('codeDetail'));
    }

    public function update(AdminEditCode $request, string $id){
        if($request->validated('is_used') == 1){
            $used_at = now()->format('Y-m-d H:i:s');
        }
        elseif($request->validated('is_used') == 0){
            $used_at = null;
        }

        $updateCode = Code::where('id',$id)->update([
            'code' => $request->validated('code'),
            'value' => $request->validated('value'),
            'is_used' => $request->validated('is_used'),
            'used_at' => $used_at,
            'status' => $request->validated('status'),
        ]);

        if($updateCode){
            return redirect()->route('admin.generate-codes.index')->with([
                'status' => 'success',
                'message'  => 'Code Updated Successfully',
            ]);
        }
        else{
            return redirect()->route('admin.wholesalers.index')->with([
                'status' => 'success',
                'message'  => 'Code not Updated Successfully',
            ]);
        }
    }

    public function destroy(string $id){
        DB::beginTransaction();

        try {
            $deleteOrder = Order::where('code_id', $id)->delete();
            $deleteCode = Code::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Code deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to delete Code.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function changeCode(){
        if(Gate::denies('code_change_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $wds = WD::all();
        $brands = Brand::all();
        return view('admin.generate-code.change-code',compact('wds','brands'));
    }
    public function storeChangeCode(ChangeCodeValueRequest $request){
        $newValue = $request->validated('code_value');
        $codeIds = $request->validated('code_id');
        $brandIds = $request->validated('brand_id');
        $wdIds = $request->validated('wd_id');

        // dd($newValue,$codeIds,$brandIds,$wdIds);

        // $changeValue = Code::where('is_used',0)->update(['value'=>$newValue]);
        $changeValue =  Code::where('is_used',0)
                        ->when($request->wd_id, function ($query, $wdId) {
                            return $query->where('wd_id', $wdId);
                        })
                        ->when($request->brand_id, function ($query, $brandId) {
                            return $query->where('brand_id', $brandId);
                        })
                        ->whereIn('id',$codeIds)
                        ->update(['value'=>$newValue]);
        if($changeValue){
            return back()->with([
                'status' => 'success',
                'message' => "Codes Value Changed Successfully"
            ]);
        }
        else{
            return back()->with([
                'status' => 'failed',
                'message' => "Codes Value not Changed Successfully"
            ]);
        }
    }

    public function getRefWdCode(Request $request)
    {
        // dd($request->wd_id,$request->brand_id);
        $wdId = $request->input('wd_id');
        $brandId = $request->input('brand_id');

        $codes = Code::where('is_used',0)
        ->when($request->wd_id, function ($query, $wdId) {
            return $query->where('wd_id', $wdId);
        })
        ->when($request->brand_id, function ($query, $brandId) {
            return $query->where('brand_id', $brandId);
        })
        ->get();

        return response()->json($codes);
    }

    public function getRefBrandCode(Request $request)
    {
        // dd($request->wd_id,$request->brand_id);
        $wdId = $request->input('wd_id');
        $brandId = $request->input('brand_id');

        // dd($wdId,$brandId);
        
        $codes = Code::where('is_used',0)
        ->when($request->wd_id, function ($query, $wdId) {
            return $query->where('wd_id', $wdId);
        })
        ->when($request->brand_id, function ($query, $brandId) {
            return $query->where('brand_id', $brandId);
        })
        ->get();

        return response()->json($codes);
    }
}
