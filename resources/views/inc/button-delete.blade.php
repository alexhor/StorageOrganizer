{!! Form::open(['action' => [[$class, 'destroy'], $object], 'method' => 'POST', 'style' => 'display: inline-block;']) !!}
  {{Form::hidden('_method', 'DELETE')}}
  {{Form::submit(__('Delete'), ['class' => 'btn btn-danger'])}}
{!! Form::close() !!}
