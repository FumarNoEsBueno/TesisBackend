<?php
require __DIR__.'/vendor/autoload.php';

// Cargar la aplicación
$app = require __DIR__.'/bootstrap/app.php';

// Iniciar la aplicación
$app->boot();

// Verificar si el servicio files está disponible
try {
    $files = $app->make('files');
    echo "✅ Filesystem cargado correctamente!\n";
    
    // Prueba simple de existencia de archivo
    $testFile = __FILE__;
    if ($files->exists($testFile)) {
        echo "✅ Archivo verificado: " . basename($testFile) . "\n";
    } else {
        echo "❌ Error: No se pudo verificar el archivo\n";
    }
    
    // Prueba de lectura de directorio
    $currentDir = __DIR__;
    $filesInDir = $files->files($currentDir);
    echo "✅ Archivos en el directorio actual: " . count($filesInDir) . "\n";
    
} catch (Exception $e) {
    echo "❌ Error crítico: " . $e->getMessage() . "\n";
    echo "Detalles: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
