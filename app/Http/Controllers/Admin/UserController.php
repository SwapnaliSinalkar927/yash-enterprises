<?php

namespace App\Http\Controllers\Admin;

use App\Models\{User, Role,LoginHistory };
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Scopes\ActiveStatusScope;
use Gate;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('user_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        return view('admin.users.index');
    }

    public function userList()
    {
        $users = User::with('roles')->get();
        // dd($users);
        return Datatables::of($users)->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::denies('user_create')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $roles = Role::query()->active()->get(['id','name','slug']);

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        $roles = $request->validated('roles',[]);
        if($roles){
            if($roles[0]=='select-all'){
                array_shift($roles);
            }
        }

        $user->roles()->sync($roles);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message'  => 'User Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        // dd($user->id);
        if(Gate::denies('user_show')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $user->load([
            'roles:id,name,slug,status',
            'loginHistories' => function($query){
                $query->latest()->first();
        }]);
        // dd($user->id);
        $last_logged_in_at = LoginHistory::latest()->where('user_id',$user->id)->value('created_at');
        // $last_logged_in_at = LoginHistory::where('user_id',$user->id)->latest();
        // dd($last_logged_in_at);

        return view('admin.users.show', compact('user','last_logged_in_at'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(Gate::denies('user_edit')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $roles = Role::query()->active()->get(['id','name','slug']);

        $user->load(['roles' => function ($query) {
                    $query->active();
                    $query->select('id','slug');
                }]);

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        $roles = $request->validated('roles',[]);
        if($roles){
            if($roles[0]=='select-all'){
                array_shift($roles);
            }
        }

        $user->roles()->sync($roles);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message'  => 'User Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Gate::denies('user_delete')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with([
            'status' => 'success',
            'message'  => 'User Deleted Successfully',
        ]);
    }

    public function roles($user_id)
    {
        $user = User::with(['roles' => function ($query) {
                    $query->withoutGlobalScope(ActiveStatusScope::class);
                }])
                ->withoutGlobalScope(ActiveStatusScope::class)
                ->whereId($user_id)
                ->first();
        $roles = $user->roles;

        return response()->json($roles);
    }
}
