<?php

namespace App\Http\Controllers;

use App\Job;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJob;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassword;
use Validator;

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

        auth()->user()->update($request->validated());
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
            $v = Validator::make([], []);
            $v->getMessageBag()->add($field, 'Wrong Password!');
            return back()->withInput()->withErrors($v);
        }
    }
}
