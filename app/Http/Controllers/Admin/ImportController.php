<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{ImportRequest,};
use Illuminate\Support\Str;
use App\Imports\{PermissionImport};
use Maatwebsite\Excel\Facades\Excel;
use Gate;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::denies('import_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $tables = [
            'permissions' => 'Permission Import',
            'latest_code' => 'Latest Code Import',
            'team_leader' => 'Team Leader Import',
        ];
        return view('admin.pages.import', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImportRequest $request)
    {
        $table = $request->validated('table');
        $file = $request->file('file');

        if ($table === 'wd') {
            $table = strtoupper($table); // Convert "wd" to "WD"
        }

        $importFileName = Str::singular(Str::ucfirst(Str::camel($table)))."Import";

        $importClassName = "App\Imports\\".$importFileName;
        // dd($importClassName);

        try {
            $fileImport = new $importClassName();
            $importDataArr = Excel::import($fileImport, $file);
            $totalDataCount = $fileImport->getRowCount();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

        return redirect()->route('admin.imports.index')->with([
            'status' => 'success',
            'message' => $table.' '.'added successfully. Total Row Count: '.$totalDataCount,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
