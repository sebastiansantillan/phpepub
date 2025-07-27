<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    $epub = new EpubBuilder();

    // Metadatos más completos
    $epub->setTitle('Libro Avanzado con PHPEbook')
         ->setAuthor('Desarrollador Experto')
         ->setLanguage('es')
         ->setDescription('Un ejemplo avanzado que muestra todas las características de PHPEpub')
         ->setIsbn('978-0000000000');

    // Si tienes una imagen de portada, descomenta la siguiente línea
    // $epub->setCover(__DIR__ . '/assets/cover.jpg');

    // Capítulos con contenido más elaborado
    $epub->addChapter(
        'Prefacio',
        '<h1>Prefacio</h1>
        <p>Este libro demuestra características avanzadas de PHPEpub, incluyendo formateo complejo, listas, tablas y más.</p>'
    );

    $epub->addChapter(
        'Listas y Formateo',
        '<h1>Listas y Formateo</h1>
        <h2>Lista de Características</h2>
        <ul>
            <li><strong>Negrita</strong> y <em>cursiva</em></li>
            <li>Listas ordenadas y no ordenadas</li>
            <li>Tablas y código</li>
            <li>Citas y bloques especiales</li>
        </ul>
        
        <h2>Lista Numerada</h2>
        <ol>
            <li>Primer elemento</li>
            <li>Segundo elemento</li>
            <li>Tercer elemento</li>
        </ol>'
    );

    $epub->addChapter(
        'Tablas',
        '<h1>Tablas</h1>
        <p>PHPEpub soporta tablas HTML estándar:</p>
        
        <table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px;">Característica</th>
                    <th style="padding: 8px;">Soporte</th>
                    <th style="padding: 8px;">Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">Metadatos</td>
                    <td style="padding: 8px;">✅ Completo</td>
                    <td style="padding: 8px;">Título, autor, ISBN, etc.</td>
                </tr>
                <tr>
                    <td style="padding: 8px;">Imágenes</td>
                    <td style="padding: 8px;">✅ Completo</td>
                    <td style="padding: 8px;">JPG, PNG, GIF, SVG</td>
                </tr>
                <tr>
                    <td style="padding: 8px;">CSS</td>
                    <td style="padding: 8px;">✅ Completo</td>
                    <td style="padding: 8px;">Estilos personalizados</td>
                </tr>
            </tbody>
        </table>'
    );

    // Si tienes imágenes, puedes agregarlas así:
    // $epub->addImage(__DIR__ . '/assets/diagram.png', 'diagram');

    // Si tienes CSS personalizado:
    // $epub->addStylesheet(__DIR__ . '/assets/custom.css', 'custom');

    // Generar el archivo
    $filename = 'ejemplo-avanzado.epub';
    if ($epub->save($filename)) {
        echo "✅ Libro avanzado generado: {$filename}\n";
        
        // Mostrar información del libro
        $metadata = $epub->getMetadata();
        echo "\n📚 Información del libro:\n";
        echo "   Título: " . $metadata->getTitle() . "\n";
        echo "   Autor: " . $metadata->getAuthor() . "\n";
        echo "   Idioma: " . $metadata->getLanguage() . "\n";
        echo "   Capítulos: " . count($epub->getChapters()) . "\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
