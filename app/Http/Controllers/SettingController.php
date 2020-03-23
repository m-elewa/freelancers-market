<?php

namespace App\Http\Controllers;

use App\Job;
use Validator;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJob;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UpdateUpworkLink;
use Str;
use Illuminate\Http\RedirectResponse;
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

        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUpworkLink(UpdateUpworkLink $request)
    {
        $upworkLink = $this->validateUpworkLink($request->upwork_profile_link);
        auth()->user()->update(['upwork_profile_link' => $upworkLink]);
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
            ['upwork_profile_link' => $this->validateUpworkLink($request->upwork_profile_link)]
        ));
    }
}
