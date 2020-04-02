<?php

namespace App\Http\Controllers;

use Str;
use App\Job;
use App\Events\BidPosted;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBid;
use App\Http\Requests\StoreJob;
use App\Http\Requests\SearchJob;

class JobController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified')->only(['create', 'store']);
    }

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
            ['job_link' => $this->validateFreelanceWebsiteLink($request->job_link)]
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
                'bids' => $job->bids()->with('user')->latest()->paginate(10),
                'bid' => $job->bids()->freelancerBid()
             ]);
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
        $bid = $job->bids()->create($request->validated() + ['user_id' => auth()->id()]);

        if ($bid) {
            $bid->load(['user', 'job.user']);
            event(new BidPosted($bid));
        }
        
        return redirect(route('jobs.show', ['job' => $job->id, 'title' => Str::slug($job->title)]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bidsIndex()
    {
        $bids = auth()->user()->bids()->with('job')->latest()->paginate(10);

        return view('jobs.bid-index', compact('bids'));
    }
}
