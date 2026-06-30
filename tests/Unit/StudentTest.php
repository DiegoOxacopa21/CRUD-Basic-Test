<?php

use App\Models\Student;

// 1. Verificar que los campos fillable sean los esperados
test('fillable attributes', function () {
    $student = new Student();

    $fillable = $student->getFillable();

    expect($fillable)->toBe(['codigo', 'name', 'surname', 'age', 'email']);
});

// 2. Verificar que la tabla asociada sea 'students' (convencion de Laravel)
test('table name', function () {
    $student = new Student();

    $table = $student->getTable();

    expect($table)->toBe('students');
});

// 3. Verificar que los timestamps esten habilitados por defecto
test('timestamps enabled', function () {
    $student = new Student();

    expect($student->timestamps)->toBeTrue();
});
