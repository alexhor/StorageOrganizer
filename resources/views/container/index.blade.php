@extends('layouts.app')

@section('content')
  <h1>{{ __('Containers') }}</h1>
  <a href="{{ route('container.create') }}" class="btn btn-info">{{ __('Create New Container') }}</a>
  @if (isset($containerList) && 0 < count($containerList))
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Description')}}</th>
          <th>{{ __('Status') }}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($containerList as $container)
          <tr>
            <td><a href="{{ route('container.show', ['container' => $container]) }}">{{ $container->title }}</a></td>
            <td>{{ $container->description }}</td>
            <td class="alert @if ($container->status->is(\App\Enums\ContainerStatus::Working)) alert-success @elseif ($container->status->is(\App\Enums\ContainerStatus::NeedsCheckup)) alert-warning @else alert-danger @endif">{{ $container->status->description }}</td>
            <td>
              @include('container.actions')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h5 class="alert alert-warning" style="display: inline-block;">{{ __('No containers found') }}</h5>
  @endif
@endsection
