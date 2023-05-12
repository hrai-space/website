<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function dashboardGames()
    {
        return view('profile.games.dashboard');
    }

    public function dashboardArticles()
    {
        return view('profile.articles.dashboard');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ])->with('usedFilters', array('platform' => '', 'genre' => '', 'time' => '', 'other' => ''))->with('data', ['search' => null])->with('genres', Genre::all());
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

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

    public function followed()
    {
        return view('profile.followed')->with('games', Auth::user()->followedGames)->with('usedFilters', array('platform' => '', 'genre' => '', 'time' => '', 'other' => ''))->with('data', ['search' => null])->with('genres', Genre::all());;
    }

    public function admin(Request $request, User $user)
    {
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->route('public.profile', $user->username);
    }
}
