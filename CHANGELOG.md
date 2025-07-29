# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### In Development
- Documentation improvements
- Performance optimizations
- New usage examples

## [0.1.0-alpha] - 2025-07-26

### Added
- 🎉 **Initial PHPEpub release**
- ✨ Initial project structure with modern architecture
- 📚 Main `EpubBuilder` class with fluent interface
- 🏗️ Complete EPUB 3.0 file generator
- 📋 Complete metadata support (title, author, language, ISBN, etc.)
- 📖 Chapter system with customizable HTML
- 🖼️ Image support (JPG, PNG, GIF, SVG, WebP)
- 🎨 Custom CSS stylesheet system
- 🔧 Architecture based on PHP 8.3+ with modern features:
  - Constructor Property Promotion
  - Readonly Properties
  - Enums for type safety
  - Match expressions
  - Named arguments
- 🛡️ Robust file and format validation
- 🧪 Complete unit test suite
- 📚 Complete documentation with examples
- 🚀 Progressive examples (basic, advanced, styles, PHP 8.3)
- 📦 Complete Composer configuration
- 🔍 Static analysis with PHPStan
- 📄 Contribution and security guides

### Technical
- **Requirements**: PHP 8.3+, ext-zip, ext-dom, ext-libxml
- **Namespace**: `PHPEpub\`
- **PSR-4**: Standard autoloading
- **Testing**: PHPUnit 9.0+
- **Analysis**: PHPStan level 5
- **Standards**: PSR-12 for code style

### Known Limitations (Alpha)
- Experimental version, API may change
- Not recommended for production
- Advanced features in development
