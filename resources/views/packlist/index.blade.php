@extends('layouts.app')

@section('content')
  <h1>{{ __('Packlists') }}</h1>
  <a href="{{ route('packlist.create') }}" class="btn btn-info">{{ __('Create New Packlist') }}</a>
  <a href="" class="btn btn-info">{{ __('Create From Template') }}</a>
  @if (isset($packlistList) && 0 < count($packlistList))
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Status')}}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($packlistList as $packlist)
          <tr>
            <td><a href="{{ route('packlist.show', ['packlist' => $packlist]) }}">{{ $packlist->title }}</a></td>
            <td>{{ $packlist->status }}</td>
            <td>
              @include('packlist.actions')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h5 class="alert alert-warning" style="display: inline-block;">{{ __('No packlists found') }}</h5>
  @endif
@endsection
