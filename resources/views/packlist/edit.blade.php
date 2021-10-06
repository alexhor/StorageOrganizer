@extends('layouts.app')

@section('content')
  @if (isset($packlist))
    @php $packlistExists = true; @endphp
    <h1>{{__('Update Packlist')}}</h1>
  @else
    @php $packlistExists = false; @endphp
    <h1>{{__('Create New Packlist')}}</h1>
  @endif
  <a class="btn" href="{{ url()->previous() }}">{{ __('< Back') }}</a>
  @if ($packlistExists)
    @include('inc.button-delete', ['class' => App\Http\Controllers\PacklistController::class, 'object' => $packlist])
  @endif

  @if ($packlistExists)
    {!! Form::model($packlist, ['action' => [[App\Http\Controllers\PacklistController::class, 'update'], $packlist], 'method' => 'POST']) !!}
  @else
    {!! Form::open(['action' => 'App\Http\Controllers\PacklistController@store', 'method' => 'POST']) !!}
    @php $packlist = new App\Models\Packlist(); @endphp
  @endif
    <!-- Title -->
    <div class="form-group @error('title') is-invalid @enderror">
      {{Form::label('title', __('Title'))}}
      {{Form::text('title', $packlist->title, ['class' => 'form-control', 'placeholder' => __('Title')])}}
    </div>

    <!-- Description -->
    <div class="form-group @error('description') is-invalid @enderror">
      {{Form::label('description', __('Description'))}}
      {{Form::textarea('description', $packlist->description, ['class' => 'form-control', 'placeholder' => __('Description')])}}
    </div>
    <!-- Contents -->
    <div class="form-group @error('contents') is-invalid @enderror">
      {{Form::label('contents', __('Contents'))}}
      {{Form::textarea('contents', $packlist->contents, ['class' => 'form-control', 'placeholder' => __('Contents')])}}
    </div>

    <!-- Status -->
    <div class="form-group @error('status') is-invalid @enderror">
      {{ Form::select('status', \App\Enums\PacklistStatus::asSelectArray(), $packlist->status) }}
    </div>
    <!-- PUT method on update -->
    @if ($packlistExists)
      {{Form::hidden('_method', 'PUT')}}
    @endif
    <!-- Submit -->
    <div class="form-group">
      @if ($packlistExists)
        {{Form::submit(__('Update'))}}
        {{Form::reset(__('Abort'))}}
      @else
        {{Form::submit(__('Create'))}}
        {{Form::reset(__('Abort'))}}
      @endif
    </div>
  {!! Form::close() !!}

  <!-- Container List -->
  <h3>{{__('Container List')}}</h3>
  @if ($packlistExists)
    <container-list v-bind="{
      packlistId: {{ $packlist->id }},
    }"></container-list>
  @else
    <container-list></container-list>
  @endif
@endsection
