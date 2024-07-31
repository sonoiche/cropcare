<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AgricultureDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgricultureController extends Controller
{
    public function index(AgricultureDataTable $dataTable)
    {
        return $dataTable->render('admin.agricultures.index');
    }
}
