@extends('layouts.app')

@section('content')
  @if (isset($path))
    @php $pathExists = true; @endphp
    <h1>{{__('Update Path')}}</h1>
  @else
    @php $pathExists = false; @endphp
    <h1>{{__('Create New Path')}}</h1>
  @endif
  <a class="btn" href="{{ url()->previous() }}">{{ __('< Back') }}</a>
  @if ($pathExists)
    @include('inc.button-delete', ['class' => App\Http\Controllers\PathController::class, 'object' => $path])
  @endif

  @if ($pathExists)
    {!! Form::model($path, ['action' => [[App\Http\Controllers\PathController::class, 'update'], $path], 'method' => 'POST']) !!}
  @else
    {!! Form::open(['action' => 'App\Http\Controllers\PathController@store', 'method' => 'POST']) !!}
    @php $path = new App\Models\Path(); @endphp
  @endif
    <!-- Title -->
    <div class="form-group @error('title') is-invalid @enderror">
      {{Form::label('title', __('Title'))}}
      {{Form::text('title', $path->title, ['class' => 'form-control', 'placeholder' => __('Title')])}}
    </div>
    <!-- Description -->
    <div class="form-group @error('description') is-invalid @enderror">
      {{Form::label('description', __('Description'))}}
      {{Form::textarea('description', $path->description, ['class' => 'form-control', 'placeholder' => __('Description')])}}
    </div>
    <!-- Location -->
    <div class="form-group @error('location_id') is-invalid @enderror">
      @php
        $locationList = \App\Models\Location::all()->mapwithKeys(function ($item) {
          return [$item->id => $item->title];
        });
      @endphp
      {{Form::label('location_id', __('Link to'))}}
      {{Form::select('location_id', $locationList, @$path->location->id, ['placeholder' => ''])}}
    </div>
    <!-- PUT method on update -->
    @if ($pathExists)
      {{Form::hidden('_method', 'PUT')}}
    @endif
    <!-- Submit -->
    <div class="form-group">
      @if ($pathExists)
        {{Form::submit(__('Update'))}}
        {{Form::reset(__('Abort'))}}
      @else
        {{Form::submit(__('Create'))}}
        {{Form::reset(__('Abort'))}}
      @endif
    </div>
  {!! Form::close() !!}
@endsection
