@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container text-center">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-4">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <img src="{{ $post->image() }}" class="img-thumbnail img-fluid" alt="...">
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No posts</p>
                            </div>
                        @endforelse

                    </div>
                    {{-- centering the pagination --}}
                    <div class="d-flex my-5 justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
