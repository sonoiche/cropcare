<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GeographicDataTable;
use App\DataTables\ListingDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(GeographicDataTable $dataTable)
    {
        return $dataTable->render('admin.listings.index');
    }
}
