@extends('layouts.app')

@section('content')
  <h1>{{ __('Locations') }}</h1>
  <a href="{{ route('location.create') }}" class="btn btn-info">{{ __('Create New Location') }}</a>
  @if (isset($locationList) && 0 < count($locationList))
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Description')}}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($locationList as $location)
          <tr>
            <td><a href="{{ route('location.show', ['location' => $location]) }}">{{ $location->title }}</a></td>
            <td>{{ $location->description }}</td>
            <td>
              @include('location.actions')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h5 class="alert alert-warning" style="display: inline-block;">{{ __('No locations found') }}</h5>
  @endif
@endsection
