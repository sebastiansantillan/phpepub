<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    echo "♿ Ejemplo de Metadatos de Accesibilidad Schema.org\n";
    echo "=================================================\n\n";

    // Crear un libro con metadatos de accesibilidad completos
    $epub = new EpubBuilder();
    
    $epub->setTitle('Guía de Accesibilidad Web')
         ->setAuthor('Dr. Ana María Accessibility')
         ->setLanguage('es')
         ->setDescription('Una guía completa sobre accesibilidad web y tecnologías asistivas')
         ->setIsbn('978-84-9876-543-2')
         ->setPublisher('Editorial Inclusiva')
         ->addSubject('Accesibilidad')
         ->addSubject('Web Development')
         ->addSubject('WCAG')
         ->addSubject('Tecnologías Asistivas')
         // Configurar modos de acceso según Schema.org
         ->addAccessMode('textual')   // Contenido de texto
         ->addAccessMode('visual')    // Imágenes, gráficos
         ->addAccessMode('auditory'); // Audio descripciones (si las hubiera)

    echo "📖 Configurando libro con metadatos de accesibilidad:\n";
    echo "   📝 Título: " . $epub->getMetadata()->getTitle() . "\n";
    echo "   👤 Autor: " . $epub->getMetadata()->getAuthor() . "\n";
    echo "   🌍 Idioma: " . $epub->getMetadata()->getLanguage() . "\n";
    
    $accessModes = $epub->getMetadata()->getAccessModes();
    echo "   ♿ Modos de Acceso: " . implode(', ', $accessModes) . "\n\n";

    // Agregar capítulos con contenido sobre accesibilidad
    $epub->addChapter(
        'Introducción a la Accesibilidad Web',
        '<h1>Introducción a la Accesibilidad Web</h1>
        
        <h2>♿ ¿Qué es la Accesibilidad Web?</h2>
        <p>La accesibilidad web significa que sitios web, herramientas y tecnologías están diseñados y desarrollados para que las personas con discapacidades puedan usarlos.</p>
        
        <h2>📊 Modos de Acceso (Schema.org)</h2>
        <p>Este libro incluye los siguientes modos de acceso según el vocabulario Schema.org:</p>
        
        <h3>🔤 Textual</h3>
        <p><strong>Definición:</strong> Contenido que se comunica a través de texto escrito.</p>
        <ul>
            <li>Todo el contenido principal está en formato de texto</li>
            <li>Accesible para lectores de pantalla</li>
            <li>Compatible con tecnologías de aumentación de texto</li>
            <li>Puede ser convertido a Braille</li>
        </ul>
        
        <h3>👁️ Visual</h3>
        <p><strong>Definición:</strong> Contenido que requiere la vista para ser completamente comprendido.</p>
        <ul>
            <li>Diagramas y gráficos explicativos</li>
            <li>Capturas de pantalla de interfaces</li>
            <li>Ejemplos de código con sintaxis coloreada</li>
            <li>Tablas y layouts visuales</li>
        </ul>
        
        <h3>🔊 Auditory (si está presente)</h3>
        <p><strong>Definición:</strong> Contenido que se comunica a través de sonido.</p>
        <ul>
            <li>Audio descripciones de imágenes</li>
            <li>Pronunciación de términos técnicos</li>
            <li>Efectos sonoros descriptivos</li>
        </ul>
        
        <h2>🎯 Beneficios de Declarar Modos de Acceso</h2>
        <ol>
            <li><strong>Lectores Asistivos:</strong> Pueden informar al usuario qué tipo de contenido esperar</li>
            <li><strong>Bibliotecas Digitales:</strong> Pueden filtrar contenido según las necesidades del usuario</li>
            <li><strong>Catálogos:</strong> Mejoran la búsqueda y recomendaciones</li>
            <li><strong>Cumplimiento:</strong> Ayuda a cumplir con estándares de accesibilidad</li>
        </ol>'
    );

    $epub->addChapter(
        'Implementación Técnica',
        '<h1>Implementación Técnica de Metadatos de Accesibilidad</h1>
        
        <h2>📋 Implementación en PHPEpub</h2>
        <p>Los metadatos de accesibilidad se implementan automáticamente en el package OPF:</p>
        
        <pre><code>&lt;meta property="schema:accessMode" content="textual"/&gt;
&lt;meta property="schema:accessMode" content="visual"/&gt;
&lt;meta property="schema:accessMode" content="auditory"/&gt;</code></pre>

        <h2>🔧 API de PHPEpub</h2>
        <pre><code>// Configurar modos de acceso individualmente
$epub-&gt;addAccessMode("textual")
     -&gt;addAccessMode("visual")
     -&gt;addAccessMode("auditory");

// O configurar todos a la vez
$epub-&gt;setAccessModes(["textual", "visual", "auditory"]);

// Verificar si tiene un modo específico
if ($epub-&gt;getMetadata()-&gt;hasAccessMode("textual")) {
    echo "El libro incluye contenido textual";
}</code></pre>

        <h2>📚 Modos de Acceso Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Modo</th>
                    <th>Descripción</th>
                    <th>Ejemplos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>textual</code></td>
                    <td>Contenido de texto</td>
                    <td>Párrafos, listas, código</td>
                </tr>
                <tr>
                    <td><code>visual</code></td>
                    <td>Contenido visual</td>
                    <td>Imágenes, gráficos, diagramas</td>
                </tr>
                <tr>
                    <td><code>auditory</code></td>
                    <td>Contenido auditivo</td>
                    <td>Audio, pronunciación, música</td>
                </tr>
                <tr>
                    <td><code>tactile</code></td>
                    <td>Contenido táctil</td>
                    <td>Braille, texturas, formas 3D</td>
                </tr>
            </tbody>
        </table>

        <h2>✅ Validación y Cumplimiento</h2>
        <p>Los metadatos Schema.org ayudan a cumplir con:</p>
        <ul>
            <li><strong>EPUB Accessibility 1.1:</strong> Especificación oficial</li>
            <li><strong>WCAG 2.1:</strong> Pautas de accesibilidad web</li>
            <li><strong>EN 301 549:</strong> Estándar europeo</li>
            <li><strong>Section 508:</strong> Estándar estadounidense</li>
        </ul>'
    );

    // Mostrar información detallada antes de generar
    echo "📋 Verificando metadatos de accesibilidad:\n";
    $metadata = $epub->getMetadata();
    
    $checkModes = ['textual', 'visual', 'auditory', 'tactile'];
    echo "\n🔍 Verificando modos de acceso:\n";
    foreach ($checkModes as $mode) {
        $hasMode = $metadata->hasAccessMode($mode);
        $status = $hasMode ? '✅' : '❌';
        echo "   {$status} {$mode}\n";
    }

    // Generar el EPUB
    $filename = 'guia-accesibilidad-web.epub';
    echo "\n📚 Generando EPUB: {$filename}\n";
    
    if ($epub->save($filename)) {
        echo "✅ ¡Libro generado exitosamente!\n";
        echo "📦 Archivo: {$filename}\n";
        echo "📊 Tamaño: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
        
        echo "\n🎯 Los metadatos de accesibilidad se incluyen en:\n";
        echo "   📄 Package OPF con propiedades Schema.org\n";
        echo "   🔍 Información para tecnologías asistivas\n";
        echo "   📚 Catálogos de bibliotecas accesibles\n";
        echo "   ♿ Validadores de accesibilidad EPUB\n";
        
        echo "\n📋 Para validar accesibilidad, usa:\n";
        echo "   • DAISY Ace (https://daisy.github.io/ace/)\n";
        echo "   • EPUBCheck con validación de accesibilidad\n";
        echo "   • EPUB Accessibility Checker\n";
        
    } else {
        echo "❌ Error al generar el libro\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    echo "📂 Archivo: " . $e->getFile() . "\n";
}

echo "\n🎉 Ejemplo de accesibilidad completado.\n";
