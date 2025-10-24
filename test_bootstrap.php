<?php
require __DIR__.'/vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;

$app = new Container();
$app->singleton('files', function() {
    return new Filesystem();
});

// Ejecutar un comando simple de prueba
echo "Sistema de archivos cargado correctamente!\n";
