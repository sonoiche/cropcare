<?php

namespace App\Http\Controllers\President\Reports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\LandCropDataTable;
use App\Models\User;

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
