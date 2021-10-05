@extends('layouts.app')

@section('content')
  <h1>{{ __('Paths') }}</h1>
  <a href="{{ route('path.create') }}" class="btn btn-info">{{ __('Create New Path') }}</a>
  @if (isset($pathList) && 0 < count($pathList))
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Description')}}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pathList as $path)
          <tr>
            <td><a href="{{ route('path.show', ['path' => $path]) }}">{{ $path->title }}</a></td>
            <td>{{ $path->description }}</td>
            <td>
              @include('path.actions')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h5 class="alert alert-warning" style="display: inline-block;">{{ __('No paths found') }}</h5>
  @endif
@endsection
