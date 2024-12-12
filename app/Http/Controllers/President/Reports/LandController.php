<?php

namespace App\Http\Controllers\President\Reports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Geographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\LandCropDataTable;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LandCropDataTable $dataTable, Request $request)
    {
        $daterange              = $data['daterange'] = $request['daterange'] ?? Carbon::now()->subDays(29)->format('m/d/Y') . ' - ' . now()->format('m/d/Y');
        $date                   = explode('-', $daterange);
        $data['from']           = trim($date[0]);
        $data['to']             = trim($date[1]);
        $data['presidents']     = User::where('role', 'President')->where('status', 'Active')->orderBy('fname')->get();
        $data['president_id']   = $president_id = $request['president_id'];

        return $dataTable->with('daterange', $daterange)
            ->with('president_id', $president_id)->render('president.reports.lands.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $month = '';
        if($request['what'] == 'crop') {
            $data['data'] = $this->getMonthlyCropCount($month);
        } else {
            $data['data'] = $this->getMonthlyYieldCount($month);
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $month = $request['month'];
        if($request['what'] == 'crop') {
            $data['data'] = $this->getMonthlyCropCount($month);
        } else {
            $data['data'] = $this->getMonthlyYieldCount($month);
        }

        return response()->json($data);
    }

    private function getMonthlyCropCount($month)
    {
        $label  = [];
        $rice   = [];
        $corn   = [];

        if($month) {
            $dailyCropCounts = Geographic::select(
                    DB::raw('DAY(created_at) as day'),
                    DB::raw('SUM(CASE WHEN crop_name = "rice" THEN crop_count ELSE 0 END) as total_rice_count'),
                    DB::raw('SUM(CASE WHEN crop_name = "corn" THEN crop_count ELSE 0 END) as total_corn_count')
                )
                ->whereRaw("month(created_at) = ?", [$month])
                ->where('president_id', auth()->user()->id)
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            foreach ($dailyCropCounts as $dailyData) {
                $label[]    = $month.'/' . str_pad($dailyData->day, 2, '0', STR_PAD_LEFT);
                $rice[]     = $dailyData->total_rice_count;
                $corn[]     = $dailyData->total_corn_count;
            }

            return [$label, $rice, $corn];
        }

        $monthlyCropCounts = Geographic::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN crop_name = "rice" THEN crop_count ELSE 0 END) as total_rice_count'),
                DB::raw('SUM(CASE WHEN crop_name = "corn" THEN crop_count ELSE 0 END) as total_corn_count')
            )
            ->where('president_id', auth()->user()->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($monthlyCropCounts as $monthlyData) {
            $monthNames = [
                1  => 'January',
                2  => 'February',
                3  => 'March',
                4  => 'April',
                5  => 'May',
                6  => 'June',
                7  => 'July',
                8  => 'August',
                9  => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];
            $label[] = $monthNames[$monthlyData->month];
            $rice[]  = $monthlyData->total_rice_count;
            $corn[]  = $monthlyData->total_corn_count;
        }

        return [$label, $rice, $corn];
    }

    private function getMonthlyYieldCount($month)
    {
        $label  = [];
        $rice   = [];
        $corn   = [];

        if($month) {
            $dailyCropCounts = Geographic::select(
                    DB::raw('DAY(created_at) as day'),
                    DB::raw('SUM(CASE WHEN crop_name = "rice" THEN crop_yield ELSE 0 END) as total_rice_count'),
                    DB::raw('SUM(CASE WHEN crop_name = "corn" THEN crop_yield ELSE 0 END) as total_corn_count')
                )
                ->whereRaw("month(created_at) = ?", [$month])
                ->where('president_id', auth()->user()->id)
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            foreach ($dailyCropCounts as $dailyData) {
                $label[]    = $month.'/' . str_pad($dailyData->day, 2, '0', STR_PAD_LEFT);
                $rice[]     = $dailyData->total_rice_count;
                $corn[]     = $dailyData->total_corn_count;
            }

            return [$label, $rice, $corn];
        }

        $monthlyCropCounts = Geographic::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(CASE WHEN crop_name = "rice" THEN crop_yield ELSE 0 END) as total_rice_count'),
                DB::raw('SUM(CASE WHEN crop_name = "corn" THEN crop_yield ELSE 0 END) as total_corn_count')
            )
            ->where('president_id', auth()->user()->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($monthlyCropCounts as $monthlyData) {
            $monthNames = [
                1  => 'January',
                2  => 'February',
                3  => 'March',
                4  => 'April',
                5  => 'May',
                6  => 'June',
                7  => 'July',
                8  => 'August',
                9  => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];
            $label[] = $monthNames[$monthlyData->month];
            $rice[]  = $monthlyData->total_rice_count;
            $corn[]  = $monthlyData->total_corn_count;
        }

        return [$label, $rice, $corn];
    }
}
