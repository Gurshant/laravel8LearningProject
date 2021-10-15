<div><input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}"></div>
  <div><textarea type="text" name="content" >{{ old('content', optional($post ?? null)->content) }}</textarea></div>

  @if($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif