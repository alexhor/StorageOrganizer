<!-- Edit -->
@include('inc.button-edit', ['root' => 'packlist', 'object' => $packlist])

<!-- Delete -->
@include('inc.button-delete', ['class' => App\Http\Controllers\PacklistController::class, 'object' => $packlist])
