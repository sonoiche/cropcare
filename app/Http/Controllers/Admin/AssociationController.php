<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AssociationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AssociationRequest;
use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index(AssociationDataTable $dataTable)
    {
        return $dataTable->render('admin.associations.index');
    }

    public function create()
    {
        return view('admin.associations.create');
    }

    public function store(AssociationRequest $request)
    {
        $association = new Association();
        $association->user_id   = auth()->user()->id;
        $association->name      = $request['name'];
        $association->save();

        return redirect()->to('admin/associations')->with('success', 'Association has been added.');
    }

    public function edit($id)
    {
        $data['association'] = Association::find($id);
        return view('admin.associations.edit', $data);
    }

    public function update(AssociationRequest $request, $id)
    {
        $association = Association::find($id);
        $association->name = $request['name'];
        $association->save();

        return redirect()->back()->with('success', 'Association has been updated.');
    }

    public function destroy($id)
    {
        $association = Association::find($id);
        $association->delete();

        return redirect()->to('admin/associations')->with('success', 'Association has been deleted.');
    }
}
