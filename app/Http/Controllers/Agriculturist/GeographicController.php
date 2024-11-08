<?php

namespace App\Http\Controllers\Agriculturist;

use App\Models\User;
use App\Models\FarmMember;
use App\Models\Geographic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GeographicDataTable;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

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
        $data['gis'] = Geographic::find($id);

        return view('agriculturist.geographics.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ip_address = $_SERVER['REMOTE_ADDR'] != '127.0.0.1' ? $_SERVER['REMOTE_ADDR'] : '49.150.78.124';

        // Get location data based on the IP address
        $data['location']   = Location::get($ip_address);
        $data['gis']        = $gis = Geographic::find($id);
        $data['farmer']     = FarmMember::find($gis->farmer_id);
        $data['farmers']    = FarmMember::orderBy('fname')->get();
        return view('agriculturist.geographics.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gis = Geographic::find($id);
        $gis->location          = $request['location'];
        $gis->name              = $request['name'];
        $gis->farm_area         = $request['farm_area'];
        $gis->description       = $request['description'];
        $gis->consultation      = $request['consultation'];
        $gis->remarks           = $request['remarks'];
        $gis->latitude          = $request['latitude'];
        $gis->longitude         = $request['longitude'];
        $gis->crop_name         = $request['crop_name'];
        $gis->crop_count        = $request['crop_count'];
        $gis->crop_yield        = $request['crop_yield'];
        $gis->status            = $request['status'];

        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            Storage::disk('s3')->put(
                'cropcare/uploads/gis/' . $photo,
                file_get_contents($file),
                'public'
            );
            
            $gis->photo = Storage::disk('s3')->url('cropcare/uploads/gis/' . $photo);
        }
        
        $gis->save();

        return redirect()->to('agriculturist/geographics')->with('success', 'GIS has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gis = Geographic::find($id);
        $gis->delete();

        return response()->json(200);
    }
}
