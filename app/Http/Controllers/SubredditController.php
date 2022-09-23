<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Requests\SubredditStoreRequest;

class SubredditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subreddits = Subreddit::paginate(5)->through(fn($subreddit) => [
            'id' => $subreddit->id,
            'name' => $subreddit->name,
            'slug' => $subreddit->slug,
        ]);

        return Inertia::render('Subreddits/Index', compact('subreddits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Subreddits/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubredditStoreRequest $request)
    {
        Subreddit::create($request->validated() + ['user_id' => auth()->id()]);

        return to_route('subreddits.index')->with('message', 'Subreddit created succesfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subreddit $subreddit)
    {
        return Inertia::render('Subreddits/Edit', compact('subreddit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubredditStoreRequest $request,Subreddit $subreddit)
    {
        $subreddit->update($request->validated());

        return to_route('subreddits.index')->with('message', 'Subreddit updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subreddit $subreddit)
    {
        $subreddit->delete();

        return back()->with('message', 'Subreddit deleted succesfully.');
    }
}
