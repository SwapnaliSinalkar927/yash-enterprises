<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Requests\ImportRequest;
use Gate;
use DataTables;
use App\Imports\PermissionImport;
use Maatwebsite\Excel\Facades\Excel;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('permission_access')) {
            return redirect()->route('home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        // $permissions = Permission::query()->latest()->paginate();

        return view('admin.permissions.index');
    }

    public function permissionList()
    {
        $permissions = Permission::all();
        return Datatables::of($permissions)->make(true);

        // return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('permission_create')) {
            return redirect()->route('home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $permissions = Permission::latest()->active()->get(['id','name']);;

        return view('admin.permissions.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'status' => 'success',
            'message'  => 'Permission Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        if(Gate::denies('permission_show')) {
            return redirect()->route('home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if(Gate::denies('permission_edit')) {
            return redirect()->route('home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $permissions = Permission::latest()
                            ->where('id', '!=', $permission->id)
                            ->active()
                            ->get(['id','name']);

        return view('admin.permissions.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with([
            'status' => 'success',
            'message'  => 'Permission Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if(Gate::denies('permission_delete')) {
            return redirect()->route('home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with([
            'status' => 'success',
            'message'  => 'Permission Deleted Successfully',
        ]);
    }

    public function bulkUpload(ImportRequest $request){
        try {
            $permissionImport = new PermissionImport;
            $importDataArr = Excel::import($permissionImport,$request->validated('file'));
            // dd($importDataArr);
            $totalDataCount = $permissionImport->getRowCount();
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
}
