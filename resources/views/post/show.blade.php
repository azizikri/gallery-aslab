@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('posts.show', $post->id) }}">
                    <div class="card">
                        <div class="card-header">
                            @can('owner', $post)
                                <div class="dropdown d-flex justify-content-end">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('posts.destroy', $post->id) }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">Delete</a>

                                        <form id="delete-form" action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <img src="{{ $post->image() }}" class="img-fluid img-thumbnail"
                                alt="{{ $post->user->username }} post">
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('users.show', $post->user->username) }}" class="text-decoration-none">
                                        <img src="{{ $post->user->avatar() }}" class="rounded-circle w-100"
                                            style="max-width: 40px" alt="{{ $post->user->username }} profile image">
                                        <span class="text-dark">{{ $post->user->username }}</span>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                                        <span class="text-dark">{{ $post->caption }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
