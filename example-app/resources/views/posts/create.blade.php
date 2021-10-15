@extends('layouts.app')

@section('title', 'Create Posts')

@section('content')

<form action="{{ route('posts.store') }}" method="post">
  @csrf
  @include('posts.partials.form')
  <div><input type="submit" name="Create"></div>
</form>
@endsection