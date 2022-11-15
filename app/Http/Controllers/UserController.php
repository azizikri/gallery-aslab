<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $postCount = $user->posts->count();
        $posts = $user->posts()->paginate(12);
        
        return view('user.show', compact('user', 'postCount', 'posts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('me', $user);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('me', $user);

        $data = $request->validated();

        $user->update($data);

        return redirect()->route('users.show', $data['username'])->with('success', 'Data user telah berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('me', $user);

        $user->posts->each(function ($post) {
            Storage::delete($post->image);
        });

        $user->delete();

        return redirect()->route('login')->with('success', 'Akun anda telah berhasil di hapus');
    }
}
