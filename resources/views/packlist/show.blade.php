@extends('layouts.app')

@section('content')
  <h1>{{ __('Packlist') }} "{{ $packlist->title }}"</h1>
  <a class="btn" href="{{ route('packlist.index') }}">{{ __('< Back') }}</a>
  <a class="btn btn-success" href="{{ route('packlist.pack', ['packlist' => $packlist]) }}">{{ __('Pack') }}</a>
  @include('packlist.actions')
  <br><br>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Description') }}</h5>
    <pre class="card-text">{{ $packlist->description }}</pre>
  </div>
@endsection
