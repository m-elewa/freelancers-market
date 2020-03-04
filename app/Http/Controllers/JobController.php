<?php

namespace App\Http\Controllers;

use App\Job;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBid;
use App\Http\Requests\StoreJob;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->paginate(5);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJob $request)
    {
        $job = array_merge($request->all(), ['status_id' => Status::ACTIVE_STATUS]);
        auth()->user()->jobs()->create($job);

        return redirect(route('jobs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('jobs.show', [
                'job' => $job,
                'bids' => $job->bids()->latest()->paginate(5),
                'bid' => $job->bids()->freelancerBid()
             ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $jobs = Job::latest()->paginate(10);

        return view('jobs.search', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBid(StoreBid $request, Job $job)
    {
        $bid = array_merge($request->all(), [
                'status_id' => Status::ACTIVE_STATUS,
                'user_id' => auth()->id()
            ]);
        $job->bids()->create($bid);

        return redirect(route('jobs.show', $job->id));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bidsIndex()
    {
        $bids = auth()->user()->bids()->latest()->paginate(5);

        return view('jobs.bid-index', compact('bids'));
    }
}
