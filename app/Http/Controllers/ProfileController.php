<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{


    public function index(User $user)
    {
        return view('profile.index', compact('user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
//        abort_if(auth()->user()->cannot('edit-update-profile', $request->user()), 403);
        Gate::authorize('edit-update-profile', $request->user());
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(User $user ,ProfileUpdateRequest $request): RedirectResponse
    {
    if (auth()->id() !== $user->id) {
       abort(403);
    }
        $user = $request->user();
        $data = $request->safe()->collect();

        if ($data['password'] == ''){
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($data->has('image')){
            $path = $request->file('image')->store('users', 'public');
            $data['image'] = '/' . $path;
        }


        $data['private_account'] = $request->has('private_account');

        $user->update($data->toArray());
//        $request->user()->fill($request->validated());
//
//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }

//        $request->user()->username = $request->input('username');
//        $request->user()->bio = $request->input('bio');
//        $request->user()->image = $request->input('image');

//        $request->user()->save();
        session()->flash('message', __('Your profile has been updated.' , [] , $data['lang']));
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//        return redirect()->route('user_profile', $user);
    }

//    public function passUpdate(User $user, Request $request)
//    {
//        $data = $request->safe()->collect();
//
//        if ($data['password'] == ''){
//            unset($data['password']);
//        } else {
//            $data['password'] = Hash::make($data['password']);
//        }
//
//
//        $user->update($data->toArray());
//
//        return redirect()->route('user_profile', $user);
//    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function follow(User $user)
    {
    auth()->user()->follow($user);
    return back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }


}
