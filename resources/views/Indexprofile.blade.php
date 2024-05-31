@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Posts</h1>
    <a href="{{ route('create') }}" class="btn btn-primary">Create New Post</a>
    <div class="mt-3">
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection
