@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
                    
 <div class="mt-3">

    <div class="mt-3">
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <!-- <p class="mt-2 text-success">You are an admin.</p> -->
                        @else
                            <!-- <p class="mt-2 text-warning">You are a regular user.</p> -->
                        @endif
                    @endif                
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection
