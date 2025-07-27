# PHPEpub

Una librería PHP moderna para crear archivos EPUB de forma sencilla y eficiente.

## Características

- ✅ Creación de archivos EPUB 3.0
- ✅ Soporte para múltiples capítulos
- ✅ Gestión de metadatos (título, autor, idioma, etc.)
- ✅ Soporte para imágenes y CSS
- ✅ Interfaz fluida y fácil de usar
- ✅ Compatible con PHP 8.3+

## Instalación

```bash
composer require sebastiansantillan/phpepub
```

## Uso básico

```php
<?php
require_once 'vendor/autoload.php';

use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

$epub->setTitle('Mi Primer Libro')
     ->setAuthor('Tu Nombre')
     ->setLanguage('es')
     ->setDescription('Una descripción del libro');

// Agregar capítulos
$epub->addChapter('Capítulo 1', '<h1>Capítulo 1</h1><p>Contenido del primer capítulo...</p>');
$epub->addChapter('Capítulo 2', '<h1>Capítulo 2</h1><p>Contenido del segundo capítulo...</p>');

// Generar el archivo EPUB
$epub->save('mi-libro.epub');
```

## Documentación

Para más información, consulta la [documentación completa](docs/README.md).

## Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-caracteristica`)
3. Commit tus cambios (`git commit -am 'Agrega nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Crea un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## Changelog

Ver [CHANGELOG.md](CHANGELOG.md) para los cambios en cada versión.
