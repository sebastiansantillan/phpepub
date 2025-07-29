<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;
use PHPEpub\Structure\Metadata;
use PHPEpub\Structure\Chapter;

// Prueba específica para manejar acentos en nombres de archivos
echo "🧪 Probando manejo de acentos en nombres de archivos...\n\n";

try {
    $metadata = new Metadata(
        'Ñandú: La Programación en Español', // Título con ñ
        'José María Aznar y González',        // Nombre con acentos y ñ
        'es'
    );
    
    $metadata->setDescription('Guía de programación con énfasis en español, incluyendo ñ, tildes y caracteres especiales: ¡Ñoño! ¿Cómo?, ¡Excelente!')
             ->addSubject('Programación')
             ->addSubject('Español')
             ->addSubject('Tutorial')
             ->addSubject('Acentos');
    
    $epub = new EpubBuilder($metadata);
    
    $epub->addChapter(
        'Introducción al Ñandú: Programación en Español',
        '<h1>¡Bienvenidos al mundo del Ñandú!</h1>
        <p>Este capítulo incluye todos los acentos del español:</p>
        <ul>
            <li><strong>Vocales acentuadas:</strong> á, é, í, ó, ú</li>
            <li><strong>Ñ mayúscula y minúscula:</strong> Ñ, ñ</li>
            <li><strong>Diéresis:</strong> ü (como en pingüino)</li>
            <li><strong>Signos de interrogación:</strong> ¿Cómo estás?</li>
            <li><strong>Signos de exclamación:</strong> ¡Qué bueno!</li>
        </ul>
        <h2>Ejemplos de código en español</h2>
        <pre><code>
// Función para saludar en español
function saludarEnEspañol(nombre) {
    return `¡Hola ${nombre}! ¿Cómo estás?`;
}

// Variables con acentos (permitido en ES6+)
const niño = "José";
const año = 2024;
const españoles = ["María", "José", "Ángel"];
        </code></pre>
        <p><strong>Nota:</strong> Los caracteres especiales del español se manejan correctamente en UTF-8.</p>',
        'introduccion-nandu.xhtml'
    );
    
    // Generar nombre de archivo basado en el título  
    $filename = 'nandu-programacion-espanol.epub';
    $success = $epub->save($filename);
    
    if (!$success) {
        throw new Exception("Error al guardar el archivo EPUB");
    }
    
    echo "✅ ¡Libro generado exitosamente!\n";
    echo "📖 Información del libro:\n";
    echo "   📝 Título: " . $metadata->getTitle() . "\n";
    echo "   👤 Autor: " . $metadata->getAuthor() . "\n";
    echo "   📦 Archivo: $filename\n";
    echo "   📊 Tamaño: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
    
    // Verificar que el archivo se puede leer correctamente
    if (file_exists($filename) && is_readable($filename)) {
        echo "✅ El archivo se creó correctamente y es legible\n";
        echo "📁 Ruta completa: " . realpath($filename) . "\n";
    } else {
        echo "❌ Error: El archivo no se pudo crear o no es legible\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    echo "📂 Archivo: " . $e->getFile() . "\n";
}

echo "\n🎯 Prueba completada.\n";
