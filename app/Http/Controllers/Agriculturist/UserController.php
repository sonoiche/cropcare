<?php

namespace App\Http\Controllers\Agriculturist;

use App\Models\User;
use App\Models\Association;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\President\UserRequest;

class UserController extends Controller
{
    public function edit(string $id)
    {
        $data['user'] = auth()->user();
        $data['associations'] = Association::orderBy('name')->get();
        return view('agriculturist.users.edit', $data);
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
}
