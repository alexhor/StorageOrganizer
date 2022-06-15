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
            <td class="alert @if ($packlist->status->in([\App\Enums\PacklistStatus::Created, \App\Enums\PacklistStatus::Packing])) alert-primary @elseif ($packlist->status->in([\App\Enums\PacklistStatus::Packed, \App\Enums\PacklistStatus::Checked, \App\Enums\PacklistStatus::Returned])) alert-success @elseif ($packlist->status->is(\App\Enums\PacklistStatus::Touring)) alert-info @elseif ($packlist->status->is(\App\Enums\PacklistStatus::Finished)) alert-secondary @else alert-danger @endif">{{ $packlist->status->description }}</td>
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
