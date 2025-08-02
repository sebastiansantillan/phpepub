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
         ->addAccessMode('auditory')  // Audio descripciones (si las hubiera)
         // Configurar combinaciones suficientes de modos de acceso
         ->addAccessModeSufficient(['textual'])        // Solo texto es suficiente
         ->addAccessModeSufficient(['textual', 'visual']) // Texto + visual es óptimo
         // Configurar características de accesibilidad
         ->addAccessibilityFeature('alternativeText')   // Texto alternativo para imágenes
         ->addAccessibilityFeature('structuralNavigation') // Navegación estructural
         ->addAccessibilityFeature('tableOfContents')   // Tabla de contenidos
         ->addAccessibilityFeature('readingOrder')      // Orden de lectura claro
         ->addAccessibilityFeature('displayTransformability') // Transformación de visualización
         // Configurar riesgos de accesibilidad (declarar que no hay riesgos)
         ->addAccessibilityHazard('noFlashingHazard')   // Sin riesgo de parpadeo
         ->addAccessibilityHazard('noMotionSimulationHazard') // Sin simulación de movimiento
         ->addAccessibilityHazard('noSoundHazard')      // Sin riesgo de sonido
         // Configurar resumen de accesibilidad
         ->setAccessibilitySummary('Este libro está diseñado para ser completamente accesible. Incluye texto alternativo para todas las imágenes, navegación estructural clara, y cumple con WCAG 2.1 Nivel AA.')
         // Configurar certificación de accesibilidad
         ->setCertifiedBy('Editorial Inclusiva - Departamento de Accesibilidad')
         ->setCertifierCredential('Certificación IAAP CPACC - Certified Professional in Accessibility Core Competencies')
         ->setCertifierReport('https://editorial-inclusiva.com/reportes/accesibilidad/guia-web-2024.html')
         // Configurar estándares de cumplimiento
         ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
         ->addConformsTo('https://www.w3.org/TR/WCAG21/');

    echo "📖 Configurando libro con metadatos de accesibilidad completos:\n";
    echo "   📝 Título: " . $epub->getMetadata()->getTitle() . "\n";
    echo "   👤 Autor: " . $epub->getMetadata()->getAuthor() . "\n";
    echo "   🌍 Idioma: " . $epub->getMetadata()->getLanguage() . "\n";
    
    $accessModes = $epub->getMetadata()->getAccessModes();
    echo "   ♿ Modos de Acceso: " . implode(', ', $accessModes) . "\n";
    
    $features = $epub->getMetadata()->getAccessibilityFeatures();
    echo "   ✨ Características: " . implode(', ', array_slice($features, 0, 3)) . (count($features) > 3 ? ', ...' : '') . "\n";
    
    $hazards = $epub->getMetadata()->getAccessibilityHazards();
    echo "   ⚠️ Riesgos: " . implode(', ', $hazards) . "\n";
    
    $standards = $epub->getMetadata()->getConformsTo();
    echo "   📋 Cumple con: " . (count($standards) > 0 ? $standards[0] : 'N/A') . "\n\n";

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
        </ol>

        <h2>🔧 Metadatos Completos de EPUB Accessibility 1.1</h2>
        <p>Este libro implementa <strong>todos</strong> los metadatos de accesibilidad requeridos:</p>

        <h3>📊 Schema.org Metadatos</h3>
        <ul>
            <li><code>schema:accessMode</code> - Modos de acceso disponibles</li>
            <li><code>schema:accessModeSufficient</code> - Combinaciones suficientes de acceso</li>
            <li><code>schema:accessibilityFeature</code> - Características de accesibilidad</li>
            <li><code>schema:accessibilityHazard</code> - Riesgos de accesibilidad</li>
            <li><code>schema:accessibilitySummary</code> - Resumen de accesibilidad</li>
        </ul>

        <h3>🏆 Metadatos de Certificación</h3>
        <ul>
            <li><code>a11y:certifiedBy</code> - Quién certifica la accesibilidad</li>
            <li><code>a11y:certifierCredential</code> - Credenciales del certificador</li>
            <li><code>a11y:certifierReport</code> - URL del reporte de certificación</li>
        </ul>

        <h3>📜 Metadatos de Cumplimiento</h3>
        <ul>
            <li><code>dcterms:conformsTo</code> - Estándares con los que cumple</li>
        </ul>'
    );

    $epub->addChapter(
        'Implementación Técnica',
        '<h1>Implementación Técnica de Metadatos de Accesibilidad</h1>
        
        <h2>📋 Implementación en PHPEpub</h2>
        <p>Los metadatos de accesibilidad se implementan automáticamente en el package OPF:</p>
        
        <pre><code>&lt;meta property="schema:accessMode" content="textual"/&gt;
&lt;meta property="schema:accessMode" content="visual"/&gt;
&lt;meta property="schema:accessMode" content="auditory"/&gt;</code></pre>

        <h2>🔧 API Completa de PHPEpub</h2>
        <pre><code>// Configurar modos de acceso
$epub-&gt;addAccessMode("textual")
     -&gt;addAccessMode("visual")
     -&gt;addAccessMode("auditory");

// Configurar combinaciones suficientes
$epub-&gt;addAccessModeSufficient(["textual"])
     -&gt;addAccessModeSufficient(["textual", "visual"]);

// Configurar características de accesibilidad
$epub-&gt;addAccessibilityFeature("alternativeText")
     -&gt;addAccessibilityFeature("structuralNavigation")
     -&gt;addAccessibilityFeature("tableOfContents");

// Configurar riesgos (declarar que no hay)
$epub-&gt;addAccessibilityHazard("noFlashingHazard")
     -&gt;addAccessibilityHazard("noMotionSimulationHazard");

// Configurar resumen y certificación
$epub-&gt;setAccessibilitySummary("Completamente accesible según WCAG 2.1 AA")
     -&gt;setCertifiedBy("Editorial Inclusiva")
     -&gt;setCertifierCredential("IAAP CPACC")
     -&gt;addConformsTo("EPUB Accessibility 1.1 - WCAG 2.1 Level AA");</code></pre>

        <h2>📚 Características de Accesibilidad Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Característica</th>
                    <th>Descripción</th>
                    <th>Uso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>alternativeText</code></td>
                    <td>Texto alternativo para imágenes</td>
                    <td>Todas las imágenes tienen alt text</td>
                </tr>
                <tr>
                    <td><code>structuralNavigation</code></td>
                    <td>Navegación por estructura</td>
                    <td>Encabezados, listas, landmarks</td>
                </tr>
                <tr>
                    <td><code>tableOfContents</code></td>
                    <td>Tabla de contenidos</td>
                    <td>TOC navegable</td>
                </tr>
                <tr>
                    <td><code>readingOrder</code></td>
                    <td>Orden de lectura claro</td>
                    <td>Secuencia lógica de contenido</td>
                </tr>
                <tr>
                    <td><code>displayTransformability</code></td>
                    <td>Adaptación de visualización</td>
                    <td>Zoom, contraste, fuentes</td>
                </tr>
            </tbody>
        </table>

        <h2>⚠️ Gestión de Riesgos de Accesibilidad</h2>
        <p>Es importante declarar explícitamente la ausencia de riesgos:</p>
        <ul>
            <li><code>noFlashingHazard</code> - Sin contenido que parpadee (evita convulsiones)</li>
            <li><code>noMotionSimulationHazard</code> - Sin simulación de movimiento (evita mareos)</li>
            <li><code>noSoundHazard</code> - Sin sonidos inesperados (no asusta al usuario)</li>
        </ul>

        <h2>✅ Validación y Cumplimiento</h2>
        <p>Los metadatos Schema.org ayudan a cumplir con:</p>
        <ul>
            <li><strong>EPUB Accessibility 1.1:</strong> Especificación oficial</li>
            <li><strong>WCAG 2.1:</strong> Pautas de accesibilidad web</li>
            <li><strong>EN 301 549:</strong> Estándar europeo</li>
            <li><strong>Section 508:</strong> Estándar estadounidense</li>
        </ul>'
    );

    $epub->addChapter(
        'Certificación y Cumplimiento',
        '<h1>Certificación y Cumplimiento de Accesibilidad</h1>
        
        <h2>🏆 Certificación de Accesibilidad</h2>
        <p>Este libro ha sido certificado por <strong>Editorial Inclusiva - Departamento de Accesibilidad</strong>, cuyos especialistas poseen credenciales <strong>IAAP CPACC</strong> (Certified Professional in Accessibility Core Competencies).</p>

        <h3>📋 Proceso de Certificación</h3>
        <ol>
            <li><strong>Revisión de Contenido:</strong> Verificación de texto alternativo, estructura y navegación</li>
            <li><strong>Pruebas con Tecnologías Asistivas:</strong> Validación con lectores de pantalla</li>
            <li><strong>Cumplimiento de Estándares:</strong> Verificación contra WCAG 2.1 Level AA</li>
            <li><strong>Documentación:</strong> Creación de reporte detallado de cumplimiento</li>
        </ol>

        <h2>📜 Estándares de Cumplimiento</h2>
        <p>Este EPUB cumple con los siguientes estándares:</p>

        <h3>🌐 EPUB Accessibility 1.1 - WCAG 2.1 Level AA</h3>
        <ul>
            <li><strong>Perceptible:</strong> Información presentada de forma perceptible</li>
            <li><strong>Operable:</strong> Componentes de interfaz navegables</li>
            <li><strong>Comprensible:</strong> Información y UI comprensibles</li>
            <li><strong>Robusto:</strong> Compatible con tecnologías asistivas</li>
        </ul>

        <h3>🔗 Referencias Normativas</h3>
        <ul>
            <li><a href="https://www.w3.org/TR/WCAG21/">WCAG 2.1</a> - Web Content Accessibility Guidelines</li>
            <li><a href="https://www.w3.org/TR/epub-a11y-11/">EPUB Accessibility 1.1</a> - EPUB Accessibility Specification</li>
            <li><a href="https://schema.org/docs/accessibility.html">Schema.org Accessibility</a> - Vocabulario de accesibilidad</li>
        </ul>

        <h2>🔍 Verificación y Validación</h2>
        <p>Para verificar la accesibilidad de este EPUB, se han utilizado las siguientes herramientas:</p>
        
        <table>
            <thead>
                <tr>
                    <th>Herramienta</th>
                    <th>Propósito</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DAISY Ace</td>
                    <td>Validación de accesibilidad EPUB</td>
                    <td>✅ Sin errores</td>
                </tr>
                <tr>
                    <td>EPUBCheck</td>
                    <td>Validación de estructura EPUB</td>
                    <td>✅ Válido</td>
                </tr>
                <tr>
                    <td>NVDA</td>
                    <td>Pruebas con lector de pantalla</td>
                    <td>✅ Completamente navegable</td>
                </tr>
                <tr>
                    <td>JAWS</td>
                    <td>Pruebas con lector de pantalla</td>
                    <td>✅ Completamente navegable</td>
                </tr>
            </tbody>
        </table>

        <h2>📊 Reporte de Cumplimiento</h2>
        <p>El reporte completo de certificación está disponible en:</p>
        <p><a href="https://editorial-inclusiva.com/reportes/accesibilidad/guia-web-2024.html">https://editorial-inclusiva.com/reportes/accesibilidad/guia-web-2024.html</a></p>

        <p>Este reporte incluye:</p>
        <ul>
            <li>Detalles técnicos de implementación</li>
            <li>Capturas de pantalla de pruebas</li>
            <li>Lista de verificación completa WCAG 2.1</li>
            <li>Recomendaciones para mantenimiento</li>
        </ul>

        <h2>♿ Compromiso de Accesibilidad</h2>
        <blockquote>
            <p><em>"La accesibilidad no es una característica opcional, es un derecho fundamental. Este libro demuestra que es posible crear contenido digital que sea verdaderamente inclusivo para todas las personas, independientemente de sus capacidades."</em></p>
            <footer>— Dr. Ana María Accessibility, Autora</footer>
        </blockquote>'
    );

    // Mostrar información detallada antes de generar
    echo "📋 Verificando metadatos de accesibilidad completos:\n";
    $metadata = $epub->getMetadata();
    
    $checkModes = ['textual', 'visual', 'auditory', 'tactile'];
    echo "\n🔍 Verificando modos de acceso:\n";
    foreach ($checkModes as $mode) {
        $hasMode = $metadata->hasAccessMode($mode);
        $status = $hasMode ? '✅' : '❌';
        echo "   {$status} {$mode}\n";
    }

    echo "\n✨ Características de accesibilidad:\n";
    $features = $metadata->getAccessibilityFeatures();
    foreach (array_slice($features, 0, 5) as $feature) {
        echo "   ✅ {$feature}\n";
    }
    if (count($features) > 5) {
        echo "   ... y " . (count($features) - 5) . " más\n";
    }

    echo "\n⚠️ Riesgos de accesibilidad:\n";
    $hazards = $metadata->getAccessibilityHazards();
    foreach ($hazards as $hazard) {
        echo "   ✅ {$hazard}\n";
    }

    echo "\n📜 Cumplimiento con estándares:\n";
    $standards = $metadata->getConformsTo();
    foreach ($standards as $standard) {
        echo "   ✅ " . (strlen($standard) > 50 ? substr($standard, 0, 47) . '...' : $standard) . "\n";
    }

    echo "\n🏆 Certificación:\n";
    echo "   👤 Certificado por: " . ($metadata->getCertifiedBy() ?: 'N/A') . "\n";
    echo "   🎓 Credencial: " . ($metadata->getCertifierCredential() ?: 'N/A') . "\n";
    echo "   📄 Reporte: " . ($metadata->getCertifierReport() ? 'Disponible' : 'N/A') . "\n";

    // Generar el EPUB
    $filename = 'guia-accesibilidad-web.epub';
    echo "\n📚 Generando EPUB: {$filename}\n";
    
    if ($epub->save($filename)) {
        echo "✅ ¡Libro generado exitosamente!\n";
        echo "📦 Archivo: {$filename}\n";
        echo "📊 Tamaño: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
        
        echo "\n🎯 Los metadatos de accesibilidad completos se incluyen en:\n";
        echo "   📄 Package OPF con propiedades Schema.org y EPUB Accessibility 1.1\n";
        echo "   🔍 Información detallada para tecnologías asistivas\n";
        echo "   📚 Catálogos de bibliotecas accesibles\n";
        echo "   ♿ Validadores de accesibilidad EPUB (DAISY Ace, EPUBCheck)\n";
        echo "   🏆 Certificación y credenciales de accesibilidad\n";
        echo "   📜 Referencias a estándares de cumplimiento\n";
        
        echo "\n📋 Para validar accesibilidad completa, usa:\n";
        echo "   • DAISY Ace (https://daisy.github.io/ace/)\n";
        echo "   • EPUBCheck con validación de accesibilidad\n";
        echo "   • EPUB Accessibility Checker\n";
        echo "   • Lectores de pantalla (NVDA, JAWS, VoiceOver)\n";
        
        echo "\n📊 Metadatos implementados:\n";
        echo "   ✅ schema:accessMode ({" . count($metadata->getAccessModes()) . "})\n";
        echo "   ✅ schema:accessModeSufficient ({" . count($metadata->getAccessModeSufficient()) . "})\n";
        echo "   ✅ schema:accessibilityFeature ({" . count($metadata->getAccessibilityFeatures()) . "})\n";
        echo "   ✅ schema:accessibilityHazard ({" . count($metadata->getAccessibilityHazards()) . "})\n";
        echo "   ✅ schema:accessibilitySummary\n";
        echo "   ✅ a11y:certifiedBy\n";
        echo "   ✅ a11y:certifierCredential\n";
        echo "   ✅ a11y:certifierReport\n";
        echo "   ✅ dcterms:conformsTo ({" . count($metadata->getConformsTo()) . "})\n";
        
    } else {
        echo "❌ Error al generar el libro\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    echo "📂 Archivo: " . $e->getFile() . "\n";
}

echo "\n🎉 Ejemplo de accesibilidad completado.\n";
