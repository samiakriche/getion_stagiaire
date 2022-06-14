<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    /**
     * Display a listing of the userProfile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userProfileQuery = UserProfile::query();
        $userProfileQuery->where('name', 'like', '%'.request('q').'%');
        $userProfiles = $userProfileQuery->paginate(25);

        return view('user_profiles.index', compact('userProfiles'));
    }

    /**
     * Show the form for creating a new userProfile.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new UserProfile);

        return view('user_profiles.create');
    }

    /**
     * Store a newly created userProfile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new UserProfile);

        $newUserProfile = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newUserProfile['creator_id'] = auth()->id();

        $userProfile = UserProfile::create($newUserProfile);

        return redirect()->route('user_profiles.show', $userProfile);
    }

    /**
     * Display the specified userProfile.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\View\View
     */
    public function show()
    {
        {
            $userProfile = Auth::user();
         // dd($userProfile);
            
        }
        return view('user_profiles.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified userProfile.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
      //  $this->authorize('update', $userProfile);
        $userProfile = Auth::user();
        return view('user_profiles.edit', compact('userProfile'));
    }

    /**
     * Update the specified userProfile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $this->authorize('update', $userProfile);

        $userProfileData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $userProfile->update($userProfileData);

        return redirect()->route('user_profiles.show', $userProfile);
    }

    /**
     * Remove the specified userProfile from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, UserProfile $userProfile)
    {
        $this->authorize('delete', $userProfile);

        $request->validate(['user_profile_id' => 'required']);

        if ($request->get('user_profile_id') == $userProfile->id && $userProfile->delete()) {
            return redirect()->route('user_profiles.index');
        }

        return back();
    }
}
