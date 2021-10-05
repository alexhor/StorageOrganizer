@extends('layouts.app')

@section('content')
  @if (isset($container))
    @php $containerExists = true; @endphp
    <h1>{{__('Update Container')}}</h1>
  @else
    @php $containerExists = false; @endphp
    <h1>{{__('Create New Container')}}</h1>
  @endif
  <a class="btn" href="{{ url()->previous() }}">{{ __('< Back') }}</a>
  @if ($containerExists)
    @include('inc.button-delete', ['class' => App\Http\Controllers\ContainerController::class, 'object' => $container])
  @endif

  @if ($containerExists)
    {!! Form::model($container, ['action' => [[App\Http\Controllers\ContainerController::class, 'update'], $container], 'method' => 'POST']) !!}
  @else
    {!! Form::open(['action' => 'App\Http\Controllers\ContainerController@store', 'method' => 'POST']) !!}
    @php $container = new App\Models\Container(); @endphp
  @endif
    <!-- Title -->
    <div class="form-group @error('title') is-invalid @enderror">
      {{Form::label('title', __('Title'))}}
      {{Form::text('title', $container->title, ['class' => 'form-control', 'placeholder' => __('Title')])}}
    </div>
    <!-- RFID tag -->
    <div class="form-group @error('rfidTag') is-invalid @enderror">
      {{Form::button(__('RFID Tag'))}}
      {{Form::hidden('rfidTag', $container->rfidTag)}}
    </div>
    <!-- Weight -->
    <div class="form-group @error('weight') is-invalid @enderror">
      {{Form::label('weight', __('Weight'))}}
      {{Form::text('weight', $container->weight, ['class' => 'form-control', 'placeholder' => __('Weight')])}}
    </div>
    <!-- Description -->
    <div class="form-group @error('description') is-invalid @enderror">
      {{Form::label('description', __('Description'))}}
      {{Form::textarea('description', $container->description, ['class' => 'form-control', 'placeholder' => __('Description')])}}
    </div>
    <!-- Contents -->
    <div class="form-group @error('contents') is-invalid @enderror">
      {{Form::label('contents', __('Contents'))}}
      {{Form::textarea('contents', $container->contents, ['class' => 'form-control', 'placeholder' => __('Contents')])}}
      <!-- TODO: convert to WYSIWYG editor -->
    </div>
    <!-- Location -->
    <div class="form-group @error('location') is-invalid @enderror">
      <!-- TODO: load all locations and add them as a dropdown -->
      <!-- https://laravelcollective.com/docs/6.x/html -->
    </div>
    <!-- Status -->
    <div class="form-group @error('status') is-invalid @enderror">
      {{ Form::select('status', \App\Enums\ContainerStatus::asSelectArray(), $container->status) }}
    </div>
    <!-- PUT method on update -->
    @if ($containerExists)
      {{Form::hidden('_method', 'PUT')}}
    @endif
    <!-- Submit -->
    <div class="form-group">
      @if ($containerExists)
        {{Form::submit(__('Update'))}}
        {{Form::reset(__('Abort'))}}
      @else
        {{Form::submit(__('Create'))}}
        {{Form::reset(__('Abort'))}}
      @endif
    </div>
  {!! Form::close() !!}
@endsection
