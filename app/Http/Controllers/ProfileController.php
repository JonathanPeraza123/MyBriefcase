<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile', compact('user'));
    }

    public function update(Request $request, Profile $profile)
    {

        $this->authorize('updateProfile', $profile);

        $profile->update($request->all());
        return $profile;
    }
}
