<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fname    = $request['fname'];
        $user->lname    = $request['lname'];
        $user->email    = $request['email'];
        $user->role     = $request['role'];
        $user->save();

        return redirect()->to('admin/users')->with('success', 'User has been added successfully.');
    }

    public function edit($id)
    {
        $data['user'] = $user = User::find($id);
        if($user->role == 'President') {
            return view('president.users.edit', $data);
        }

        if($user->role == 'Department of Agriculture') {
            return view('doa.users.edit', $data);
        }

        return view('admin.users.edit', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->fname    = $request['fname'];
        $user->lname    = $request['lname'];
        $user->email    = $request['email'];
        $user->role     = $request['role'];
        $user->save();

        return redirect()->back()->with('success', 'User has been updated successfully.');
    }
}
