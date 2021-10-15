@extends('layouts.app')

@section('title', 'posts')

@section('content')

  @forelse($posts as $post)
    <h1>{{ $post['title'] }}</h1>
    <form action="{{ route('posts.destroy', ['post'=> $post->id]) }}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" value='Delete!'>
    </form>
  @empty
    <h1>No posts found</h1>
  @endforelse
@endsection