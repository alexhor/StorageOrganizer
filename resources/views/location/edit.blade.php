@extends('layouts.app')

@section('content')
  @if (isset($location))
    @php $locationExists = true; @endphp
    <h1>{{__('Update Location')}}</h1>
  @else
    @php $locationExists = false; @endphp
    <h1>{{__('Create New Location')}}</h1>
  @endif
  <a class="btn" href="{{ url()->previous() }}">{{ __('< Back') }}</a>
  @if ($locationExists)
    @include('inc.button-delete', ['class' => App\Http\Controllers\LocationController::class, 'object' => $location])
  @endif

  @if ($locationExists)
    {!! Form::model($location, ['action' => [[App\Http\Controllers\LocationController::class, 'update'], $location], 'method' => 'POST']) !!}
  @else
    {!! Form::open(['action' => 'App\Http\Controllers\LocationController@store', 'method' => 'POST']) !!}
    @php $location = new App\Models\Location(); @endphp
  @endif
    <!-- Title -->
    <div class="form-group @error('title') is-invalid @enderror">
      {{Form::label('title', __('Title'))}}
      {{Form::text('title', $location->title, ['class' => 'form-control', 'placeholder' => __('Title')])}}
    </div>
    <!-- Description -->
    <div class="form-group @error('description') is-invalid @enderror">
      {{Form::label('description', __('Description'))}}
      {{Form::textarea('description', $location->description, ['class' => 'form-control', 'placeholder' => __('Description')])}}
    </div>
    <!-- Location -->
    <div class="form-group @error('path_id') is-invalid @enderror">
      @php
        $pathList = \App\Models\Path::all()->mapwithKeys(function ($item) {
          return [$item->id => $item->title];
        });
      @endphp
      {{Form::label('path_id', __('Path'))}}
      {{Form::select('path_id', $pathList, @$location->path->id, ['placeholder' => ''])}}
    </div>
    <!-- PUT method on update -->
    @if ($locationExists)
      {{Form::hidden('_method', 'PUT')}}
    @endif
    <!-- Submit -->
    <div class="form-group">
      @if ($locationExists)
        {{Form::submit(__('Update'))}}
        {{Form::reset(__('Abort'))}}
      @else
        {{Form::submit(__('Create'))}}
        {{Form::reset(__('Abort'))}}
      @endif
    </div>
  {!! Form::close() !!}
@endsection
