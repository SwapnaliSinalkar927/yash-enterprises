<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('q');

        $pincodes = \DB::table('pincodes')->when($search, function ($query) use ($search) {
            $query->where('code', 'LIKE', $search . '%');
        })
        ->whereStatus(1)
        ->orderBy('code', 'ASC')
        ->get(['id','code', 'area']);

        return response()->json([
            'total_count' => $pincodes->count(),
            'items' => $pincodes
        ], 200);
    }

    public function getPincodes(Request $request)
    {
        $search = $request->get('q');

        // $pincodes = Pincode::when($search, function ($query) use ($search) {
        $pincodes = \DB::table('pincodes')->when($search, function ($query) use ($search) {
            $query->where('code', 'LIKE', $search . '%');
        })
        ->where('pincodes.status',1)
        ->orderBy('code', 'ASC')
        ->join('cities', 'pincodes.city_id', '=', 'cities.id')
        ->select('pincodes.id', 'pincodes.code','pincodes.area', 'cities.name as city_name')
        ->get();

        $uniqueCodes = $pincodes->unique('code')->values();

        // dd($uniqueCodes);

        return response()->json([
            'total_count' => $uniqueCodes->count(),
            'items' => $uniqueCodes
        ], 200);
    }
}
