<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Association;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Mail\SendTemporaryPassword;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    public function create()
    {
        $data['associations'] = Association::orderBy('name')->get();
        return view('admin.users.create', $data);
    }

    public function store(UserRequest $request)
    {
        $password   = strtoupper(Str::random(10));
        $user       = new User();
        $user->fname            = $request['fname'];
        $user->lname            = $request['lname'];
        $user->email            = $request['email'];
        $user->role             = $request['role'];
        $user->barangay         = $request['barangay'];
        $user->association_id   = $request['association_id'];
        $user->password         = bcrypt($password);
        $user->status           = 'Active';
        $user->save();

        // Send email sending their temporary password
        Mail::to($user->email)->send(new SendTemporaryPassword($user, $password));

        return redirect()->to('admin/users')->with('success', 'User has been added successfully.');
    }

    public function edit($id)
    {
        $data['user'] = $user = User::find($id);
        $data['associations'] = Association::orderBy('name')->get();
        if($user->role == 'President') {
            return view('admin.presidents.edit', $data);
        }

        if($user->role == 'Department of Agriculture') {
            return view('doa.users.edit', $data);
        }

        return view('admin.users.edit', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->fname            = $request['fname'];
        $user->lname            = $request['lname'];
        $user->email            = $request['email'];
        $user->role             = $request['role'];
        $user->barangay         = $request['barangay'];
        $user->association_id   = $request['association_id'];
        $user->save();

        return redirect()->back()->with('success', 'User has been updated successfully.');
    }
}
