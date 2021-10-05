@extends('layouts.app')

@section('content')
  <h1>{{ __('Container') }} "{{ $container->title }}"</h1>
  <a class="btn" href="{{ route('container.index') }}">{{ __('< Back') }}</a>
  @include('container.actions')
  <br><br>

  <table class="table table-striped">
    <tr>
      <th>{{ __('Weight') }}</th>
      <td>{{ $container->weight }}kg</td>
    </tr>
    <tr>
      <th>{{ __('RFID Tag') }}</th>
      <td>{{ $container->rfidTag }}</td>
    </tr>
    <tr>
      <th>{{ __('Status') }}</th>
      <td class="alert @if ($container->status->is(\App\Enums\ContainerStatus::Working)) alert-success @elseif ($container->status->is(\App\Enums\ContainerStatus::NeedsCheckup)) alert-warning @else alert-danger @endif">{{ $container->status->description }}</td>
    </tr>
  </table>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Description') }}</h5>
    <pre class="card-text">{{ $container->description }}</pre>
  </div>

  <div class="card card-body">
    <h5 class="card-title">{{ __('Contents') }}</h5>
    <pre class="card-text">{{ $container->contents }}</pre>
  </div>
@endsection
