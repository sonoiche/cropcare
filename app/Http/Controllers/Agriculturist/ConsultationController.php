<?php

namespace App\Http\Controllers\Agriculturist;

use App\DataTables\ConsultationDataTable;
use App\Models\User;
use App\Models\FarmMember;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendNotificationJobEmail;
use App\Models\LandCrop;
use Illuminate\Support\Facades\Mail;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ConsultationDataTable $dataTable, Request $request)
    {
        $role = auth()->user()->role;
        $status = $request['status'];
        return $dataTable->with('role', $role)
            ->with('status', $status)
            ->render('agriculturist.consultations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['agriculturists'] = User::where('role', 'Agriculturist')->get();
        return view('agriculturist.consultations.create', $data);
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
    public function show(Request $request, string $id)
    {
        $what = $request['status'];

        switch ($what) {
            case 'Review':

                $data['consultation']   = $consultation = Consultation::find($id);
                $data['president']      = $president = User::find($consultation->president_id);

                $consultation->status   = 'Under Review';
                $consultation->save();

                // send notification
                $this->sendNotification($president, auth()->user(), $consultation);

                break;

            case 'Resolved':

                $consultation = Consultation::find($id);
                $consultation->status = 'Resolve';
                $consultation->save();

                $data['consultation'] = $consultation;
                $data['president']    = $president = User::find($consultation->president_id);

                // send notification
                $this->sendNotification($president, auth()->user(), $consultation);

                break;

            default:
                
                $data['consultation'] = $consultation = Consultation::find($id);
                $president            = User::find($consultation->president_id);
                // send notification
                $this->sendNotification($president, auth()->user(), $consultation);

                return view('agriculturist.consultations.show', $data);

                break;
        }


        return response()->json($data);
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
        $consultation = Consultation::find($id);
        $consultation->status   = $request['status'];
        $consultation->schedule = $request['schedule'];
        $consultation->save();

        return redirect()->to('agriculturist/consultations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function sendNotification($president, $user, $consultation)
    {
        Mail::to($president->email)->send(new SendNotificationJobEmail($president, $user, $consultation));
    }
}
