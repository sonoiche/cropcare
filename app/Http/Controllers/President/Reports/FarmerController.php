<?php

namespace App\Http\Controllers\President\Reports;

use App\DataTables\Reports\FarmerDataTable;
use App\Http\Controllers\Controller;
use App\Models\FarmMember;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FarmerDataTable $dataTable, Request $request)
    {
        $daterange              = $data['daterange'] = $request['daterange'] ?? Carbon::now()->subDays(29)->format('m/d/Y') . ' - ' . now()->format('m/d/Y');
        $date                   = explode('-', $daterange);
        $data['from']           = $from = trim($date[0]);
        $data['to']             = $to = trim($date[1]);
        $data['totalRecords']   = FarmMember::whereRaw("date(created_at) between ? and ?", [$from, $to])->count();
        return $dataTable->with(['daterange' => $daterange])->render('president.reports.farmers.index', $data);
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
    public function store(Request $request)
    {
        //
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
