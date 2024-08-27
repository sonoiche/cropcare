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
    public function index(ConsultationDataTable $dataTable)
    {
        $role = auth()->user()->role;
        return $dataTable->with('role', $role)->render('agriculturist.consultations.index');
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
                $this->sendNotification($president, auth()->user(), "The consultation you submitted is currently under review by one of the Agriculturist.");

                break;

            case 'Resolved':

                $consultation = Consultation::find($id);
                $consultation->status = 'Resolve';
                $consultation->save();

                $data['consultation'] = $consultation;
                $data['president']    = $president = User::find($consultation->president_id);

                // send notification
                $this->sendNotification($president, auth()->user(), "The consultation you submitted is now Resolve.");

                break;

            default:
                # code...
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function sendNotification($president, $user, $message)
    {
        Mail::to($president->email)->send(new SendNotificationJobEmail($president, $user, $message));
    }
}
