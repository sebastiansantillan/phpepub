<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;
use PHPEpub\Enum\ImageMimeType;
use PHPEpub\ValueObject\ImageInfo;

echo "🚀 Ejemplo con características de PHP 8.3+\n\n";

try {
    $epub = new EpubBuilder();

    // Configuración usando sintaxis mejorada
    $epub->setTitle('Libro PHP 8.3 Moderno')
         ->setAuthor('Sebastián Santillán')
         ->setLanguage('es')
         ->setDescription('Demostración de características modernas de PHP 8.3 en PHPEpub');

    // Demostrar el uso de enums
    echo "📋 Formatos de imagen soportados:\n";
    foreach (ImageMimeType::cases() as $mimeType) {
        echo "   - {$mimeType->name}: {$mimeType->value}\n";
    }
    echo "\n";

    // Demostrar validación de extensiones
    $testExtensions = ['jpg', 'png', 'gif', 'txt', 'pdf'];
    echo "🔍 Validación de extensiones:\n";
    foreach ($testExtensions as $ext) {
        $valid = ImageMimeType::isValidExtension($ext) ? '✅' : '❌';
        echo "   {$valid} .{$ext}\n";
    }
    echo "\n";

    // Ejemplo con Value Objects (si tuviéramos una imagen)
    echo "📸 Información de imágenes (ejemplo):\n";
    // Simular información de imagen
    echo "   - Tipos MIME disponibles: " . count(ImageMimeType::cases()) . "\n";
    echo "   - Extensiones válidas: " . implode(', ', ImageMimeType::getValidExtensions()) . "\n";
    echo "\n";

    // Agregar capítulos con contenido sobre PHP 8.3
    $epub->addChapter(
        'Características de PHP 8.3',
        '<h1>Características de PHP 8.3</h1>
        
        <h2>Enums</h2>
        <p>Los enums proporcionan una forma elegante de definir un conjunto fijo de valores:</p>
        <pre><code>enum ImageMimeType: string
{
    case JPEG = "image/jpeg";
    case PNG = "image/png";
    // ...
}</code></pre>
        
        <h2>Promoted Properties</h2>
        <p>Permiten declarar y asignar propiedades directamente en el constructor:</p>
        <pre><code>public function __construct(
    private readonly string $title,
    private readonly string $author
) {}</code></pre>
        
        <h2>Match Expression</h2>
        <p>Una alternativa más potente a switch:</p>
        <pre><code>return match ($extension) {
    "jpg", "jpeg" => ImageMimeType::JPEG,
    "png" => ImageMimeType::PNG,
    default => ImageMimeType::JPEG
};</code></pre>'
    );

    $epub->addChapter(
        'Readonly Properties',
        '<h1>Readonly Properties</h1>
        
        <p>Las propiedades readonly garantizan inmutabilidad después de la inicialización:</p>
        
        <div class="destacado">
            <h3>Ventajas</h3>
            <ul>
                <li>Inmutabilidad garantizada</li>
                <li>Mejor rendimiento</li>
                <li>Código más seguro</li>
                <li>Menos bugs relacionados con estado</li>
            </ul>
        </div>
        
        <h2>Value Objects</h2>
        <p>Los Value Objects son perfectos para usar con readonly:</p>
        <pre><code>readonly class ImageInfo
{
    public function __construct(
        public string $path,
        public string $id,
        public ImageMimeType $mimeType
    ) {}
}</code></pre>'
    );

    $epub->addChapter(
        'Named Arguments',
        '<h1>Named Arguments</h1>
        
        <p>Los argumentos nombrados hacen el código más legible y flexible:</p>
        
        <h2>Antes (PHP 7.x)</h2>
        <pre><code>$image = new ImageInfo($path, $id, $mimeType, $size);</code></pre>
        
        <h2>Ahora (PHP 8.3+)</h2>
        <pre><code>$image = new ImageInfo(
    path: $imagePath,
    id: $imageId,
    mimeType: ImageMimeType::JPEG,
    size: 1024
);</code></pre>
        
        <div class="nota">
            <p><strong>Beneficios:</strong> Mayor claridad, flexibilidad en el orden de parámetros, y menos propenso a errores.</p>
        </div>'
    );

    $epub->addChapter(
        'Union Types y Null Safety',
        '<h1>Union Types y Null Safety</h1>
        
        <h2>Union Types</h2>
        <p>Permiten que un parámetro acepte múltiples tipos:</p>
        <pre><code>function process(string|int|null $value): string|null
{
    return match (true) {
        is_string($value) => strtoupper($value),
        is_int($value) => (string) $value,
        default => null
    };
}</code></pre>
        
        <h2>Strict Types</h2>
        <p>PHPEpub usa <code>declare(strict_types=1)</code> en todos los archivos para mayor seguridad de tipos:</p>
        
        <div class="advertencia">
            <p><strong>Importante:</strong> Los tipos estrictos ayudan a detectar errores en tiempo de desarrollo.</p>
        </div>'
    );

    // Generar el libro
    $filename = 'php83-moderno.epub';
    if ($epub->save($filename)) {
        echo "✅ Libro generado exitosamente: {$filename}\n";
        echo "📖 Este libro demuestra las características modernas de PHP 8.3\n";
        echo "🎯 PHPEpub aprovecha al máximo las nuevas características del lenguaje\n\n";
        
        // Mostrar estadísticas
        $chapters = $epub->getChapters();
        echo "📊 Estadísticas del libro:\n";
        echo "   - Capítulos: " . count($chapters) . "\n";
        echo "   - Tamaño del archivo: " . number_format(filesize($filename)) . " bytes\n";
        echo "   - Generado con PHP " . PHP_VERSION . "\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "💡 Asegúrate de tener PHP 8.3+ instalado\n";
}

echo "\n🎉 Ejemplo completado!\n";
