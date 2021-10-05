@extends('layouts.app')

@section('content')
  <h1>Welcome to my world!</h1>

  @if (isset($containerList) && 0 < count($containerList))
    <ul>
    @foreach ($containerList as $container)
      <li>
        <a href="{{ route('container.show', ['container' => $container]) }}">{{ $container->title }}</a>
        {!! Form::open(['action' => [[App\Http\Controllers\ContainerController::class, 'destroy'], $container->id], 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit(__('Delete'), ['class' => 'btn btn-danger'])}}
        {!! Form::close() !!}
      </li>
    @endforeach
    </ul>
  @endif
@endsection
