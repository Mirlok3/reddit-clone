<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\SubredditPostResource;
use App\Models\Post;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

/**
 *
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        $posts = SubredditPostResource::collection($user->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments')->paginate(3));

        return Inertia::render('Profile/Index', compact( 'user', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $posts = SubredditPostResource::collection($user->posts()->with(['user', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('comments','user')->paginate(3));

        $postCount = Post::where('user_id', $user->id)->count();

        $voteCount = Post::where('user_id', $user->id)->sum('votes');

        return Inertia::render('Profile/Show', compact('user', 'posts','postCount','voteCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit()
    {
        $user = User::where('id', auth()->id())->firstOrFail();
        $this->authorize('update', $user);

        return Inertia::render('Profile/Edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UserStoreRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        if ($request->hasFile('user_image')) {
            $imagename = $request->user_image->getClientOriginalName();
            $request->user_image->move(public_path("user_images"), $imagename);
            $path = 'user_images/' . $imagename;
            $user->user_image = $path;
            $user->save();
        }

        return Redirect::route('profile.show', $user->username)->with('message', 'Profile edited succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
