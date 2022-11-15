<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();
        $data['image'] = $request->file('image')->store('posts');

        foreach ($data['tags'] as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $tags[] = $tag->id;
        }

        $post = Post::create($data);

        $post->tags()->attach($tags);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('owner', $post);

        $tags = $post->tags->toArray();

        return view('post.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('owner', $post);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete($post->image);
            $data['image'] = $request->file('image')->store('posts');
        }

        foreach ($data['tags'] as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $tags[] = $tag->id;
        }

        $post->update($data);

        $post->tags()->sync($tags);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('owner', $post);

        Storage::delete($post->image);
        $post->delete();

        return redirect()->route('users.show', auth()->user());
    }
}
