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
                ->limit(5)
                ->get();
        }
        
        $data['userCount']      = User::where('status', 'Active')->count();
        $data['farmerCount']    = FarmMember::count();
        $data['availableLands'] = Geographic::where('status', 'Available')->count();
        $data['ownedLands']     = Geographic::where('status', 'Owned')->count();
        $data['consultationCount'] = Consultation::where('status', '!=', 'Resolve')->count();

        return view('home', $data);
    }
}
