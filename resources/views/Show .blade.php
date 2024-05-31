@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->body }}</p>

                @auth
                    @if(auth()->user()->id == $post->user_id || auth()->user()->is_admin)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection
