<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    echo "📚 Ejemplo de Subjects/Materias en PHPEpub\n";
    echo "========================================\n\n";

    // Crear un libro con múltiples subjects
    $epub = new EpubBuilder();
    
    $epub->setTitle('Manual de PHP Avanzado')
         ->setAuthor('Carlos Mendoza')
         ->setLanguage('es')
         ->setDescription('Manual completo de PHP para desarrolladores intermedios y avanzados')
         ->setIsbn('978-84-5678-901-2')
         // Agregar subjects uno por uno
         ->addSubject('PHP')
         ->addSubject('Programación')
         ->addSubject('Desarrollo Web')
         ->addSubject('Backend')
         ->addSubject('OOP')
         ->addSubject('Bases de Datos')
         ->addSubject('Framework')
         ->addSubject('Laravel')
         ->addSubject('Symfony');

    // También se pueden agregar subjects como array
    $moreSubjects = ['API', 'REST', 'GraphQL', 'Microservicios', 'Docker'];
    $epub->setSubjects(array_merge($epub->getMetadata()->getSubjects(), $moreSubjects));

    echo "📖 Creando libro con subjects:\n";
    $subjects = $epub->getMetadata()->getSubjects();
    foreach ($subjects as $index => $subject) {
        echo "   " . ($index + 1) . ". {$subject}\n";
    }
    echo "\n";

    // Agregar capítulos
    $epub->addChapter(
        'Introducción a PHP Moderno',
        '<h1>Introducción a PHP Moderno</h1>
        <p>Este manual cubre las características más avanzadas de PHP 8.3+.</p>
        
        <h2>Subjects/Materias de este libro</h2>
        <p>Este libro está categorizado bajo las siguientes materias:</p>
        <ul>
            <li><strong>PHP</strong> - Lenguaje de programación principal</li>
            <li><strong>Programación</strong> - Conceptos generales de desarrollo</li>
            <li><strong>Desarrollo Web</strong> - Aplicaciones web modernas</li>
            <li><strong>Backend</strong> - Desarrollo del lado del servidor</li>
            <li><strong>OOP</strong> - Programación orientada a objetos</li>
            <li><strong>Bases de Datos</strong> - Manejo de datos persistentes</li>
            <li><strong>Framework</strong> - Uso de marcos de trabajo</li>
            <li><strong>Laravel</strong> - Framework PHP popular</li>
            <li><strong>Symfony</strong> - Components y framework</li>
            <li><strong>API</strong> - Desarrollo de interfaces de programación</li>
            <li><strong>REST</strong> - Arquitectura de servicios web</li>
            <li><strong>GraphQL</strong> - Lenguaje de consulta para APIs</li>
            <li><strong>Microservicios</strong> - Arquitectura distribuida</li>
            <li><strong>Docker</strong> - Containerización de aplicaciones</li>
        </ul>
        
        <p>Los subjects ayudan a:</p>
        <ul>
            <li>📂 <strong>Categorizar</strong> el contenido del libro</li>
            <li>🔍 <strong>Facilitar búsquedas</strong> en bibliotecas digitales</li>
            <li>📚 <strong>Organizar colecciones</strong> por temas</li>
            <li>🎯 <strong>Mejorar SEO</strong> en tiendas digitales</li>
            <li>📊 <strong>Análisis estadístico</strong> de contenido</li>
        </ul>'
    );

    $epub->addChapter(
        'Características Avanzadas de PHP',
        '<h1>Características Avanzadas de PHP</h1>
        
        <h2>Enums en PHP 8.1+</h2>
        <pre><code>enum Status: string {
    case PENDING = "pending";
    case APPROVED = "approved"; 
    case REJECTED = "rejected";
}</code></pre>

        <h2>Match Expression</h2>
        <pre><code>$result = match($status) {
    Status::PENDING =&gt; "En proceso",
    Status::APPROVED =&gt; "Aprobado",
    Status::REJECTED =&gt; "Rechazado"
};</code></pre>

        <h2>Readonly Properties</h2>
        <pre><code>class User {
    public readonly string $id;
    public readonly string $email;
    
    public function __construct(string $id, string $email) {
        $this->id = $id;
        $this->email = $email;
    }
}</code></pre>'
    );

    // Mostrar información sobre subjects antes de generar
    echo "📋 Verificando metadata:\n";
    $metadata = $epub->getMetadata();
    echo "   📖 Título: {$metadata->getTitle()}\n";
    echo "   👤 Autor: {$metadata->getAuthor()}\n";
    echo "   🌍 Idioma: {$metadata->getLanguage()}\n";
    echo "   📚 Subjects: " . count($metadata->getSubjects()) . " categorías\n";
    
    // Verificar si tiene subjects específicos
    $checkSubjects = ['PHP', 'Laravel', 'Docker', 'Python'];
    echo "\n🔍 Verificando subjects específicos:\n";
    foreach ($checkSubjects as $subject) {
        $hasSubject = $metadata->hasSubject($subject);
        $status = $hasSubject ? '✅' : '❌';
        echo "   {$status} {$subject}\n";
    }

    // Generar el EPUB
    $filename = 'manual-php-avanzado-subjects.epub';
    echo "\n📚 Generando EPUB: {$filename}\n";
    
    if ($epub->save($filename)) {
        echo "✅ ¡Libro generado exitosamente!\n";
        echo "📦 Archivo: {$filename}\n";
        echo "📊 Tamaño: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
        
        echo "\n🎯 Los subjects se incluyen automáticamente en:\n";
        echo "   📄 Metadata del package OPF\n";
        echo "   🔍 Información de búsqueda\n";
        echo "   📚 Catálogos de bibliotecas digitales\n";
        echo "   🏪 Tiendas de ebooks\n";
        
    } else {
        echo "❌ Error al generar el libro\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 Línea: " . $e->getLine() . "\n";
    echo "📂 Archivo: " . $e->getFile() . "\n";
}

echo "\n🎉 Ejemplo de subjects completado.\n";
