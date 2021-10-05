@extends('layouts.app')

@section('content')
  <h1>{{ __('Path') }} "{{ $path->title }}"</h1>
  <a class="btn" href="{{ route('path.index') }}">{{ __('< Back') }}</a>
  @include('path.actions')
  <br><br>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Description') }}</h5>
    <pre class="card-text">{{ $path->description }}</pre>
  </div>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Location') }}</h5>
    <div class="card-text">
      @if ($path->location)
        <a href="{{ route('location.show', $path->location) }}">{{ $path->location->title }}</a>
      @else
        {{ __('No location set') }}
      @endif
    </div>
  </div>
@endsection
