@extends('layouts.app')

@section('title', 'posts')

@section('content')

  @forelse($posts as $post)
    <h1>{{ $post['title'] }}</h1>
  @empty
    <h1>No posts found</h1>
  @endforelse
@endsection