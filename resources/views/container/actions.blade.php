<!-- Check In / Check Out -->
@if ($container->checkedIn)
  {!! Form::open(['action' => [[App\Http\Controllers\ContainerController::class, 'checkOut'], $container], 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
    {{Form::submit(__('Check Out'), ['class' => 'btn btn-success'])}}
@else
  {!! Form::open(['action' => [[App\Http\Controllers\ContainerController::class, 'checkIn'], $container], 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
    {{Form::submit(__('Check In'), ['class' => 'btn btn-warning'])}}
@endif
{!! Form::close() !!}

<!-- Edit -->
@include('inc.button-edit', ['root' => 'container', 'object' => $container])

<!-- Delete -->
@include('inc.button-delete', ['class' => App\Http\Controllers\ContainerController::class, 'object' => $container])
