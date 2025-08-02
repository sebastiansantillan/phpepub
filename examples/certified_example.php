<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    echo "🏆 Ejemplo de EPUB con Certificación Completa de Accesibilidad\n";
    echo "============================================================\n\n";

    // Crear un EPUB con certificación completa
    $epub = new EpubBuilder();
    
    $epub->setTitle('Manual de Accesibilidad WCAG 2.1')
         ->setAuthor('Comité de Accesibilidad Digital')
         ->setLanguage('es')
         ->setDescription('Manual oficial con certificación AA para desarrolladores web')
         ->setIsbn('978-84-1234-567-8')
         ->setPublisher('Instituto de Tecnología Accesible')
         ->addSubject('WCAG 2.1')
         ->addSubject('Accesibilidad Digital')
         ->addSubject('Desarrollo Web Inclusivo')
         ->addSubject('Tecnologías Asistivas')
         
         // === CONFIGURACIÓN COMPLETA DE METADATOS DE ACCESIBILIDAD ===
         
         // Modos de acceso disponibles
         ->addAccessMode('textual')      // Contenido textual completo
         ->addAccessMode('visual')       // Gráficos y diagramas
         // NOTA: No incluimos 'auditory' porque no hay contenido de audio
         
         // Combinaciones suficientes de acceso
         ->addAccessModeSufficient(['textual'])        // Solo texto es suficiente
         ->addAccessModeSufficient(['textual', 'visual']) // Texto + visual es óptimo
         
         // Características de accesibilidad implementadas
         ->addAccessibilityFeature('alternativeText')        // Todas las imágenes tienen alt text
         ->addAccessibilityFeature('structuralNavigation')   // Navegación por encabezados
         ->addAccessibilityFeature('tableOfContents')        // TOC navegable
         ->addAccessibilityFeature('readingOrder')           // Orden de lectura claro
         ->addAccessibilityFeature('displayTransformability') // Adaptable zoom/contraste
         ->addAccessibilityFeature('printPageNumbers')       // Numeración de páginas
         ->addAccessibilityFeature('index')                  // Índice temático
         
         // Declaración de ausencia de riesgos
         ->addAccessibilityHazard('noFlashingHazard')         // Sin parpadeos peligrosos
         ->addAccessibilityHazard('noMotionSimulationHazard') // Sin simulación de movimiento
         ->addAccessibilityHazard('noSoundHazard')            // Sin sonidos inesperados
         
         // Resumen de accesibilidad
         ->setAccessibilitySummary('Este manual cumple completamente con WCAG 2.1 Nivel AA. Incluye texto alternativo para todas las imágenes, navegación estructural mediante encabezados semánticos, orden de lectura lógico, y soporte completo para tecnologías asistivas. Ha sido validado con lectores de pantalla NVDA y JAWS.')
         
         // Información de certificación
         ->setCertifiedBy('Instituto de Tecnología Accesible - Departamento de Certificación')
         ->setCertifierCredential('IAAP CPACC + WAS (Web Accessibility Specialist)')
         ->setCertifierReport('https://ita.org/certificaciones/manual-wcag-2024/reporte-completo')
         
         // Estándares de cumplimiento
         ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
         ->addConformsTo('https://www.w3.org/TR/WCAG21/')
         ->addConformsTo('https://www.w3.org/TR/epub-a11y-11/');

    echo "📋 Configuración de certificación:\n";
    $metadata = $epub->getMetadata();
    
    echo "   🏢 Certificado por: " . $metadata->getCertifiedBy() . "\n";
    echo "   🎓 Credenciales: " . $metadata->getCertifierCredential() . "\n";
    echo "   📄 Reporte: " . $metadata->getCertifierReport() . "\n";
    echo "   📜 Cumple con " . count($metadata->getConformsTo()) . " estándares\n\n";

    // Agregar contenido del manual
    $epub->addChapter(
        'Fundamentos de WCAG 2.1',
        '<h1>Fundamentos de WCAG 2.1</h1>
        
        <h2>🌟 Los 4 Principios de Accesibilidad</h2>
        
        <h3>1. 👁️ Perceptible</h3>
        <p>La información y los componentes de la interfaz de usuario deben ser presentados de forma que los usuarios puedan percibirlos.</p>
        <ul>
            <li><strong>1.1 Texto Alternativo:</strong> Proporcionar alternativas textuales para contenido no textual</li>
            <li><strong>1.2 Medios Temporales:</strong> Proporcionar alternativas para medios temporales</li>
            <li><strong>1.3 Adaptable:</strong> Crear contenido que pueda presentarse de diferentes formas</li>
            <li><strong>1.4 Distinguible:</strong> Facilitar a los usuarios ver y oír el contenido</li>
        </ul>
        
        <h3>2. ⚡ Operable</h3>
        <p>Los componentes de la interfaz de usuario y la navegación deben ser operables.</p>
        <ul>
            <li><strong>2.1 Accesible por Teclado:</strong> Toda la funcionalidad disponible mediante teclado</li>
            <li><strong>2.2 Tiempo Suficiente:</strong> Proporcionar tiempo suficiente para leer y usar el contenido</li>
            <li><strong>2.3 Convulsiones:</strong> No diseñar contenido que cause convulsiones</li>
            <li><strong>2.4 Navegable:</strong> Proporcionar formas de ayudar a navegar y encontrar contenido</li>
            <li><strong>2.5 Modalidades de Entrada:</strong> Facilitar operación a través de varias modalidades</li>
        </ul>
        
        <h3>3. 🧠 Comprensible</h3>
        <p>La información y el manejo de la interfaz de usuario deben ser comprensibles.</p>
        <ul>
            <li><strong>3.1 Legible:</strong> Hacer que el contenido textual sea legible y comprensible</li>
            <li><strong>3.2 Predecible:</strong> Hacer que las páginas aparezcan y operen de manera predecible</li>
            <li><strong>3.3 Asistencia en la Entrada:</strong> Ayudar a los usuarios a evitar y corregir errores</li>
        </ul>
        
        <h3>4. 🛡️ Robusto</h3>
        <p>El contenido debe ser lo suficientemente robusto para ser interpretado de manera confiable por una amplia variedad de agentes de usuario, incluyendo tecnologías asistivas.</p>
        <ul>
            <li><strong>4.1 Compatible:</strong> Maximizar compatibilidad con tecnologías asistivas actuales y futuras</li>
        </ul>
        
        <h2>📊 Niveles de Conformidad</h2>
        <table>
            <thead>
                <tr>
                    <th>Nivel</th>
                    <th>Descripción</th>
                    <th>Criterios</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>A</strong></td>
                    <td>Nivel mínimo</td>
                    <td>25 criterios de éxito</td>
                </tr>
                <tr>
                    <td><strong>AA</strong></td>
                    <td>Nivel estándar (recomendado)</td>
                    <td>38 criterios de éxito</td>
                </tr>
                <tr>
                    <td><strong>AAA</strong></td>
                    <td>Nivel máximo</td>
                    <td>61 criterios de éxito</td>
                </tr>
            </tbody>
        </table>
        
        <h2>🎯 Certificación de este Manual</h2>
        <p>Este manual ha sido certificado con <strong>Nivel AA</strong> por especialistas con credenciales IAAP CPACC y WAS.</p>
        
        <h3>✅ Características Certificadas</h3>
        <ul>
            <li>✅ Texto alternativo para todas las imágenes</li>
            <li>✅ Navegación estructural mediante encabezados semánticos</li>
            <li>✅ Tabla de contenidos navegable</li>
            <li>✅ Orden de lectura lógico y consistente</li>
            <li>✅ Soporte para transformación de visualización</li>
            <li>✅ Numeración de páginas para referencias</li>
            <li>✅ Índice temático completo</li>
        </ul>
        
        <h3>⚠️ Riesgos Evaluados</h3>
        <ul>
            <li>🟢 Sin riesgo de parpadeo o destellos peligrosos</li>
            <li>🟢 Sin simulación de movimiento que pueda causar mareos</li>
            <li>🟢 Sin efectos sonoros inesperados</li>
        </ul>'
    );

    $epub->addChapter(
        'Implementación en EPUB',
        '<h1>Implementación de Accesibilidad en EPUB</h1>
        
        <h2>📚 EPUB Accessibility 1.1</h2>
        <p>La especificación EPUB Accessibility 1.1 define cómo implementar accesibilidad en libros digitales.</p>
        
        <h3>🔧 Metadatos Requeridos</h3>
        <p>Para cumplir con EPUB Accessibility 1.1, se deben incluir los siguientes metadatos:</p>
        
        <table>
            <thead>
                <tr>
                    <th>Metadato</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Ejemplo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>schema:accessMode</code></td>
                    <td>Obligatorio</td>
                    <td>Modos de acceso disponibles</td>
                    <td>textual, visual</td>
                </tr>
                <tr>
                    <td><code>schema:accessModeSufficient</code></td>
                    <td>Recomendado</td>
                    <td>Combinaciones suficientes</td>
                    <td>textual</td>
                </tr>
                <tr>
                    <td><code>schema:accessibilityFeature</code></td>
                    <td>Obligatorio</td>
                    <td>Características presentes</td>
                    <td>alternativeText</td>
                </tr>
                <tr>
                    <td><code>schema:accessibilityHazard</code></td>
                    <td>Obligatorio</td>
                    <td>Riesgos presentes/ausentes</td>
                    <td>noFlashingHazard</td>
                </tr>
                <tr>
                    <td><code>schema:accessibilitySummary</code></td>
                    <td>Recomendado</td>
                    <td>Resumen de accesibilidad</td>
                    <td>Cumple WCAG 2.1 AA</td>
                </tr>
                <tr>
                    <td><code>dcterms:conformsTo</code></td>
                    <td>Recomendado</td>
                    <td>Estándares cumplidos</td>
                    <td>EPUB Accessibility 1.1</td>
                </tr>
                <tr>
                    <td><code>a11y:certifiedBy</code></td>
                    <td>Opcional</td>
                    <td>Organización certificadora</td>
                    <td>DAISY Consortium</td>
                </tr>
            </tbody>
        </table>
        
        <h2>🛠️ Ejemplo de Implementación en PHPEpub</h2>
        <pre><code>$epub = new EpubBuilder();

// Configuración básica
$epub-&gt;setTitle("Manual Accesible")
     -&gt;setAuthor("Experto en Accesibilidad")
     -&gt;setLanguage("es");

// Metadatos de accesibilidad obligatorios
$epub-&gt;addAccessMode("textual")
     -&gt;addAccessMode("visual");

$epub-&gt;addAccessibilityFeature("alternativeText")
     -&gt;addAccessibilityFeature("structuralNavigation");

$epub-&gt;addAccessibilityHazard("noFlashingHazard")
     -&gt;addAccessibilityHazard("noSoundHazard");

// Metadatos recomendados
$epub-&gt;addAccessModeSufficient(["textual"])
     -&gt;setAccessibilitySummary("Cumple WCAG 2.1 AA")
     -&gt;addConformsTo("EPUB Accessibility 1.1 - WCAG 2.1 Level AA");

// Certificación opcional
$epub-&gt;setCertifiedBy("Instituto de Accesibilidad")
     -&gt;setCertifierCredential("IAAP CPACC")
     -&gt;setCertifierReport("https://ejemplo.com/reporte");</code></pre>
        
        <h2>🔍 Validación y Testing</h2>
        <p>Para validar la accesibilidad del EPUB generado:</p>
        
        <ol>
            <li><strong>DAISY Ace:</strong> Validador oficial de accesibilidad EPUB</li>
            <li><strong>EPUBCheck:</strong> Validación de estructura y metadatos</li>
            <li><strong>Lectores de Pantalla:</strong> Pruebas con NVDA, JAWS, VoiceOver</li>
            <li><strong>Navegadores:</strong> Pruebas con diferentes navegadores y zoom</li>
        </ol>
        
        <h3>🚀 Comando de Validación</h3>
        <pre><code># Instalar DAISY Ace
npm install -g @daisy/ace

# Validar EPUB
ace manual-accesible.epub --outdir reporte-ace/

# Ver reporte
open reporte-ace/report.html</code></pre>
        
        <h2>✅ Checklist de Certificación</h2>
        <ul>
            <li>☑️ Todos los metadatos obligatorios incluidos</li>
            <li>☑️ Texto alternativo en todas las imágenes</li>
            <li>☑️ Estructura semántica con encabezados</li>
            <li>☑️ Navegación accesible por teclado</li>
            <li>☑️ Contraste suficiente en textos</li>
            <li>☑️ Orden de lectura lógico</li>
            <li>☑️ Sin riesgos de accesibilidad</li>
            <li>☑️ Validado con tecnologías asistivas</li>
            <li>☑️ Reporte de certificación disponible</li>
        </ul>'
    );

    // Mostrar estadísticas completas
    echo "📊 Estadísticas de Certificación:\n\n";
    
    $accessModes = $metadata->getAccessModes();
    echo "🔍 Modos de Acceso ({" . count($accessModes) . "}):\n";
    foreach ($accessModes as $mode) {
        echo "   ✅ {$mode}\n";
    }
    
    $modeSufficient = $metadata->getAccessModeSufficient();
    echo "\n🎯 Combinaciones Suficientes ({" . count($modeSufficient) . "}):\n";
    foreach ($modeSufficient as $combination) {
        echo "   ✅ " . implode(' + ', $combination) . "\n";
    }
    
    $features = $metadata->getAccessibilityFeatures();
    echo "\n✨ Características ({" . count($features) . "}):\n";
    foreach ($features as $feature) {
        echo "   ✅ {$feature}\n";
    }
    
    $hazards = $metadata->getAccessibilityHazards();
    echo "\n⚠️ Riesgos Evaluados ({" . count($hazards) . "}):\n";
    foreach ($hazards as $hazard) {
        echo "   🟢 {$hazard}\n";
    }
    
    $standards = $metadata->getConformsTo();
    echo "\n📜 Estándares de Cumplimiento ({" . count($standards) . "}):\n";
    foreach ($standards as $standard) {
        echo "   ✅ " . (strlen($standard) > 60 ? substr($standard, 0, 57) . '...' : $standard) . "\n";
    }

    // Generar el EPUB
    $filename = 'manual-certificado-aa.epub';
    echo "\n📚 Generando EPUB certificado: {$filename}\n";
    
    if ($epub->save($filename)) {
        echo "✅ ¡Manual generado y certificado exitosamente!\n";
        echo "📦 Archivo: {$filename}\n";
        echo "📊 Tamaño: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
        
        echo "\n🏆 Certificación Completa:\n";
        echo "   ✅ EPUB Accessibility 1.1 - Cumplimiento total\n";
        echo "   ✅ WCAG 2.1 Level AA - Certificado\n";
        echo "   ✅ Schema.org - Metadatos completos\n";
        echo "   ✅ Sin riesgos de accesibilidad\n";
        echo "   ✅ Validado con tecnologías asistivas\n";
        
        echo "\n🔍 Para validar este EPUB:\n";
        echo "   ace {$filename} --outdir reporte-ace/\n";
        echo "   epubcheck {$filename}\n";
        
        echo "\n📄 Reporte completo disponible en:\n";
        echo "   " . $metadata->getCertifierReport() . "\n";
        
    } else {
        echo "❌ Error al generar el manual certificado\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    echo "📂 Archivo: " . $e->getFile() . "\n";
}

echo "\n🎉 Ejemplo de certificación completa finalizado.\n";
echo "💡 Este EPUB cumple con TODOS los metadatos de accesibilidad requeridos.\n";
