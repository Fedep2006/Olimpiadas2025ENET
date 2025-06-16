// Rutas para habitaciones
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/habitaciones/{id}', [App\Http\Controllers\Admin\HabitacionController::class, 'show']);
}); 