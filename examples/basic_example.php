<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    // Crear una nueva instancia del builder
    $epub = new EpubBuilder();

    // Configurar metadatos
    $epub->setTitle('Mi Primer Libro con PHPEbook')
         ->setAuthor('Autor de Ejemplo')
         ->setLanguage('es')
         ->setDescription('Este es un libro de ejemplo creado con la librería PHPEbook para demostrar sus capacidades básicas.');

    // Agregar capítulos
    $epub->addChapter(
        'Introducción',
        '<h1>Introducción</h1>
        <p>Bienvenido a este libro de ejemplo. En este primer capítulo exploraremos las características básicas de la librería PHPEpub.</p>
        <p>PHPEpub te permite crear archivos EPUB de forma sencilla y programática, con soporte completo para metadatos, múltiples capítulos, imágenes y estilos CSS.</p>'
    );

    $epub->addChapter(
        'Características Principales',
        '<h1>Características Principales</h1>
        <h2>Facilidad de Uso</h2>
        <p>La librería está diseñada con una interfaz fluida que permite encadenar métodos de configuración.</p>
        
        <h2>Compatibilidad</h2>
        <p>Genera archivos EPUB 3.0 compatibles con la mayoría de lectores de libros electrónicos.</p>
        
        <h2>Personalización</h2>
        <p>Permite agregar estilos CSS personalizados, imágenes y metadatos completos.</p>'
    );

    $epub->addChapter(
        'Código de Ejemplo',
        '<h1>Código de Ejemplo</h1>
        <p>Aquí tienes un ejemplo básico de cómo usar PHPEpub:</p>
        
        <pre><code>use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();
$epub->setTitle("Mi Libro")
     ->setAuthor("Mi Nombre")
     ->addChapter("Capítulo 1", "&lt;h1&gt;Primer Capítulo&lt;/h1&gt;")
     ->save("mi-libro.epub");</code></pre>
     
        <p>¡Es así de simple!</p>'
    );

    $epub->addChapter(
        'Conclusión',
        '<h1>Conclusión</h1>
        <p>Esperamos que este ejemplo te haya sido útil para entender cómo funciona PHPEpub.</p>
        <p>Para más información, consulta la documentación completa en el repositorio del proyecto.</p>
        
        <blockquote>
            <p>"La simplicidad es la máxima sofisticación." - Leonardo da Vinci</p>
        </blockquote>'
    );

    // Generar el archivo EPUB
    $filename = 'ejemplo-phpebook.epub';
    if ($epub->save($filename)) {
        echo "✅ Libro generado exitosamente: {$filename}\n";
        echo "📖 Puedes abrir este archivo con cualquier lector de EPUB\n";
    } else {
        echo "❌ Error al generar el libro\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
