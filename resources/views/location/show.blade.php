@extends('layouts.app')

@section('content')
  <h1>{{ __('Location') }} "{{ $location->title }}"</h1>
  <a class="btn" href="{{ route('location.index') }}">{{ __('< Back') }}</a>
  @include('location.actions')
  <br><br>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Description') }}</h5>
    <pre class="card-text">{{ $location->description }}</pre>
  </div>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Path') }}</h5>
    <div class="card-text">
      @if ($location->path)
        <a href="{{ route('path.show', $location->path) }}">{{ $location->path->title }}</a>
      @else
        {{ __('No path set') }}
      @endif
    </div>
  </div>
@endsection
