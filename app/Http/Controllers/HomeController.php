<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Consultation;
use App\Models\FarmMember;
use App\Models\Geographic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user']   = auth()->user();
        // Agriculturist
        if (auth()->user()->role === 'Agriculturist') {
            $data['consultations'] = Consultation::with(['land'])
                ->where('status', '!=', 'Resolve')
                ->latest()
                ->limit(10)
                ->get();
        }
        
        $role = auth()->user()->role;
        $data['userCount']          = User::where('status', 'Active')->count();
        $data['farmerCount']        = FarmMember::when($role, function ($query, $role) {
                if($role == 'President') {
                    $query->where('president_id', auth()->user()->id);
                } 
            })->count();
        $data['availableLands']     = Geographic::where('status', 'Tenant')->count();
        $data['ownedLands']         = Geographic::where('status', 'Owned')->count();
        $data['consultationCount']  = Consultation::where('status', '!=', 'Resolve')->count();
        $data['totalCropsYield']    = Geographic::when($role, function ($query, $role) {
                if($role == 'President') {
                    $query->where('president_id', auth()->user()->id);
                } 
            })->sum('crop_yield');

        return view('home', $data);
    }
}
