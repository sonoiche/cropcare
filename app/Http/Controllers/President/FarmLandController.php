<?php

namespace App\Http\Controllers\President;

use App\Models\LandCrop;
use App\Models\FarmMember;
use Illuminate\Http\Request;
use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\President\FarmLandRequest;

class FarmLandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListingDataTable $dataTable)
    {
        return $dataTable->render('president.farms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['farmers'] = FarmMember::orderBy('fname')->get();
        return view('president.farms.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FarmLandRequest $request)
    {
        $farm = new LandCrop();
        $farm->association_id   = auth()->user()->association_id;
        $farm->farmer_id        = $request['farmer_id'];
        $farm->crop_name        = $request['crop_name'];
        $farm->location         = $request['location'];
        $farm->lat              = $request['lat'];
        $farm->lng              = $request['lng'];
        $farm->acres            = $request['acres'];
        $farm->crop_yield       = $request['crop_yield'];
        $farm->crop_count       = $request['crop_count'];
        $farm->status           = $request['status'];
        $farm->bill_type        = $request['bill_type'];
        $farm->acre_value       = $request['acre_value'];
        $farm->status           = $request['status'];
        $farm->save();

        return redirect()->to('president/farms')->with('success', 'New farm land has been saved.');
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
        $data['farm']    = LandCrop::find($id);
        $data['farmers'] = FarmMember::orderBy('fname')->get();
        return view('president.farms.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FarmLandRequest $request, string $id)
    {
        $farm = LandCrop::find($id);
        $farm->farmer_id        = $request['farmer_id'];
        $farm->crop_name        = $request['crop_name'];
        $farm->location         = $request['location'];
        $farm->lat              = $request['lat'];
        $farm->lng              = $request['lng'];
        $farm->acres            = $request['acres'];
        $farm->crop_yield       = $request['crop_yield'];
        $farm->crop_count       = $request['crop_count'];
        $farm->status           = $request['status'];
        $farm->bill_type        = $request['bill_type'];
        $farm->acre_value       = $request['acre_value'];
        $farm->status           = $request['status'];
        $farm->save();

        return redirect()->back()->with('success', 'Farm land has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
