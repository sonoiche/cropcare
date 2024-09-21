<?php

namespace App\Http\Controllers\President;

use App\Models\User;
use App\Models\LandCrop;
use App\Models\FarmMember;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ConsultationDataTable;
use App\Http\Requests\President\ConsultationRequest;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ConsultationDataTable $dataTable)
    {
        return $dataTable->render('president.consultations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $data['farmers']        = FarmMember::where('association_id', $user->association_id)->orderBy('fullname')->get();
        $data['agriculturists'] = User::where('role', 'Agriculturist')->get();
        return view('president.consultations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {
        $consultation = new Consultation();
        $consultation->farmer_fullname  = $request['farmer_fullname'];
        $consultation->title            = $request['title'];
        $consultation->location         = $request['location'];
        $consultation->concern          = $request['concern'];
        $consultation->president_id     = auth()->user()->id;
        // $consultation->agriculture_id   = $request['agriculture_id'];
        $consultation->status           = 'Submitted';
        $consultation->save();

        return redirect()->to('president/consultations')->with('success', 'Submitting consultation is success.');
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
        $user = auth()->user();
        $data['farmers']        = FarmMember::where('association_id', $user->association_id)->orderBy('fullname')->get();
        $data['agriculturists'] = User::where('role', 'Agriculturist')->get();
        $data['consultation']   = Consultation::find($id);
        return view('president.consultations.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequest $request, string $id)
    {
        $consultation = Consultation::find($id);
        $consultation->farmer_id    = $request['farmer_id'];
        $consultation->title        = $request['title'];
        $consultation->location_id  = $request['location_id'];
        $consultation->concern      = $request['concern'];
        $consultation->save();

        return redirect()->back()->with('success', 'Consultation has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $consultation = Consultation::find($id);
        $consultation->delete();

        return response()->json(200);
    }
}
