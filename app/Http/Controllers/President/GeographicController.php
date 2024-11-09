<?php

namespace App\Http\Controllers\President;

use App\Models\FarmMember;
use App\Models\Geographic;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\GeographicDataTable;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
use App\Http\Requests\President\GisRequest;

class GeographicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GeographicDataTable $dataTable)
    {
        return $dataTable->render('president.geographics.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $ip_address = $_SERVER['REMOTE_ADDR'] != '127.0.0.1' ? $_SERVER['REMOTE_ADDR'] : '49.150.78.124';

        // Get location data based on the IP address
        $data['location']       = Location::get($ip_address);
        $consultation_id        = $request['consultation_id'];
        $consultation           = Consultation::find($consultation_id);
        $data['consultation']   = $consultation;
        $data['farmers']        = FarmMember::where('president_id', auth()->user()->id)
            ->whereNotNull('fname')
            ->whereNotNull('lname')
            ->orderBy('fname')
            ->get();

        if (isset($consultation_id)) {
            $gis = Geographic::where('consultation_id', $consultation_id)->first();
            return redirect()->to('president/geographics/' . $gis->id . '/edit');
        }

        return view('president.geographics.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GisRequest $request)
    {
        $gis = new Geographic();
        $gis->president_id      = auth()->user()->id;
        $gis->association_id    = auth()->user()->association_id;
        $gis->farmer_id         = $request['farmer_id'];
        $gis->consultation_id   = $request['consultation_id'];
        $gis->location          = $request['location'];
        $gis->farm_area         = $request['farm_area'];
        $gis->name              = $request['name'];
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

        return redirect()->to('president/geographics')->with('success', 'GIS has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['gis'] = Geographic::find($id);

        return view('president.geographics.show', $data);
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
        $data['farmers']    = FarmMember::where('president_id', auth()->user()->id)->orderBy('fname')->get();
        return view('president.geographics.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GisRequest $request, string $id)
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

        return redirect()->to('president/geographics')->with('success', 'GIS has been updated.');
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
