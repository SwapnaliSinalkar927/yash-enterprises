<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Role, Permission};
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Gate;
use Illuminate\Http\Request;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('role_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        // $roles = Role::with('permissions')
        //         ->latest()
        //         ->paginate();

        return view('admin.roles.index');
    }
    public function roleList()
    {

        $roles = Role::with('permissions')->get();
        // dd($roles);
        return Datatables::of($roles)->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('role_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $permissions = Permission::whereNull('parent_id')->active()->with('children')->get();
        // $permissions = Permission::query()->active()->select('name','slug', 'id')->get();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());

        $role->permissions()->sync($request->validated('permissions',[]));

        return redirect()->route('admin.roles.index')->with([
            'status' => 'success',
            'message'  => 'Role Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if(Gate::denies('role_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $role->load('permissions:id,slug');
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if(Gate::denies('role_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $permissions = Permission::whereNull('parent_id')->active()->with('children')->get();
        // $permissions = Permission::query()->active()->get(['id','name','slug']);

        $role->load(['permissions' => function ($query) {
                    $query->active();
                    $query->select('id','slug');
                }]);

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        $role->permissions()->sync($request->validated('permissions',[]));

        return redirect()->route('admin.roles.index')->with([
            'status' => 'success',
            'message'  => 'Role Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if(Gate::denies('role_delete')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with([
            'status' => 'success',
            'message'  => 'Role Deleted Successfully',
        ]);
    }

    public function permissions($role_id)
    {
        $role = Role::with('permissions')
                    ->whereId($role_id)
                    ->first();
        $permissions = $role->permissions;

        return response()->json($permissions);
    }
}
