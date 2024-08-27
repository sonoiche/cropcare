<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
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

        return view('home', $data);
    }
}
