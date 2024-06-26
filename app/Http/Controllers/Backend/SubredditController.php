<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subscribe;
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
     * @return \Inertia\Response
     */
    public function index()
    {
        $subreddits = Subreddit::where('user_id', auth()->id())->paginate(5)->through(fn($subreddit) => [
            'id' => $subreddit->id,
            'name' => $subreddit->name,
            'subreddit_image' => $subreddit->subreddit_image,
            'color' => $subreddit->color,
            'slug' => $subreddit->slug,
        ]);

        return Inertia::render('Subreddits/Index', compact('subreddits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Subreddits/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubredditStoreRequest $request)
    {
        $subreddit = Subreddit::create($request->validated() + ['user_id' => auth()->id()]);
        $subreddit->color = $request->color ?: '#4338ca';

        if ($request->hasFile('subreddit_image')) {
            $imagename = $request->subreddit_image->hashName();
            $request->subreddit_image->move(public_path("subreddit_images"), $imagename);
            $path = '/subreddit_images/' . $imagename;
            $subreddit->subreddit_image = $path;
            $subreddit->save();
        } else {
            $path = '/subreddit_images/default_subreddit.png';
            $subreddit->subreddit_image = $path;
            $subreddit->save();
        }

        Subscribe::create([
            'user_id' => auth()->id(),
            'subreddit_id' => $subreddit->id,
            'subscribe' => 1,
            'role' => 'creator',
        ]);

        return to_route('subreddits.index')->with('message', 'Subreddit created succesfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subreddit $subreddit)
    {
        $this->authorize('update', $subreddit);

        $subreddit->update($request->validate([
            'name' => ['required','unique:subreddits,name,'.$subreddit->id],
            'description' => ['required', 'min:5','max:255'],
            'color' => ['nullable'],
        ]));
        /*$request->validate([  // OLD VERSION
            'name' => ['required','unique:subreddits,name,'.$subreddit->id],
            'description' => ['required', 'min:5','max:255'],
            'color' => ['nullable'],
        ]);*/

        if ($request->hasFile('subreddit_image')) {
            $imagename = $request->subreddit_image->getClientOriginalName();
            $request->subreddit_image->move(public_path("subreddit_images"), $imagename);
            $path = '/subreddit_images/' . $imagename;
            $subreddit->subreddit_image = $path;
            $subreddit->save();
        }

        return to_route('subreddits.index')->with('message', 'Subreddit updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subreddit $subreddit)
    {
        $this->authorize('delete', $subreddit);
        $subreddit->delete();

        return back()->with('message', 'Subreddit deleted succesfully.');
    }
}
