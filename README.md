# PHPEpub

[![Version](https://img.shields.io/badge/version-0.1.0--alpha-orange.svg)](https://github.com/sebastiansantillan/phpepub)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.3-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Una librería PHP moderna para crear archivos EPUB de forma sencilla y eficiente.

> ⚠️ **Versión Alpha**: Esta es una versión experimental. No recomendada para uso en producción.

## Características

- ✅ Creación de archivos EPUB 3.0
- ✅ Soporte para múltiples capítulos
- ✅ Gestión de metadatos (título, autor, idioma, etc.)
- ✅ Soporte para imágenes y CSS
- ✅ Interfaz fluida y fácil de usar
- ✅ Compatible con PHP 8.3+

## Instalación

### Versión Alpha

```bash
composer require sebastiansantillan/phpepub:^0.1.0-alpha
```

### Desde el repositorio (desarrollo)

```bash
composer require sebastiansantillan/phpepub:dev-main
```

> 📝 **Nota**: Al ser una versión alpha, es posible que la API cambie en futuras versiones.

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

## Roadmap

### v0.2.0-alpha (Próxima versión)
- [ ] Soporte para tablas de contenido avanzadas
- [ ] Mejoras en la validación de HTML
- [ ] Optimizaciones de performance
- [ ] Más formatos de imagen

### v0.3.0-beta
- [ ] API estable
- [ ] Soporte para fonts personalizadas
- [ ] Plugins y extensiones
- [ ] Documentación interactiva

### v1.0.0 (Estable)
- [ ] API final consolidada
- [ ] Full testing en producción
- [ ] Performance optimizada
- [ ] Documentación completa

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
