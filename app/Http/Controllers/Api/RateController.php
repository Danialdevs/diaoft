<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\School;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function showRatesBySchoolBin($bin, Request $request)
    {
        $school = School::where("bin", $bin)->firstOrFail();
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->startOfMonth();
            $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now();
        $rates = Rate::where('school_id', $school->id)
            ->whereBetween('created_at', [$startDate->copy()->startOfDay(), $endDate->copy()->endOfDay()])
            ->get();

        $totalCount = $rates->count();

        $categories = [
            "bad" => fn($q) => $q->where('score', '<', 50),
            "good" => fn($q) => $q->whereBetween('score', [50, 74]),
            "perfectly" => fn($q) => $q->where('score', '>=', 75),
        ];

        $cards = ["total" => ["count" => $totalCount]];
        foreach ($categories as $key => $filter) {
            $count = $filter(clone $rates)->count();
            $cards[$key] = [
                "count" => $count,
                "percent" => $totalCount > 0 ? round(($count / $totalCount) * 100, 2) : 0
            ];
        }

        $classes = [];
        foreach (range(1, 11) as $class) {
            $classRates = $rates->where('grade', $class);
            $classTotal = $classRates->count();

            $classes[] = [
                "grade" => $class,
                "bad" => $classRates->whereBetween('score', [0, 49])->count(),
                "good" => $classRates->whereBetween('score', [50, 74])->count(),
                "perfectly" => $classRates->whereBetween('score', [75, 100])->count(),
                "total" => $classTotal,
                "average" => $classTotal > 0 ? round($classRates->avg("score"), 2) : 0
            ];
        }

        return response()->json([
            "startDate" => $startDate->toDateString(),
            "endDate" => $endDate->toDateString(),
            "cards" => $cards,
            "classes" => $classes,
            "password" => bcrypt("443@Xz")
        ]);
    }
}
