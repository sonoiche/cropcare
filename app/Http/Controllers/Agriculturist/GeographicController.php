<?php

namespace App\Http\Controllers\Agriculturist;

use App\DataTables\GeographicDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GeographicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GeographicDataTable $dataTable, Request $request)
    {
        $data['presidents'] = User::where('role', 'President')->orderBy('fname')->get();
        $president_id       = $request['president_id'];
        return $dataTable
            ->with('president_id', $president_id)
            ->render('agriculturist.geographics.index', $data);
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
