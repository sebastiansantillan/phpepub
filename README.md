# PHPEpub

[![Version](https://img.shields.io/badge/version-0.3.0--beta-brightgreen.svg)](https://github.com/sebastiansantillan/phpepub)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.3-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![EPUB Accessibility](https://img.shields.io/badge/EPUB%20Accessibility-1.1-blue.svg)](https://www.w3.org/TR/epub-a11y-11/)
[![WCAG](https://img.shields.io/badge/WCAG%202.1-Level%20AA-green.svg)](https://www.w3.org/TR/WCAG21/)

A modern PHP library for creating EPUB files easily and efficiently.

> 🎉 **Beta Version**: v0.3.0-beta is production-ready with complete EPUB Accessibility 1.1 support!

## Features

- ✅ Create EPUB 3.0 files
- ✅ Support for multiple chapters
- ✅ Metadata management (title, author, language, etc.)
- ✅ Support for images and CSS
- ✅ **Complete EPUB Accessibility 1.1 support**
- ✅ **WCAG 2.1 Level AA compliance**
- ✅ **Schema.org accessibility metadata**
- ✅ Fluent and easy-to-use interface
- ✅ Compatible with PHP 8.3+

## Installation

### Beta Version

```bash
composer require sebastiansantillan/phpepub:^0.3.0-beta
```

### Alpha Version

```bash
composer require sebastiansantillan/phpepub:^0.2.0-alpha
```

### From repository (development)

```bash
composer require sebastiansantillan/phpepub:dev-main
```

> 📝 **Note**: As this is an alpha version, the API may change in future versions.

## Basic Usage

```php
<?php
require_once 'vendor/autoload.php';

use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

$epub->setTitle('My First Book')
     ->setAuthor('Your Name')
     ->setLanguage('en')
     ->setDescription('A book description');

// Add chapters
$epub->addChapter('Chapter 1', '<h1>Chapter 1</h1><p>First chapter content...</p>');
$epub->addChapter('Chapter 2', '<h1>Chapter 2</h1><p>Second chapter content...</p>');

// Generate the EPUB file
$epub->save('my-book.epub');
```

### Accessibility Support

PHPEpub includes complete accessibility support for EPUB Accessibility 1.1:

```php
$epub = new EpubBuilder();

$epub->setTitle('Accessible Book')
     ->setAuthor('Author Name')
     // Add accessibility metadata
     ->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('Fully accessible book with proper navigation and alt text')
     ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');

$epub->addChapter('Chapter 1', '<h1>Accessible Chapter</h1><p>Content with proper structure...</p>');
$epub->save('accessible-book.epub');
```

## Documentation

For more information, check the [complete documentation](docs/README.md).

### Accessibility Documentation

- [Complete Accessibility Guide](docs/accessibility.md) - Detailed accessibility implementation
- [Accessibility Implementation Summary](ACCESSIBILITY_IMPLEMENTATION_SUMMARY.md) - Technical implementation details

## Release Notes

- [v0.1.0-alpha](docs/releases/v0.1.0-alpha.md) - First alpha release

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for changes in each version.