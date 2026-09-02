<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExportRequest;
use App\Helpers\CommonHelper;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Gate;
use App\Models\{City, State,LatestWD};
class ExportController extends Controller
{
    public function index()
    {
        if (Gate::denies('export_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }
        $data = [
            'tables' => CommonHelper::getAllTables(),
        ];

        // $wdSections = LatestWD::pluck('section_name');
        // dd($wdSections);
        $wds = LatestWD::select('section_name')
            ->distinct()
            ->pluck('section_name');

            // dd($wds);
        return view('admin.pages.export', compact('data'));
    }

    public function export(ExportRequest $request)
    {
        ini_set("memory_limit", "-1");
        set_time_limit(0);
        $table = $request->validated('table');
        $payment_method = $request->validated('payment_method');

        $startDate1 = $request->validated('startDateTime');
        $endDate2 = $request->validated('endDateTime');

        $startDate = date('Y-m-d H:i:s', strtotime($startDate1));
        $endDate = date('Y-m-d H:i:s', strtotime($endDate2));

        if (strtotime($endDate) > time()) {
            $endDate = date('Y-m-d H:i:s');
        }

        $fileName = config('constants.export_filename_prefix') . '-' . $table . '-' . now()->format('Y-m-d-h:i:sa') . ".xlsx";
        $exportTableName = Str::singular(Str::ucfirst(Str::camel($table)));
        $exportClassName = "App\Exports\\" . $exportTableName . "Export";

        // dd($exportClassName);

        if (class_exists($exportClassName) === true) {
            $classInstance = new $exportClassName;
            if ($exportTableName === "WholesalerRzpUpload") {
                $classInstance->dateRange($startDate, $endDate, $payment_method);
            } else {
                $classInstance->dateRange($startDate, $endDate);
            }

            return Excel::download($classInstance, $fileName);
        } else {
            $table = ucwords(str_replace('_', ' ', Str::singular($table)));
            return back()->with([
                'status' => 'failed',
                'message' => "The export for {$table} table does not exist please try again later or contact administrator."
            ])
                ->withInput($request->validated());
        }
    }
}
