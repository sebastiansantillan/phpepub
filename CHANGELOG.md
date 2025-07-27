# Changelog

Todos los cambios notables en este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es/1.0.0/),
y este proyecto se adhiere a [Versionado Semántico](https://semver.org/lang/es/).

## [No liberado]

### En desarrollo
- Mejoras en la documentación
- Optimizaciones de rendimiento
- Nuevos ejemplos de uso

## [0.1.0-alpha] - 2025-07-26

### Agregado
- 🎉 **Versión inicial de PHPEpub**
- ✨ Estructura inicial del proyecto con arquitectura moderna
- 📚 Clase `EpubBuilder` principal con interfaz fluida
- 🏗️ Generador de archivos EPUB 3.0 completo
- 📋 Soporte completo para metadatos (título, autor, idioma, ISBN, etc.)
- 📖 Sistema de capítulos con HTML personalizable
- 🖼️ Soporte para imágenes (JPG, PNG, GIF, SVG, WebP)
- 🎨 Sistema de hojas de estilo CSS personalizables
- 🔧 Arquitectura basada en PHP 8.3+ con características modernas:
  - Constructor Property Promotion
  - Readonly Properties
  - Enums para type safety
  - Match expressions
  - Named arguments
- 🛡️ Validación robusta de archivos y formatos
- 🧪 Suite completa de tests unitarios
- 📚 Documentación completa con ejemplos
- 🚀 Ejemplos progresivos (básico, avanzado, estilos, PHP 8.3)
- 📦 Configuración completa de Composer
- 🔍 Análisis estático con PHPStan
- 📄 Guías de contribución y seguridad

### Técnico
- **Requisitos**: PHP 8.3+, ext-zip, ext-dom, ext-libxml
- **Namespace**: `PHPEpub\`
- **PSR-4**: Autoloading estándar
- **Testing**: PHPUnit 9.0+
- **Análisis**: PHPStan nivel 5
- **Estándares**: PSR-12 para estilo de código

### Limitaciones Conocidas (Alpha)
- Versión experimental, API puede cambiar
- No recomendado para producción
- Funcionalidades avanzadas en desarrollo
