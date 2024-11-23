<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function update(Request $request, $id)
    {
        $consultation = Consultation::find($id);
        $consultation->status = 'Resolve';
        $consultation->save();

        return response()->json(200);
    }
}
