# Documentación PHPEpub

## Tabla de Contenidos

1. [Instalación](#instalación)
2. [Uso Básico](#uso-básico)
3. [Configuración de Metadatos](#configuración-de-metadatos)
4. [Gestión de Capítulos](#gestión-de-capítulos)
5. [Imágenes y Recursos](#imágenes-y-recursos)
6. [Estilos CSS](#estilos-css)
7. [Ejemplos Avanzados](#ejemplos-avanzados)
8. [API Reference](#api-reference)

## Instalación

### Requisitos del Sistema

- PHP 8.3 o superior
- Extensión ZIP habilitada
- Extensión DOM habilitada
- Extensión libxml habilitada

### Instalación via Composer

```bash
composer require sebastiansantillan/phpepub
```

### Instalación Manual

1. Descarga la librería
2. Incluye el autoloader:

```php
require_once 'path/to/phpepub/vendor/autoload.php';
```

## Uso Básico

### Crear tu Primer Libro

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

$epub->setTitle('Mi Primer Libro')
     ->setAuthor('Tu Nombre')
     ->setLanguage('es');

$epub->addChapter('Capítulo 1', '<h1>Primer Capítulo</h1><p>Contenido...</p>');

$epub->save('mi-libro.epub');
```

## Configuración de Metadatos

### Metadatos Básicos

```php
$epub->setTitle('Título del Libro')         // Obligatorio
     ->setAuthor('Nombre del Autor')        // Recomendado
     ->setLanguage('es')                    // Por defecto: 'es'
     ->setDescription('Descripción...')     // Opcional
     ->setIsbn('978-0000000000')           // Opcional
     ->setPublisher('Editorial');          // Opcional
```

### Metadatos Avanzados

```php
// Establecer fecha de publicación personalizada
$epub->getMetadata()->setPublicationDate('2025-01-01T00:00:00Z');

// Establecer identificador personalizado
$epub->getMetadata()->setIdentifier('mi-libro-unico-2025');
```

## Gestión de Capítulos

### Agregar Capítulos

```php
// Capítulo básico
$epub->addChapter('Título del Capítulo', '<h1>Contenido HTML</h1>');

// Capítulo con nombre de archivo personalizado
$epub->addChapter('Mi Capítulo', '<h1>Contenido</h1>', 'capitulo_especial.xhtml');
```

### Contenido HTML Soportado

PHPEpub soporta HTML estándar para el contenido de los capítulos:

```php
$contenido = '
<h1>Título Principal</h1>
<h2>Subtítulo</h2>
<p>Párrafo con <strong>texto en negrita</strong> y <em>cursiva</em>.</p>

<ul>
    <li>Lista no ordenada</li>
    <li>Otro elemento</li>
</ul>

<ol>
    <li>Lista ordenada</li>
    <li>Segundo elemento</li>
</ol>

<blockquote>
    <p>Cita importante</p>
</blockquote>

<pre><code>
function ejemplo() {
    return "código";
}
</code></pre>

<table border="1">
    <tr>
        <th>Encabezado</th>
        <th>Otro</th>
    </tr>
    <tr>
        <td>Celda</td>
        <td>Otra celda</td>
    </tr>
</table>
';

$epub->addChapter('Capítulo Completo', $contenido);
```

## Imágenes y Recursos

### Agregar Imágenes

```php
// Agregar imagen con ID automático
$epub->addImage('/ruta/a/imagen.jpg');

// Agregar imagen con ID personalizado
$epub->addImage('/ruta/a/diagrama.png', 'diagrama');

// Establecer imagen de portada
$epub->setCover('/ruta/a/portada.jpg');
```

### Usar Imágenes en Capítulos

```php
// Primero agregar la imagen
$epub->addImage('/ruta/a/imagen.jpg', 'mi-imagen');

// Luego referenciarla en el capítulo
$contenido = '<h1>Capítulo con Imagen</h1>
<p>Aquí hay una imagen:</p>
<img src="../Images/imagen.jpg" alt="Descripción" />
<p>Texto después de la imagen.</p>';

$epub->addChapter('Capítulo Visual', $contenido);
```

### Formatos de Imagen Soportados

- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)
- SVG (.svg)
- WebP (.webp)

## Estilos CSS

### CSS Por Defecto

PHPEpub incluye una hoja de estilos por defecto que proporciona un formato limpio y legible.

### Agregar CSS Personalizado

```php
// Agregar hoja de estilos personalizada
$epub->addStylesheet('/ruta/a/estilos.css', 'mis-estilos');
```

### Ejemplo de CSS Personalizado

```css
/* estilos-personalizados.css */
body {
    font-family: "Times New Roman", serif;
    font-size: 14px;
    line-height: 1.8;
    margin: 2em;
}

h1 {
    color: #2c3e50;
    font-size: 2.5em;
    text-align: center;
    margin-bottom: 1.5em;
}

.destacado {
    background-color: #f8f9fa;
    border-left: 4px solid #007bff;
    padding: 1em;
    margin: 1em 0;
}

.autor {
    text-align: right;
    font-style: italic;
    color: #6c757d;
}
```

### Usar Clases CSS en Capítulos

```php
$contenido = '
<h1>Capítulo Estilizado</h1>
<div class="destacado">
    <p>Este es un párrafo destacado con estilo personalizado.</p>
</div>
<p class="autor">- Nombre del Autor</p>
';

$epub->addChapter('Capítulo con Estilos', $contenido);
```

## Ejemplos Avanzados

### Libro Completo con Todos los Elementos

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

// Configuración completa
$epub->setTitle('Guía Completa de PHP')
     ->setAuthor('Desarrollador Experto')
     ->setLanguage('es')
     ->setDescription('Una guía completa para aprender PHP desde cero')
     ->setIsbn('978-1234567890')
     ->getMetadata()->setPublisher('Editorial Tech');

// Portada
$epub->setCover('/ruta/a/portada.jpg');

// CSS personalizado
$epub->addStylesheet('/ruta/a/estilos.css');

// Imágenes
$epub->addImage('/ruta/a/logo.png', 'logo');
$epub->addImage('/ruta/a/diagrama.svg', 'diagrama');

// Capítulos
$epub->addChapter('Prólogo', file_get_contents('capitulos/prologo.html'));
$epub->addChapter('Introducción a PHP', file_get_contents('capitulos/intro.html'));
$epub->addChapter('Variables y Tipos', file_get_contents('capitulos/variables.html'));
$epub->addChapter('Funciones', file_get_contents('capitulos/funciones.html'));
$epub->addChapter('Programación Orientada a Objetos', file_get_contents('capitulos/oop.html'));
$epub->addChapter('Conclusiones', file_get_contents('capitulos/conclusion.html'));

// Generar
if ($epub->save('guia-php-completa.epub')) {
    echo "Libro generado exitosamente!\n";
}
```

### Generación Automática desde Markdown

```php
<?php
use PHPEpub\EpubBuilder;

function markdownToHtml($markdown) {
    // Implementar conversión básica de Markdown a HTML
    // O usar una librería como Parsedown
    return $markdown; // Simplificado para el ejemplo
}

$epub = new EpubBuilder();
$epub->setTitle('Libro desde Markdown')
     ->setAuthor('Autor Automático');

// Leer archivos Markdown y convertir a capítulos
$markdownFiles = glob('markdown/*.md');
foreach ($markdownFiles as $file) {
    $title = basename($file, '.md');
    $markdown = file_get_contents($file);
    $html = markdownToHtml($markdown);
    
    $epub->addChapter(ucfirst($title), $html);
}

$epub->save('libro-desde-markdown.epub');
```

## API Reference

### Clase EpubBuilder

#### Métodos de Configuración

| Método | Parámetros | Retorno | Descripción |
|--------|------------|---------|-------------|
| `setTitle(string $title)` | `$title`: Título del libro | `self` | Establece el título (obligatorio) |
| `setAuthor(string $author)` | `$author`: Nombre del autor | `self` | Establece el autor |
| `setLanguage(string $language)` | `$language`: Código de idioma | `self` | Establece el idioma (ej: 'es', 'en') |
| `setDescription(string $description)` | `$description`: Descripción | `self` | Establece la descripción |
| `setIsbn(string $isbn)` | `$isbn`: Número ISBN | `self` | Establece el ISBN |
| `setCover(string $imagePath)` | `$imagePath`: Ruta a la imagen | `self` | Establece la imagen de portada |

#### Métodos de Contenido

| Método | Parámetros | Retorno | Descripción |
|--------|------------|---------|-------------|
| `addChapter(string $title, string $content, ?string $filename)` | `$title`: Título<br>`$content`: HTML<br>`$filename`: Nombre archivo | `self` | Agrega un capítulo |
| `addImage(string $imagePath, ?string $id)` | `$imagePath`: Ruta imagen<br>`$id`: ID opcional | `self` | Agrega una imagen |
| `addStylesheet(string $cssPath, ?string $id)` | `$cssPath`: Ruta CSS<br>`$id`: ID opcional | `self` | Agrega CSS |

#### Métodos de Generación

| Método | Parámetros | Retorno | Descripción |
|--------|------------|---------|-------------|
| `save(string $filename)` | `$filename`: Nombre del archivo EPUB | `bool` | Genera y guarda el EPUB |
| `getMetadata()` | - | `Metadata` | Obtiene los metadatos |
| `getChapters()` | - | `array` | Obtiene los capítulos |

### Excepciones

La librería lanza `PHPEpub\Exception\EpubException` en los siguientes casos:

- Archivo de imagen no encontrado
- Archivo CSS no encontrado
- No se pueden generar libros sin capítulos
- Título no especificado
- Error al crear el archivo ZIP
- Errores durante la generación

### Ejemplo de Manejo de Errores

```php
try {
    $epub = new EpubBuilder();
    $epub->setTitle('Mi Libro')->save('libro.epub');
} catch (PHPEpub\Exception\EpubException $e) {
    echo "Error generando EPUB: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error general: " . $e->getMessage();
}
```
