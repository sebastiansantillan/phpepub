# Release Notes - PHPEpub v0.1.0-alpha

## 🎉 Primera versión Alpha de PHPEpub

Esta es la primera versión pública de PHPEpub, una librería moderna para crear archivos EPUB con PHP 8.3+.

### ⚠️ Advertencia de Versión Alpha

Esta es una **versión experimental** con las siguientes consideraciones:

- ❌ **NO usar en producción**
- 🔄 **API puede cambiar** sin previo aviso
- 🐛 **Posibles bugs** no detectados
- 📚 **Documentación en desarrollo**
- 🧪 **Para testing y feedback únicamente**

### ✨ Características Principales

#### 🏗️ Arquitectura Moderna
- **PHP 8.3+** con características más recientes
- **Constructor Property Promotion**
- **Readonly Properties** para inmutabilidad
- **Enums** para type safety
- **Match Expressions** en lugar de switch
- **Named Arguments** para mejor legibilidad

#### 📚 Funcionalidades EPUB
- ✅ **EPUB 3.0** completamente compatible
- ✅ **Metadatos completos** (título, autor, ISBN, etc.)
- ✅ **Múltiples capítulos** con HTML personalizable
- ✅ **Imágenes** (JPG, PNG, GIF, SVG, WebP)
- ✅ **CSS personalizable** con estilos por defecto
- ✅ **Interfaz fluida** para fácil uso
- ✅ **Validación robusta** de archivos y formatos

#### 🔧 Herramientas de Desarrollo
- ✅ **PHPUnit** para testing
- ✅ **PHPStan** análisis estático (nivel 5)
- ✅ **PSR-4** autoloading
- ✅ **PSR-12** estilo de código
- ✅ **Composer** configurado

### 📦 Instalación

```bash
composer require sebastiansantillan/phpepub:^0.1.0-alpha
```

### 🚀 Uso Básico

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();
$epub->setTitle('Mi Libro')
     ->setAuthor('Sebastián Santillán')
     ->addChapter('Capítulo 1', '<h1>Contenido...</h1>')
     ->save('mi-libro.epub');
```

### 📁 Estructura del Proyecto

```
phpepub/
├── src/
│   ├── EpubBuilder.php          # Clase principal
│   ├── Enum/
│   │   └── ImageMimeType.php    # Enum para tipos MIME
│   ├── Exception/
│   │   └── EpubException.php    # Excepciones
│   ├── Generator/
│   │   └── EpubGenerator.php    # Generador EPUB
│   └── Structure/
│       ├── Chapter.php          # Gestión de capítulos
│       └── Metadata.php         # Metadatos del libro
├── tests/                       # Suite de tests
├── examples/                    # Ejemplos de uso
├── docs/                        # Documentación
└── composer.json
```

### 🧪 Ejemplos Incluidos

1. **`basic_example.php`** - Uso básico
2. **`advanced_example.php`** - Características avanzadas
3. **`styled_example.php`** - Estilos CSS personalizados
4. **`php83_example.php`** - Características de PHP 8.3

### 📊 Estadísticas

- **Archivos PHP**: 8 clases principales
- **Tests**: 3 suites de testing
- **Cobertura**: Métodos principales cubiertos
- **Documentación**: README + docs/ + ejemplos
- **Dependencias**: Mínimas (solo extensiones PHP nativas)

### 🐛 Problemas Conocidos

- La API puede cambiar en futuras versiones alpha/beta
- Algunos casos edge no están completamente testeados
- Documentación en desarrollo continuo
- Falta validación avanzada de HTML

### 🔮 Próximos Pasos (v0.2.0-alpha)

- [ ] Mejorar validación de HTML
- [ ] Soporte para fonts personalizadas
- [ ] Optimizaciones de performance
- [ ] Más ejemplos y documentación
- [ ] Tests de integración

### 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Por favor:

1. Lee `CONTRIBUTING.md`
2. Crea un fork del proyecto
3. Envía un Pull Request

### 📞 Soporte

- **Issues**: [GitHub Issues](https://github.com/sebastiansantillan/phpepub/issues)
- **Documentación**: [docs/README.md](docs/README.md)
- **Ejemplos**: [examples/](examples/)

### 📄 Licencia

MIT License - ver [LICENSE](LICENSE) para detalles.

---

**¡Gracias por probar PHPEpub v0.1.0-alpha!** 🎉

Tu feedback es invaluable para mejorar esta librería. No dudes en reportar bugs, sugerir mejoras o contribuir al código.

*Sebastián Santillán*  
*sebastian.santillan@gmail.com*
