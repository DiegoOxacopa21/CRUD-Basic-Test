<?php

use App\View\Components\Modal;

// 5. Verificar que el componente Modal se pueda instanciar sin errores
test('modal instantiation', function () {
    $modal = new Modal();

    expect($modal)->toBeInstanceOf(Modal::class);
});
