<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    /**
     * TODO: test
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * TODO: test
     * Mark All Notifications As Read.
     *
     * @return \Illuminate\Http\Response
     */
    public function markAllAsRead()
    {
        $jobs = auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
