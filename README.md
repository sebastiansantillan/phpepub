````markdown
# PHPEpub

[![Version](https://img.shields.io/badge/version-0.1.0--alpha-orange.svg)](https://github.com/sebastiansantillan/phpepub)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.3-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

A modern PHP library for creating EPUB files easily and efficiently.

> ⚠️ **Alpha Version**: This is an experimental version. Not recommended for production use.

## Features

- ✅ Create EPUB 3.0 files
- ✅ Support for multiple chapters
- ✅ Metadata management (title, author, language, etc.)
- ✅ Support for images and CSS
- ✅ Fluent and easy-to-use interface
- ✅ Compatible with PHP 8.3+

## Installation

### Alpha Version

```bash
composer require sebastiansantillan/phpepub:^0.1.0-alpha
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

## Documentation

For more information, check the [complete documentation](docs/README.md).

## Release Notes

- [v0.1.0-alpha](docs/releases/v0.1.0-alpha.md) - First alpha release

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for changes in each version.

````
