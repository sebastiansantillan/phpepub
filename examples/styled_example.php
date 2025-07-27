<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    $epub = new EpubBuilder();

    // Metadatos del libro
    $epub->setTitle('Libro con Estilos Personalizados')
         ->setAuthor('Diseñador Creativo')
         ->setLanguage('es')
         ->setDescription('Un ejemplo que demuestra el uso de estilos CSS personalizados en PHPEpub');

    // Agregar la hoja de estilos personalizada
    if (file_exists(__DIR__ . '/assets/custom-style.css')) {
        $epub->addStylesheet(__DIR__ . '/assets/custom-style.css', 'custom-styles');
    }

    // Capítulo de introducción
    $epub->addChapter(
        'Introducción',
        '<div class="capitulo-inicio">
            <h1>Introducción</h1>
            <p>Este libro demuestra cómo usar estilos CSS personalizados para crear libros electrónicos con un diseño profesional y atractivo.</p>
            
            <div class="destacado">
                <p><strong>Nota importante:</strong> Los estilos CSS aplicados en este libro son completamente personalizables y pueden adaptarse a tus necesidades específicas.</p>
            </div>
        </div>'
    );

    // Capítulo con diferentes elementos
    $epub->addChapter(
        'Elementos de Diseño',
        '<h1>Elementos de Diseño</h1>
        
        <h2>Texto y Párrafos</h2>
        <p>Este es un párrafo normal con sangría francesa automática. El texto se justifica para crear una apariencia profesional.</p>
        <p>Los párrafos siguientes mantienen la sangría, mientras que los párrafos que siguen inmediatamente a un encabezado no tienen sangría.</p>
        
        <h2>Énfasis y Formateo</h2>
        <p>Puedes usar <strong>texto en negrita</strong> para resaltar información importante, y <em>texto en cursiva</em> para dar énfasis sutil.</p>
        
        <h2>Listas</h2>
        <p>Las listas están bien espaciadas y son fáciles de leer:</p>
        <ul>
            <li>Elemento de lista uno</li>
            <li>Elemento de lista dos con más texto para mostrar cómo se comporta el espaciado</li>
            <li>Elemento de lista tres</li>
        </ul>
        
        <h2>Lista Numerada</h2>
        <ol>
            <li>Primer paso del proceso</li>
            <li>Segundo paso con explicación detallada</li>
            <li>Tercer y último paso</li>
        </ol>'
    );

    // Capítulo con citas y código
    $epub->addChapter(
        'Citas y Código',
        '<h1>Citas y Código</h1>
        
        <h2>Citas Destacadas</h2>
        <p>Las citas tienen un diseño especial que las hace destacar:</p>
        
        <blockquote>
            <p>La simplicidad es la máxima sofisticación. Un buen diseño no es solo cómo se ve, sino cómo funciona.</p>
            <p class="autor">— Steve Jobs</p>
        </blockquote>
        
        <p>Las citas pueden incluir múltiples párrafos y atribución al autor.</p>
        
        <h2>Código de Programación</h2>
        <p>El código en línea se muestra así: <code>$variable = "valor";</code></p>
        
        <p>Para bloques de código más largos:</p>
        <pre><code>function crearLibro() {
    $epub = new EpubBuilder();
    $epub->setTitle("Mi Libro")
         ->setAuthor("Mi Nombre")
         ->addChapter("Capítulo 1", $contenido)
         ->save("libro.epub");
    return true;
}</code></pre>'
    );

    // Capítulo con elementos especiales
    $epub->addChapter(
        'Elementos Especiales',
        '<h1>Elementos Especiales</h1>
        
        <h2>Cajas de Información</h2>
        
        <div class="destacado">
            <h3>Información Destacada</h3>
            <p>Esta es una caja destacada que llama la atención sobre información importante.</p>
        </div>
        
        <div class="nota">
            <h3>Nota Informativa</h3>
            <p>Las notas proporcionan información adicional sin interrumpir el flujo principal del texto.</p>
        </div>
        
        <div class="advertencia">
            <h3>Advertencia</h3>
            <p>Las advertencias alertan sobre información crítica que el lector debe tener en cuenta.</p>
        </div>
        
        <h2>Separación de Secciones</h2>
        <p>Los separadores ayudan a dividir el contenido:</p>
        
        <hr>
        
        <p>El contenido después del separador comienza una nueva sección temática.</p>
        
        <h2>Tablas Estilizadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Elemento</th>
                    <th>Descripción</th>
                    <th>Uso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Encabezados</td>
                    <td>Títulos y subtítulos</td>
                    <td>Estructura del contenido</td>
                </tr>
                <tr>
                    <td>Párrafos</td>
                    <td>Texto principal</td>
                    <td>Contenido principal del libro</td>
                </tr>
                <tr>
                    <td>Listas</td>
                    <td>Elementos relacionados</td>
                    <td>Organizar información</td>
                </tr>
            </tbody>
        </table>'
    );

    // Capítulo final
    $epub->addChapter(
        'Conclusión',
        '<h1>Conclusión</h1>
        
        <p>Este ejemplo ha demostrado cómo los estilos CSS personalizados pueden transformar completamente la apariencia de un libro electrónico.</p>
        
        <p>Los elementos clave incluyen:</p>
        <ul>
            <li>Tipografía clara y legible</li>
            <li>Espaciado apropiado entre elementos</li>
            <li>Colores que mejoran la legibilidad</li>
            <li>Elementos visuales que guían al lector</li>
        </ul>
        
        <blockquote>
            <p>El buen diseño es tan simple como sea posible, pero no más simple.</p>
            <p class="autor">— Albert Einstein (adaptado)</p>
        </blockquote>
        
        <div class="nota">
            <p><strong>Consejo:</strong> Experimenta con diferentes estilos para encontrar el que mejor se adapte a tu contenido y audiencia.</p>
        </div>
        
        <p class="autor">Gracias por explorar las posibilidades de diseño con PHPEpub.</p>'
    );

    // Generar el libro
    $filename = 'libro-con-estilos.epub';
    if ($epub->save($filename)) {
        echo "✅ Libro con estilos personalizados generado: {$filename}\n";
        echo "🎨 Este libro demuestra el poder de los estilos CSS personalizados\n";
        echo "📖 Ábrelo en tu lector favorito para ver el resultado\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "💡 Asegúrate de que el archivo CSS exista en examples/assets/\n";
}
