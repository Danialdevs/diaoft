<?php

namespace App\Http\Controllers;

use App\Exports\AllRateExport;
use App\Exports\GradeRateExport;
use App\Models\Rate;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RatesController extends Controller
{
    public function index(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now();

        //        $schools = School::whereHas('rates', function ($query) use ($startDate, $endDate) {
        //            $query->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()]);
        //        })
        //            ->with(['rates' => function ($query) use ($startDate, $endDate) {
        //                $query->select('school_id', DB::raw('AVG(score) as average_score'))
        //                    ->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()])
        //                    ->groupBy('school_id');
        //            }])
        //            ->get()
        //            ->map(function ($school) {
        //                $school->percentage_score = $school->rates->first()->average_score ?? 0;
        //                return $school;
        //            });
        $rates = Rate::where('school_id', $schoolId)
            ->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()])
            ->get();

        return view('pages.rates', compact('rates', 'startDate', 'endDate'));
    }

    public function rateExport(Request $request)
    {
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))
            : now()->startOfMonth();
        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))
            : now();

        $exportType = $request->input('type') === 'grade'
            ? new GradeRateExport($startDate, $endDate)
            : new AllRateExport($startDate, $endDate);

        $fileType = $request->input('file_type', 'xlsx');
        $fileExtension = $fileType === 'csv' ? 'csv' : 'xlsx';

        $fileName = "rates.$fileExtension";

        return Excel::download($exportType, $fileName);
    }

    public function schoolsRating()
    {
        $schools = School::where('city_id', Auth::user()->school->city_id)->get();

        return view('pages.schoolsRating', compact('schools'));
    }
}
