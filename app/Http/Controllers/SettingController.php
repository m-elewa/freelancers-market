<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdateProfileLink;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.setting');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request)
    {
        $this->checkPassword($request, 'current_password');

        $user = $request->user();
        $userData = $request->validated();

        if($request->email !== $user->email) {
            $userData['email_verified_at'] = null;
            $this->updateUserData($request, $user, $userData);
            $user->sendEmailVerificationNotification();
            
        } else {
            $this->updateUserData($request, $user, $userData);
        }

        return redirect(route('setting.edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePassword $request)
    {
        $this->checkPassword($request, 'current_password_modal');
        auth()->user()->update(['password' => bcrypt($request->password)]);
        return redirect(route('setting.edit'));
    }

    public function checkPassword($request, $field) {
        if(!Hash::check($request->get($field), auth()->user()->password)) {
            throw ValidationException::withMessages([
                $field => ['Wrong Password!'],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfileLink(UpdateProfileLink $request)
    {
        $freelanceWebsiteLink = $this->validateFreelanceWebsiteLink($request->profile_link);
        auth()->user()->update(['profile_link' => $freelanceWebsiteLink]);
        return back();
    }

    /**
     * Update user data.
     *
     * @param  \Illuminate\Http\UpdateProfile   $request
     * @param  \App\User                        $user
     * @param  array                            $userData
     */
    public function updateUserData(UpdateProfile $request, $user, $userData): void
    {
        $user->update(array_merge(
            $userData, 
            ['profile_link' => $this->validateFreelanceWebsiteLink($request->profile_link)]
        ));
    }
}
