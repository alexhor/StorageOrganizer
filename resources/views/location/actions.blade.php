<!-- Edit -->
@include('inc.button-edit', ['root' => 'location', 'object' => $location])

<!-- Delete -->
@include('inc.button-delete', ['class' => App\Http\Controllers\LocationController::class, 'object' => $location])
