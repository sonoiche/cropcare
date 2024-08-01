<?php

namespace App\Http\Controllers\President;

use App\DataTables\FarmerDataTable;
use App\Models\FarmMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\President\FarmerRequest;
use Illuminate\Support\Facades\Storage;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FarmerDataTable $dataTable)
    {
        return $dataTable->render('president.farmers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('president.farmers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FarmerRequest $request)
    {
        $farmer = new FarmMember();
        $farmer->fname          = $request['fname'];
        $farmer->lname          = $request['lname'];
        $farmer->contact_number = $request['contact_number'];
        $farmer->association_id = auth()->user()->association_id;
        $farmer->president_id   = auth()->user()->id;
        $farmer->barangay       = $request['barangay'];

        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            Storage::putFileAs(
                'public/uploads/farmers',
                $file,
                $photo,
                'public'
            );
            
            $farmer->photo = url('storage/uploads/farmers/' . $photo);
        }

        $farmer->save();

        return redirect()->to('president/farmers')->with('success', 'New farmer member has been saved.');
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
        $data['farmer'] = FarmMember::find($id);
        return view('president.farmers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farmer = FarmMember::find($id);
        $farmer->fname          = $request['fname'];
        $farmer->lname          = $request['lname'];
        $farmer->contact_number = $request['contact_number'];
        $farmer->barangay       = $request['barangay'];

        if(isset($request['photo']) && $request->has('photo')) {
            $file  = $request->file('photo');
            $photo = time().'.'.$file->getClientOriginalExtension();

            Storage::putFileAs(
                'public/uploads/farmers',
                $file,
                $photo,
                'public'
            );
            
            $farmer->photo = url('storage/uploads/farmers/' . $photo);
        }

        $farmer->save();

        return redirect()->to('president/farmers')->with('success', 'New farmer member has been saved.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
