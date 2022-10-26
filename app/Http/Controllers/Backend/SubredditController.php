<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use App\Http\Requests\SubredditStoreRequest;
use App\Http\Controllers\Controller;

class SubredditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subreddits = Subreddit::/* where('user_id', auth()->id())-> */paginate(5)->through(fn($subreddit) => [
            'id' => $subreddit->id,
            'name' => $subreddit->name,
            'subreddit_subreddit_image' => $subreddit->subreddit_subreddit_image,
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
        $subreddit = Subreddit::create($request->validated() + ['user_id' => auth()->id()]);

        // Image save
        if ($request->hasFile('subreddit_image')) {
            $imagename = $request->subreddit_image->getClientOriginalName();
            $request->subreddit_image->move(public_path("subreddit_images"), $imagename);
            $path = '/subreddit_images/' . $imagename;
            $subreddit->subreddit_image = $path;
            $subreddit->save();
        }

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
        $this->authorize('update', $subreddit);
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
        $this->authorize('update', $subreddit);
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
        $this->authorize('delete', $subreddit);
        $subreddit->delete();

        return back()->with('message', 'Subreddit deleted succesfully.');
    }
}
