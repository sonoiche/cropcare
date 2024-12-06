<?php

namespace App\Http\Controllers\Reports;

use Carbon\Carbon;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Reports\ConsultationDataTable;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ConsultationDataTable $dataTable, Request $request)
    {
        $type = $request['type'];
        return $dataTable->with('consultation_type', $type)->render('agriculturist.reports.consultations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type   = $request['type'];
        $month  = '';
        $data['data'] = $this->getMonthlyConsultationCount($month, $type);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $month = $request['month'];
        $type  = $request['type'];
        $data['data'] = $this->getMonthlyConsultationCount($month, $type);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    private function getMonthlyConsultationCount($month, $type)
    {
        $label  = config('app.barangays');
        $data   = [];

        if($month) {
            $dailyConsultationCount = Consultation::select(
                    DB::raw('COUNT(location) as total_location'),
                    'location'
                )
                ->when($type, function ($query, $type) {
                    $today = Carbon::now()->format('Y-m-d');
                    if($type == 'past') {
                        return $query->where('schedule', '<', $today);
                    }
                    return $query->where('schedule', '>=', $today);
                })
                ->whereRaw("month(created_at) = ?", [$month])
                ->groupBy('location')
                ->orderBy('location')
                ->get();

            $consultationCounts = [];
            foreach ($dailyConsultationCount as $dailyData) {
                $consultationCounts[$dailyData->location] = $dailyData->total_location;
            }
            
            // Prepare data for each barangay, defaulting to 0 if not found
            foreach ($label as $barangay) {
                $data[] = $consultationCounts[$barangay] ?? 0; // Default to 0 if no consultations
            }
        
            return [$label, $data];
        }

        $monthlyConsultationCounts = Consultation::select(
                'location',
                DB::raw('COUNT(location) as total_location')
            )
            ->when($type, function ($query, $type) {
                $today = Carbon::now()->format('Y-m-d');
                if($type == 'past') {
                    return $query->where('schedule', '<', $today);
                }
                return $query->where('schedule', '>=', $today);
            })
            ->groupBy('location')
            ->orderBy('location')
            ->get();

        $monthlyConsultationCountsArray = [];
        foreach ($monthlyConsultationCounts as $monthlyData) {
            $monthlyConsultationCountsArray[$monthlyData->location] = $monthlyData->total_location;
        }
        
        // Prepare data for each barangay, defaulting to 0 if not found
        foreach ($label as $barangay) {
            $data[] = $monthlyConsultationCountsArray[$barangay] ?? 0; // Default to 0 if no consultations
        }
        
        return [$label, $data];
    }
}
