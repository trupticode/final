@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
    @endcan

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
</div>
@endsection
