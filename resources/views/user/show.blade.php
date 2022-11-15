@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row align-items-start">
                    <div class="col-3 pr-5">
                        <img src="{{ $user->avatar() }}" alt="{{ $user->username }}-avatar">
                    </div>
                    <div class="col-8">
                        <div class="d-flex align-items-center my-2">
                            <h2 class="text-truncate" style="max-width: 150px;">
                                {{ $user->username }}
                            </h2>
                            @auth
                        
                                @if ($user->username == auth()->user()->username)
                                    <a href="{{ route('users.edit', $user->username) }}"
                                        class="mx-3 btn btn-outline-secondary">Edit
                                        profile</a>

                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#userSetting">
                                        <em class="fa-solid fa-gear"></em>
                                    </button>
                                @endif
                            @endauth
                        </div>
                        <div class="d-flex align-items-center my-3">
                            <div class="mx-3">1 {{ str('post')->plural($postCount) }}</div>
                        </div>
                        <div class="">
                            <h6>
                                {{ $user->name }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-3">
            <h3 class="text-center">Posts</h3>
            <div class="container text-center">
                <div class="row">
                    @forelse ($user->posts as $post)
                        <div class="col-4">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <img src="{{ $post->image() }}" class="img-thumbnail img-fluid" alt="...">
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No posts yet</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
@endsection

<div class="modal fade" id="userSetting" tabindex="-1" aria-labelledby="userSettingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <a href="{{ route('password.request') }}" class="text-secondary text-center my-3 mx-3">Change
                        Password</a>
                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteAccount">Delete Account</button>

                    <a href="{{ route('logout') }}" class="text-secondary text-center my-3 mx-3"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteACcount" tabindex="-1" aria-labelledby="deleteACcountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteACcountLabel">Delete Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('users.destroy', $user->username) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
