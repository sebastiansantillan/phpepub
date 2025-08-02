# PHPEpub Documentation

## Table of Contents

1. [Installation](#installation)
2. [Basic Usage](#basic-usage)
3. [Metadata Configuration](#metadata-configuration)
4. [Chapter Management](#chapter-management)
5. [Images and Resources](#images-and-resources)
6. [CSS Styles](#css-styles)
7. [Accessibility Support](#accessibility-support)
8. [Advanced Examples](#advanced-examples)
9. [API Reference](#api-reference)

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

## Accessibility Support

PHPEpub includes **complete EPUB Accessibility 1.1 support** with all Schema.org accessibility metadata, EPUB Accessibility 1.1 certification, and WCAG 2.1 Level AA compliance.

### ✅ **Implemented Accessibility Standards**

- **EPUB Accessibility 1.1** - Complete specification implementation
- **WCAG 2.1 Level AA** - All guidelines supported
- **Schema.org Accessibility Vocabulary** - Full metadata support
- **Dublin Core Terms** - Compliance metadata

### 📋 **Accessibility Metadata Categories**

#### **Schema.org Accessibility Metadata (Required)**

```php
$epub = new EpubBuilder();

// Access Modes (REQUIRED) - How content can be accessed
$epub->addAccessMode('textual')    // Text content
     ->addAccessMode('visual')     // Visual content
     ->addAccessMode('auditory');  // Audio content

// Access Mode Sufficient (RECOMMENDED) - Sufficient combinations
$epub->addAccessModeSufficient(['textual'])
     ->addAccessModeSufficient(['visual']);

// Accessibility Features (REQUIRED) - Available features
$epub->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityFeature('readingOrder')
     ->addAccessibilityFeature('tableOfContents');

// Accessibility Hazards (REQUIRED) - Potential risks
$epub->addAccessibilityHazard('none')  // No known hazards
     ->addAccessibilityHazard('noFlashingHazard')
     ->addAccessibilityHazard('noSoundHazard');

// Accessibility Summary (RECOMMENDED) - Human-readable description
$epub->setAccessibilitySummary('This publication includes complete structural navigation, alternative text for all images, logical reading order, and comprehensive table of contents. No accessibility hazards are present.');
```

#### **EPUB Accessibility 1.1 Certification (Optional)**

```php
// Certification metadata for professional compliance
$epub->setCertifiedBy('Accessibility Certification Organization')
     ->setCertifierCredential('IAAP CPACC - Certified Professional in Accessibility Core Competencies')
     ->setCertifierReport('https://example.com/accessibility-reports/my-book-2025.pdf');
```

#### **Standards Compliance (Recommended)**

```php
// Standards compliance with automatic URL conversion
$epub->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')  // Auto-converts to official URLs
     ->addConformsTo('https://www.w3.org/TR/epub-a11y-11/')
     ->addConformsTo('https://www.iso.org/standard/58625.html');  // ISO 14289-1
```

### 🎯 **Complete Accessibility Example**

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

// Basic metadata
$epub->setTitle('Accessible Digital Guide')
     ->setAuthor('Accessibility Expert')
     ->setLanguage('en')
     ->setDescription('A comprehensive guide to digital accessibility that meets all international standards.');

// Schema.org accessibility metadata
$epub->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessModeSufficient(['textual'])
     ->addAccessModeSufficient(['visual'])
     ->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityFeature('readingOrder')
     ->addAccessibilityFeature('tableOfContents')
     ->addAccessibilityFeature('printPageNumbers')
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('This book is fully accessible with complete navigation, alternative text for all images, logical reading order, and table of contents. No accessibility hazards are present.');

// EPUB Accessibility 1.1 certification
$epub->setCertifiedBy('Digital Accessibility Certification Center')
     ->setCertifierCredential('IAAP CPACC Certification')
     ->setCertifierReport('https://example.com/reports/accessible-guide-2025.pdf');

// Standards compliance
$epub->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
     ->addConformsTo('https://www.w3.org/TR/epub-a11y-11/');

// Accessible content structure
$epub->addChapter('Introduction', '
<h1>Introduction to Digital Accessibility</h1>
<p>Digital accessibility ensures that all users, regardless of their abilities, can access and use digital content effectively.</p>

<h2>Key Principles</h2>
<ul>
    <li><strong>Perceivable:</strong> Information must be presentable in ways users can perceive</li>
    <li><strong>Operable:</strong> Interface components must be operable by all users</li>
    <li><strong>Understandable:</strong> Information and UI operation must be understandable</li>
    <li><strong>Robust:</strong> Content must be robust enough for various assistive technologies</li>
</ul>
');

$epub->addChapter('Implementation Guide', '
<h1>Implementation Guidelines</h1>

<h2>Structural Navigation</h2>
<p>Use proper heading hierarchy and semantic markup for screen readers and navigation tools.</p>

<h2>Alternative Text</h2>
<p>All images must include descriptive alternative text that conveys the same information as the visual content.</p>

<h2>Reading Order</h2>
<p>Ensure logical reading order that makes sense when accessed sequentially by assistive technologies.</p>
');

$epub->save('accessible-guide.epub');

echo "✅ Accessible EPUB generated with complete metadata compliance!\n";
echo "📋 Standards: EPUB Accessibility 1.1 + WCAG 2.1 Level AA\n";
echo "🎯 Validation: Ready for EPUBCheck and Ace by DAISY\n";
```

### 🔍 **Generated Accessibility Metadata**

The above example generates the following metadata in the EPUB package:

```xml
<!-- Schema.org Accessibility Metadata -->
<meta property="schema:accessMode">textual</meta>
<meta property="schema:accessMode">visual</meta>
<meta property="schema:accessModeSufficient">textual</meta>
<meta property="schema:accessibilityFeature">structuralNavigation</meta>
<meta property="schema:accessibilityFeature">alternativeText</meta>
<meta property="schema:accessibilityHazard">none</meta>
<meta property="schema:accessibilitySummary">This book is fully accessible...</meta>

<!-- EPUB Accessibility 1.1 Certification -->
<meta property="a11y:certifiedBy">Digital Accessibility Certification Center</meta>
<meta property="a11y:certifierCredential">IAAP CPACC Certification</meta>
<meta property="a11y:certifierReport">https://example.com/reports/accessible-guide-2025.pdf</meta>

<!-- Standards Compliance -->
<meta property="dcterms:conformsTo">http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa</meta>
<meta property="dcterms:conformsTo">https://www.w3.org/TR/WCAG21/</meta>
<meta property="dcterms:conformsTo">https://www.w3.org/TR/epub-a11y-11/</meta>
```

### 📚 **Accessibility Best Practices**

#### **Content Structure**
- Use proper heading hierarchy (`<h1>`, `<h2>`, `<h3>`, etc.)
- Include table of contents for navigation
- Use semantic HTML elements (`<nav>`, `<main>`, `<article>`, etc.)
- Provide logical reading order

#### **Images and Media**
- Include descriptive alternative text for all images
- Use empty `alt=""` for decorative images
- Provide captions for audio/video content
- Include transcripts for audio content

#### **Navigation and Interaction**
- Ensure keyboard navigation support
- Provide skip links for long content
- Use descriptive link text
- Include landmarks for screen readers

### 🛠️ **Validation Tools**

After generating your accessible EPUB, validate it with these tools:

1. **EPUBCheck** - Technical validation of EPUB structure
2. **Ace by DAISY** - Comprehensive accessibility evaluation
3. **EPUB Accessibility Checker** - Metadata verification
4. **Screen Readers** - Manual testing with NVDA, JAWS, or VoiceOver

### 📋 **API Reference for Accessibility**

#### **Access Modes**
Valid values: `textual`, `visual`, `auditory`, `tactile`

#### **Accessibility Features**
Valid values include: `alternativeText`, `annotations`, `audioDescription`, `bookmarks`, `braille`, `captions`, `describedMath`, `displayTransformability`, `index`, `largePrint`, `longDescription`, `none`, `printPageNumbers`, `readingOrder`, `structuralNavigation`, `synchronizedAudioText`, `tableOfContents`, `transcript`, `unlocked`

#### **Accessibility Hazards**
Valid values: `flashing`, `motionSimulation`, `sound`, `noFlashingHazard`, `noMotionSimulationHazard`, `noSoundHazard`, `none`, `unknown`

### 🎉 **Benefits of Accessible EPUBs**

- **Universal Access** - Reach all users regardless of abilities
- **Legal Compliance** - Meet international accessibility standards
- **Better UX** - Improved experience for all readers
- **Market Expansion** - Access to broader audience
- **Future-Proof** - Ready for evolving accessibility requirements

---

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

#### Accessibility Methods

| Method | Parameters | Return | Description |
|--------|------------|---------|-------------|
| `addAccessMode(string $mode)` | `$mode`: Access mode (textual, visual, auditory, tactile) | `self` | Adds an access mode |
| `addAccessModeSufficient(array $modes)` | `$modes`: Array of access modes | `self` | Adds sufficient access mode combination |
| `addAccessibilityFeature(string $feature)` | `$feature`: Accessibility feature | `self` | Adds accessibility feature |
| `addAccessibilityHazard(string $hazard)` | `$hazard`: Accessibility hazard | `self` | Adds accessibility hazard |
| `setAccessibilitySummary(string $summary)` | `$summary`: Human-readable summary | `self` | Sets accessibility summary |
| `setCertifiedBy(string $certifier)` | `$certifier`: Certification organization | `self` | Sets certification organization |
| `setCertifierCredential(string $credential)` | `$credential`: Certifier credentials | `self` | Sets certifier credentials |
| `setCertifierReport(string $report)` | `$report`: Report URL | `self` | Sets certification report URL |
| `addConformsTo(string $standard)` | `$standard`: Standard or URL | `self` | Adds standards compliance |

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
- [Accessibility Implementation](../ACCESSIBILITY_IMPLEMENTATION_SUMMARY.md) - Complete accessibility implementation details

### Accessibility Standards Compliance

PHPEpub fully implements the following accessibility standards:

- **EPUB Accessibility 1.1** - Complete specification compliance
- **WCAG 2.1 Level AA** - All Web Content Accessibility Guidelines
- **Schema.org Accessibility Vocabulary** - Structured accessibility metadata
- **Dublin Core Terms** - Metadata standards compliance
- **DAISY Consortium Standards** - Digital accessible information systems

### Validation Tools for Accessible EPUBs

1. **[EPUBCheck](https://github.com/w3c/epubcheck)** - Official EPUB validation tool
2. **[Ace by DAISY](https://daisy.github.io/ace/)** - Accessibility checker for EPUB
3. **[EPUB Accessibility Checker](https://inclusivepublishing.org/toolbox/accessibility-checker/)** - Metadata validation
4. **Screen Readers** - NVDA, JAWS, VoiceOver for manual testing
