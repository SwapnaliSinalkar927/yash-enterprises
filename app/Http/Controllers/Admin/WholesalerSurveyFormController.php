<?php

namespace App\Http\Controllers\Admin;
use App\Models\{WholesalerSurveyDetail, WD, SMSHistory};

use App\Http\Controllers\Controller;
use Gate;
use DataTables;

use Illuminate\Http\Request;


class WholesalerSurveyFormController extends Controller
{


    public function index()
    {

        if (Gate::denies('wholesaler_survey_access')) {
            return redirect()->route('admin.home')->with([
                'status' => 'failed',
                'message' => 'This action is unauthorized',
            ]);
        }

        return view('admin.wholesalers-survey-form.index');



    }

    public function wholesalerSurveyFormList(Request $request)
    {

        $wholesalersurveyform = WholesalerSurveyDetail::with([
            'wd',
        ])

            ->get();
        return Datatables::of($wholesalersurveyform)->make(true);
    }





    public function create()
    {
        return view('admin.wholesalers-survey-form.create');
    }

    public function show(string $id)
    {
        return view('admin.wholesalers-survey-form.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.wholesalers-survey-form.edit');
    }

    public function wholesalerSurveyFormDelete(Request $request, $survey_id)
    {
        $delete_sms_history = SMSHistory::where('wholesaler_survey_detail_id', $survey_id)->delete();
        $delete = WholesalerSurveyDetail::where('id', $survey_id)->delete();
        return response()->json([
            'message' => 'Wholesaler survey form data deleted successfully!'
        ], 200);
    }


}
