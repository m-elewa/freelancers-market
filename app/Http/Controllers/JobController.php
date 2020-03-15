<?php

namespace App\Http\Controllers;

use Str;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBid;
use App\Http\Requests\StoreJob;
use App\Http\Requests\SearchJob;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->paginate(10);

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
        $job = auth()->user()->jobs()->create(array_merge(
            $request->validated(), 
            ['upwork_job_link' => $this->validateUpworkLink($request->upwork_job_link)]
        ));

        return redirect(route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]));
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
                'bids' => $job->bids()->latest()->paginate(10),
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
    public function search(SearchJob $request)
    {
        if ($request->q) {
            $jobs = Job::search($request->q)->paginate(10);
        } else {
            $jobs = Job::latest()->paginate(10);
        }

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
        $job->bids()->create($request->validated() + ['user_id' => auth()->id()]);
        
        return redirect(route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bidsIndex()
    {
        $bids = auth()->user()->bids()->latest()->paginate(10);

        return view('jobs.bid-index', compact('bids'));
    }
}
