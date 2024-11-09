<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\GeographicDataTable;

class ListingController extends Controller
{
    public function index(GeographicDataTable $dataTable, Request $request)
    {
        $president_id       = $request['president_id'];
        $data['presidents'] = User::where('role', 'President')->orderBy('fname')->get();
        return $dataTable
            ->with('president_id', $president_id)
            ->render('admin.listings.index', $data);
    }
}
