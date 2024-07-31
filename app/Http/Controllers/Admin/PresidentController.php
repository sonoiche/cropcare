<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PresidentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PresidentController extends Controller
{
    public function index(PresidentDataTable $dataTable)
    {
        return $dataTable->render('admin.presidents.index');
    }
}
