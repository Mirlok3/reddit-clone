<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubredditPostResource;
use App\Http\Resources\SubredditResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        $posts = SubredditPostResource::collection($user->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->paginate(3));

        $subreddits = SubredditResource::collection(Subreddit::withCount('posts')->orderBy('posts_count', 'desc')->take(4)->get());

        return Inertia::render('Profile/Index', compact( 'user', 'posts', 'subreddits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
