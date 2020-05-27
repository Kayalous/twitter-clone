<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'nullable|max:100',
            'password' => 'nullable|min:8|max:100',
            'handle' => 'nullable|max:100',
        ]);
        if($request['handle'])
            {
                $request['handle'] = "@". Str::studly($request['handle']);
                if(User::where('handle', $request['handle'])->first() !== null) $request['handle'] = $request['handle'] . Str::random(10);

            }

        if($request['password'])
            $request['password'] = bcrypt($request['password']);
        $user = Auth::user();
        $user->update(array_filter($request->all()));
        if(request()->avatar){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('attachments'), $imageName);
            $user->avatar = URL::to('/') . '/attachments/' . $imageName;
            $user->save();
        }

        return back()
            ->with('success', 'Profile updated successfully!');
    }
}
