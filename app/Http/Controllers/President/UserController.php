<?php

namespace App\Http\Controllers\President;

use App\Http\Controllers\Controller;
use App\Http\Requests\President\UserRequest;
use App\Models\Association;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = auth()->user();
        $data['associations'] = Association::orderBy('name')->get();
        return view('president.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->fname            = $request['fname'];
        $user->lname            = $request['lname'];
        $user->email            = $request['email'];
        $user->contact_number   = $request['contact_number'];
        if(isset($request['password'])) {
            $user->password     = bcrypt($request['password']);
        }
        $user->save();

        return redirect()->back()->with('success', 'User has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
