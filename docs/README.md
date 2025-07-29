# PHPEpub Documentation

## Table of Contents

1. [Installation](#installation)
2. [Basic Usage](#basic-usage)
3. [Metadata Configuration](#metadata-configuration)
4. [Chapter Management](#chapter-management)
5. [Images and Resources](#images-and-resources)
6. [CSS Styles](#css-styles)
7. [Advanced Examples](#advanced-examples)
8. [API Reference](#api-reference)

## Installation

### System Requirements

- PHP 8.3 or higher
- ZIP extension enabled
- DOM extension enabled
- libxml extension enabled

### Installation via Composer

```bash
composer require sebastiansantillan/phpepub
```

### Manual Installation

1. Download the library
2. Include the autoloader:

```php
require_once 'path/to/phpepub/vendor/autoload.php';
```

## Basic Usage

### Create Your First Book

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

$epub->setTitle('My First Book')
     ->setAuthor('Your Name')
     ->setLanguage('en');

$epub->addChapter('Chapter 1', '<h1>First Chapter</h1><p>Content...</p>');

$epub->save('my-book.epub');
```

## Metadata Configuration

### Basic Metadata

```php
$epub->setTitle('Book Title')              // Required
     ->setAuthor('Author Name')            // Recommended
     ->setLanguage('en')                   // Default: 'en'
     ->setDescription('Description...')    // Optional
     ->setIsbn('978-0000000000')          // Optional
     ->setPublisher('Publisher');         // Optional
```

### Advanced Metadata

```php
// Set custom publication date
$epub->getMetadata()->setPublicationDate('2025-01-01T00:00:00Z');

// Set custom identifier
$epub->getMetadata()->setIdentifier('my-unique-book-2025');
```

## Chapter Management

### Adding Chapters

```php
// Basic chapter
$epub->addChapter('Chapter Title', '<h1>HTML Content</h1>');

// Chapter with custom filename
$epub->addChapter('My Chapter', '<h1>Content</h1>', 'special_chapter.xhtml');
```

### Supported HTML Content

PHPEpub supports standard HTML for chapter content:

```php
$content = '
<h1>Main Title</h1>
<h2>Subtitle</h2>
<p>Paragraph with <strong>bold text</strong> and <em>italic</em>.</p>

<ul>
    <li>Unordered list</li>
    <li>Another item</li>
</ul>

<ol>
    <li>Ordered list</li>
    <li>Second item</li>
</ol>

<blockquote>
    <p>Important quote</p>
</blockquote>

<pre><code>
function example() {
    return "code";
}
</code></pre>

<table border="1">
    <tr>
        <th>Header</th>
        <th>Another</th>
    </tr>
    <tr>
        <td>Cell</td>
        <td>Another cell</td>
    </tr>
</table>
';

$epub->addChapter('Complete Chapter', $content);
```

## Images and Resources

### Adding Images

```php
// Add image with automatic ID
$epub->addImage('/path/to/image.jpg');

// Add image with custom ID
$epub->addImage('/path/to/diagram.png', 'diagram');

// Set cover image
$epub->setCover('/path/to/cover.jpg');
```

### Using Images in Chapters

```php
// First add the image
$epub->addImage('/path/to/image.jpg', 'my-image');

// Then reference it in the chapter
$content = '<h1>Chapter with Image</h1>
<p>Here is an image:</p>
<img src="../Images/image.jpg" alt="Description" />
<p>Text after the image.</p>';

$epub->addChapter('Visual Chapter', $content);
```

### Supported Image Formats

- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)
- SVG (.svg)
- WebP (.webp)

## CSS Styles

### Default CSS

PHPEpub includes a default stylesheet that provides clean and readable formatting.

### Adding Custom CSS

```php
// Add custom stylesheet
$epub->addStylesheet('/path/to/styles.css', 'my-styles');
```

### Custom CSS Example

```css
/* custom-styles.css */
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

.highlight {
    background-color: #f8f9fa;
    border-left: 4px solid #007bff;
    padding: 1em;
    margin: 1em 0;
}

.author {
    text-align: right;
    font-style: italic;
    color: #6c757d;
}
```

### Using CSS Classes in Chapters

```php
$content = '
<h1>Styled Chapter</h1>
<div class="highlight">
    <p>This is a highlighted paragraph with custom styling.</p>
</div>
<p class="author">- Author Name</p>
';

$epub->addChapter('Chapter with Styles', $content);
```

## Advanced Examples

### Complete Book with All Elements

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

// Complete configuration
$epub->setTitle('Complete PHP Guide')
     ->setAuthor('Expert Developer')
     ->setLanguage('en')
     ->setDescription('A complete guide to learning PHP from scratch')
     ->setIsbn('978-1234567890')
     ->getMetadata()->setPublisher('Tech Publisher');

// Cover
$epub->setCover('/path/to/cover.jpg');

// Custom CSS
$epub->addStylesheet('/path/to/styles.css');

// Images
$epub->addImage('/path/to/logo.png', 'logo');
$epub->addImage('/path/to/diagram.svg', 'diagram');

// Chapters
$epub->addChapter('Prologue', file_get_contents('chapters/prologue.html'));
$epub->addChapter('Introduction to PHP', file_get_contents('chapters/intro.html'));
$epub->addChapter('Variables and Types', file_get_contents('chapters/variables.html'));
$epub->addChapter('Functions', file_get_contents('chapters/functions.html'));
$epub->addChapter('Object-Oriented Programming', file_get_contents('chapters/oop.html'));
$epub->addChapter('Conclusions', file_get_contents('chapters/conclusion.html'));

// Generate
if ($epub->save('complete-php-guide.epub')) {
    echo "Book generated successfully!\n";
}
```

### Automated Generation from Markdown

```php
<?php
use PHPEpub\EpubBuilder;

function markdownToHtml($markdown) {
    // Implement basic Markdown to HTML conversion
    // Or use a library like Parsedown
    return $markdown; // Simplified for the example
}

$epub = new EpubBuilder();
$epub->setTitle('Book from Markdown')
     ->setAuthor('Automatic Author');

// Read Markdown files and convert to chapters
$markdownFiles = glob('markdown/*.md');
foreach ($markdownFiles as $file) {
    $title = basename($file, '.md');
    $markdown = file_get_contents($file);
    $html = markdownToHtml($markdown);
    
    $epub->addChapter(ucfirst($title), $html);
}

$epub->save('book-from-markdown.epub');
```

## API Reference

### EpubBuilder Class

#### Configuration Methods

| Method | Parameters | Return | Description |
|--------|------------|---------|-------------|
| `setTitle(string $title)` | `$title`: Book title | `self` | Sets the title (required) |
| `setAuthor(string $author)` | `$author`: Author name | `self` | Sets the author |
| `setLanguage(string $language)` | `$language`: Language code | `self` | Sets the language (e.g: 'es', 'en') |
| `setDescription(string $description)` | `$description`: Description | `self` | Sets the description |
| `setIsbn(string $isbn)` | `$isbn`: ISBN number | `self` | Sets the ISBN |
| `setCover(string $imagePath)` | `$imagePath`: Image path | `self` | Sets the cover image |

#### Content Methods

| Method | Parameters | Return | Description |
|--------|------------|---------|-------------|
| `addChapter(string $title, string $content, ?string $filename)` | `$title`: Title<br>`$content`: HTML<br>`$filename`: File name | `self` | Adds a chapter |
| `addImage(string $imagePath, ?string $id)` | `$imagePath`: Image path<br>`$id`: Optional ID | `self` | Adds an image |
| `addStylesheet(string $cssPath, ?string $id)` | `$cssPath`: CSS path<br>`$id`: Optional ID | `self` | Adds CSS |

#### Generation Methods

| Method | Parameters | Return | Description |
|--------|------------|---------|-------------|
| `save(string $filename)` | `$filename`: EPUB file name | `bool` | Generates and saves the EPUB |
| `getMetadata()` | - | `Metadata` | Gets the metadata |
| `getChapters()` | - | `array` | Gets the chapters |

### Exceptions

The library throws `PHPEpub\Exception\EpubException` in the following cases:

- Image file not found
- CSS file not found
- Cannot generate books without chapters
- Title not specified
- Error creating ZIP file
- Errors during generation

### Error Handling Example

```php
try {
    $epub = new EpubBuilder();
    $epub->setTitle('My Book')->save('book.epub');
} catch (PHPEpub\Exception\EpubException $e) {
    echo "Error generating EPUB: " . $e->getMessage();
} catch (Exception $e) {
    echo "General error: " . $e->getMessage();
}
```

---

## Additional Resources

- [Release Notes](releases/README.md) - Detailed release information
- [Contributing Guide](../CONTRIBUTING.md) - How to contribute to the project
- [Security Policy](../SECURITY.md) - Security guidelines and reporting
- [Changelog](../CHANGELOG.md) - Version history and changes
