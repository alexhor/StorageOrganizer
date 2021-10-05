<!-- Edit -->
@include('inc.button-edit', ['root' => 'path', 'object' => $path])

<!-- Delete -->
@include('inc.button-delete', ['class' => App\Http\Controllers\PathController::class, 'object' => $path])
