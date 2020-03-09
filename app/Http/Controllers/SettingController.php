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
        if($v = $this->checkPassword($request, 'current_password')) {
            return back()->withInput()->withErrors($v);
        }

        auth()->user()->update(array_merge(
            $request->validated(), 
            ['upwork_profile_link' => $this->validateUpworkLink($request->upwork_profile_link)]
        ));
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
        if($v = $this->checkPassword($request, 'current_password_modal')) {
            return back()->withInput()->withErrors($v);
        }

        auth()->user()->update(['password' => bcrypt($request->password)]);
        return redirect(route('setting.edit'));
    }

    public function checkPassword($request, $field) {
        if(!Hash::check($request->get($field), auth()->user()->password)) {
            $v = Validator::make([], []);
            return $v->getMessageBag()->add($field, 'Wrong Password!');
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
}
