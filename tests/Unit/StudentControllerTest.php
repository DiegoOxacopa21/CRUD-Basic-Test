<?php

use App\Http\Controllers\StudentController;

// 6. Verificar que el controlador se pueda instanciar sin errores
test('controller instantiation', function () {
    $controller = new StudentController();

    expect($controller)->toBeInstanceOf(StudentController::class);
});
