# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.3.0-beta] - 2025-08-02

### Added
- 🌟 **Complete EPUB Accessibility 1.1 Implementation** with all Schema.org metadata
- ✨ **9 Categories of Accessibility Metadata** including access modes, features, hazards, and certification
- 🎯 **Smart Standards Conversion** - automatic URL conversion for accessibility standards
- 📋 **Enhanced XML Format** - correct EPUB 3.0 metadata format using element values
- 🔧 **Comprehensive Accessibility API** with 20+ new methods in EpubBuilder
- 📚 **Complete Documentation Suite** with 430-line accessibility.md guide
- 🏆 **Production-Ready Beta** - suitable for production accessibility requirements
- 🧪 **95 Tests Passing** with 222 assertions ensuring reliability

### Enhanced
- 🔄 **XML Metadata Generation** - fixed format to use element values instead of content attributes  
- 📖 **Documentation Integration** - accessibility content across README.md, docs/README.md, and specialized guides
- 🌍 **Namespace Support** - proper Schema.org, a11y, and dcterms namespace declarations
- ⚡ **API Stability** - stable interface with no breaking changes planned for 1.0

### Fixed
- 🐛 **XML Format Compliance** - corrected meta elements to use proper EPUB 3.0 format
- 🔧 **Namespace Issues** - added missing accessibility namespaces in package documents
- 📋 **Standards URLs** - automatic conversion from human-readable standards to official URLs
- 🧪 **Test Coverage** - comprehensive accessibility testing with full validation

### New API Methods
```
Schema.org Accessibility:
- addAccessMode(string): self
- addAccessModeSufficient(array): self  
- addAccessibilityFeature(string): self
- addAccessibilityHazard(string): self
- setAccessibilitySummary(string): self

EPUB Accessibility 1.1 Certification:
- setCertifiedBy(string): self
- setCertifierCredential(string): self
- setCertifierReport(string): self

Standards Compliance:
- addConformsTo(string): self (with automatic URL conversion)
```

### Generated XML Format
```xml
<!-- Correct EPUB 3.0 Format (v0.3.0-beta) -->
<meta property="schema:accessMode">textual</meta>
<meta property="schema:accessibilityFeature">structuralNavigation</meta>
<meta property="a11y:certifiedBy">Organization Name</meta>
<meta property="dcterms:conformsTo">http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa</meta>
```

### Breaking Changes
- **None** - Full backward compatibility maintained
- **XML Output** - Improved format (only affects metadata generation)
- **API Additions** - All new methods are optional

## [0.2.0-alpha] - 2025-07-29

### Added
- 📚 **Complete Subjects/Categories System** for EPUB metadata
- ✨ Full subjects API with CRUD operations in Metadata class
- 🔧 Fluent interface methods in EpubBuilder for subjects management
- 🧪 Comprehensive test suite with 13 new tests for subjects functionality
- 📖 New comprehensive example (`subjects_example.php`) demonstrating all functionality
- 🌍 Dublin Core compliance with `dc:subject` elements in EPUB output
- 📋 Enhanced examples with relevant subjects integration

### Enhanced
- 🔄 **Metadata constructor** now accepts subjects array parameter
- 📚 **EpubGenerator** automatically includes subjects in package metadata
- 📖 Updated existing examples with subjects demonstration
- 🧪 Enhanced test coverage (48 tests, 140+ assertions)

### Fixed
- 🐛 **Chapter constructor** property initialization order
- 🔧 **ChapterTest** compatibility with new language attributes
- 📋 **Array reindexing** after subject removal operations

### API Changes
```
New Metadata methods:
- addSubject(string): self
- removeSubject(string): self  
- setSubjects(array): self
- getSubjects(): array
- hasSubject(string): bool
- clearSubjects(): self

New EpubBuilder methods:
- addSubject(string): self
- setSubjects(array): self
```

### Breaking Changes
- **Metadata constructor** signature extended with optional subjects parameter
- **Chapter HTML output** now includes language attributes by default

## [0.1.1-alpha] - 2025-07-29

### Added
- 🌍 **Enhanced WCAG accessibility compliance**
- ✨ Language attributes (`xml:lang`, `lang`) in all HTML documents
- 🔧 Package document with proper language metadata
- 📚 Enhanced navigation documents with language support
- 📖 Chapter documents with proper language markup
- 🇪🇸 Complete Spanish example (`libro_avanzado_es.php`) with 5 chapters
- 🧪 International character testing script (`test_spanish_accents.php`)

### Fixed
- 🐛 **HTML character escaping** for JavaScript arrow functions (`=>`)
- 🔤 **Accent handling** in filename generation for international characters
- 🌐 **UTF-8 support** for Spanish characters (ñ, á, é, í, ó, ú)
- 📋 **BCP 47 compliance** for language codes
- ♿ **WCAG 3.1.1 compliance** for language identification

### Changed
- 🔄 **API Enhancement**: `Chapter::getHtmlContent()` now accepts language parameter
- 🔄 **Generator Methods**: Enhanced to pass language metadata
- 🔄 **Navigation Generation**: Now includes proper language attributes
- 🔄 **Package Generation**: Enhanced with language declarations

### Technical Improvements
- Enhanced `EpubGenerator` with language support in all document types
- Improved `Chapter` class with international character handling
- Better HTML entity escaping for code examples
- Robust accent-to-ASCII conversion for filename generation

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
