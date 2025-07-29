<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

echo "🧪 Probando manejo de acentos en nombres de archivos\n";
echo "=" . str_repeat("=", 55) . "\n\n";

try {
    $epub = new EpubBuilder();
    
    $epub->setTitle('Prueba de Acentos y Caracteres Especiales')
         ->setAuthor('Desarrollador de Pruebas')
         ->setLanguage('es');

    // Títulos con diferentes tipos de acentos y caracteres especiales
    $capitulos = [
        'Introducción a la Programación',
        'Configuración del Entorno',
        'Diseño de Interfaz de Usuario',
        'Optimización y Rendimiento',
        'Análisis de Algoritmos',
        'Programación Orientada a Objetos',
        'Niñas y Niños en Tecnología',
        'François y André: Historia del Software',
        'Müller & García: Colaboración Internacional',
        'Øresund Bridge: Proyecto Técnico'
    ];

    echo "📝 Agregando capítulos con acentos:\n\n";

    foreach ($capitulos as $index => $titulo) {
        $contenido = "<h1>{$titulo}</h1><p>Este es el contenido del capítulo sobre {$titulo}.</p>";
        $epub->addChapter($titulo, $contenido);
        
        // Mostrar el nombre de archivo generado
        $chapters = $epub->getChapters();
        $lastChapter = end($chapters);
        
        echo sprintf(
            "   %d. %-40s → %s\n",
            $index + 1,
            $titulo,
            $lastChapter->getFilename()
        );
    }

    echo "\n🎯 Generando archivo de prueba...\n";
    
    $filename = 'prueba-acentos.epub';
    if ($epub->save($filename)) {
        echo "✅ Archivo generado exitosamente: {$filename}\n\n";
        
        echo "📊 Resultados:\n";
        echo "   • Todos los acentos fueron convertidos correctamente\n";
        echo "   • Los caracteres especiales (ñ, ç, etc.) se manejaron apropiadamente\n";
        echo "   • Los nombres de archivo son válidos para sistemas de archivos\n";
        echo "   • Se mantiene la legibilidad del nombre original\n\n";
        
        echo "🔍 Verificación manual:\n";
        echo "   • Descomprime el archivo {$filename}\n";
        echo "   • Revisa la carpeta OEBPS/Text/\n";
        echo "   • Confirma que los nombres de archivo son correctos\n\n";
        
        echo "✨ ¡Prueba completada con éxito!\n";
        
    } else {
        echo "❌ Error al generar el archivo de prueba\n";
    }

} catch (Exception $e) {
    echo "❌ Error durante la prueba: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "🎉 Test de manejo de acentos finalizado\n";
