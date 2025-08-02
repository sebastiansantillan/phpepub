# 🌍 Accessibility Guide for PHPEpub

## Overview

PHPEpub provides comprehensive support for creating accessible EPUBs that comply with international accessibility standards. This guide covers all aspects of implementing accessibility in your EPUB publications.

## Standards Compliance

### Implemented Standards

- ✅ **EPUB Accessibility 1.1** - Complete specification
- ✅ **WCAG 2.1 Level AA** - All success criteria
- ✅ **Schema.org Accessibility Vocabulary** - Structured metadata
- ✅ **Dublin Core Terms** - Compliance metadata
- ✅ **ISO 14289-1** - PDF/UA accessibility (as reference)

## Quick Start

### Basic Accessible EPUB

```php
<?php
use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();

// Basic metadata
$epub->setTitle('Accessible Book')
     ->setAuthor('Author Name')
     ->setDescription('A book designed with accessibility in mind');

// Required accessibility metadata
$epub->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('This book is fully accessible with proper navigation and alternative text.');

// Content with proper structure
$epub->addChapter('Introduction', '
<h1>Introduction</h1>
<p>Welcome to our accessible book.</p>
<h2>About Accessibility</h2>
<p>This book follows WCAG 2.1 guidelines.</p>
');

$epub->save('accessible-book.epub');
```

## Complete Accessibility Implementation

### Schema.org Metadata

#### Access Modes (Required)

Describes how the content can be accessed:

```php
$epub->addAccessMode('textual')    // Text content
     ->addAccessMode('visual')     // Images, charts, visual elements
     ->addAccessMode('auditory')   // Audio content
     ->addAccessMode('tactile');   // Braille or tactile elements
```

#### Access Mode Sufficient (Recommended)

Describes sufficient combinations of access modes:

```php
// Single mode sufficient
$epub->addAccessModeSufficient(['textual']);     // Text alone is sufficient
$epub->addAccessModeSufficient(['visual']);      // Visual alone is sufficient

// Multiple modes required
$epub->addAccessModeSufficient(['textual', 'visual']); // Both text and visual needed
```

#### Accessibility Features (Required)

Lists accessibility features present in the content:

```php
$epub->addAccessibilityFeature('structuralNavigation')    // Headings, TOC navigation
     ->addAccessibilityFeature('alternativeText')         // Alt text for images
     ->addAccessibilityFeature('readingOrder')            // Logical reading sequence
     ->addAccessibilityFeature('tableOfContents')         // Table of contents
     ->addAccessibilityFeature('printPageNumbers')        // Page number references
     ->addAccessibilityFeature('index')                   // Alphabetical index
     ->addAccessibilityFeature('audioDescription')        // Audio descriptions
     ->addAccessibilityFeature('captions')                // Video captions
     ->addAccessibilityFeature('transcript')              // Audio transcripts
     ->addAccessibilityFeature('synchronizedAudioText')   // Synchronized audio/text
     ->addAccessibilityFeature('displayTransformability') // Resizable text/images
     ->addAccessibilityFeature('unlocked');               // No DRM restrictions
```

#### Accessibility Hazards (Required)

Identifies potential accessibility hazards:

```php
// No hazards present
$epub->addAccessibilityHazard('none');

// Specific hazards absent
$epub->addAccessibilityHazard('noFlashingHazard')        // No flashing content
     ->addAccessibilityHazard('noMotionSimulationHazard') // No motion simulation
     ->addAccessibilityHazard('noSoundHazard');           // No sudden sounds

// Hazards present (use carefully)
$epub->addAccessibilityHazard('flashing')         // Contains flashing content
     ->addAccessibilityHazard('motionSimulation')  // Contains motion simulation
     ->addAccessibilityHazard('sound');            // Contains sound hazards
```

#### Accessibility Summary (Recommended)

Human-readable description of accessibility features:

```php
$epub->setAccessibilitySummary('
This publication includes complete structural navigation with proper heading hierarchy, 
descriptive alternative text for all images, logical reading order throughout all content, 
and a comprehensive table of contents. All audio content includes transcripts and video 
content includes captions. The publication contains no known accessibility hazards and 
is designed to work with all assistive technologies including screen readers, voice 
recognition software, and alternative navigation devices.
');
```

### EPUB Accessibility 1.1 Certification

For professionally certified accessible content:

```php
$epub->setCertifiedBy('International Association of Accessibility Professionals')
     ->setCertifierCredential('IAAP CPACC - Certified Professional in Accessibility Core Competencies')
     ->setCertifierReport('https://example.com/accessibility-reports/book-certification-2025.pdf');
```

### Standards Compliance

Declares conformance to accessibility standards:

```php
// Automatic URL conversion for common standards
$epub->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');

// Direct URL references
$epub->addConformsTo('https://www.w3.org/TR/epub-a11y-11/')
     ->addConformsTo('https://www.w3.org/TR/WCAG21/')
     ->addConformsTo('https://www.iso.org/standard/58625.html'); // ISO 14289-1
```

## Content Best Practices

### Structural Navigation

Use proper heading hierarchy:

```php
$content = '
<h1>Chapter Title</h1>
<p>Chapter introduction...</p>

<h2>Section Title</h2>
<p>Section content...</p>

<h3>Subsection Title</h3>
<p>Subsection content...</p>
';
```

### Alternative Text for Images

Provide descriptive alternative text:

```php
$content = '
<h1>Visual Content</h1>
<img src="../Images/chart.png" alt="Sales chart showing 25% increase from Q1 to Q2 2025" />
<p>The chart demonstrates significant growth...</p>

<!-- Decorative images -->
<img src="../Images/decorative-border.png" alt="" role="presentation" />
';
```

### Tables with Headers

Use proper table structure:

```php
$content = '
<table>
    <caption>Quarterly Sales Results</caption>
    <thead>
        <tr>
            <th scope="col">Quarter</th>
            <th scope="col">Sales</th>
            <th scope="col">Growth</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Q1 2025</th>
            <td>$50,000</td>
            <td>+15%</td>
        </tr>
    </tbody>
</table>
';
```

### Lists and Navigation

Use semantic list structures:

```php
$content = '
<nav aria-label="Chapter navigation">
    <ol>
        <li><a href="#intro">Introduction</a></li>
        <li><a href="#methods">Methodology</a></li>
        <li><a href="#results">Results</a></li>
        <li><a href="#conclusion">Conclusion</a></li>
    </ol>
</nav>

<h2>Key Points</h2>
<ul>
    <li>First important point</li>
    <li>Second crucial element</li>
    <li>Final consideration</li>
</ul>
';
```

## Validation and Testing

### Automated Validation

1. **EPUBCheck** - Basic EPUB structure validation
```bash
java -jar epubcheck.jar your-book.epub
```

2. **Ace by DAISY** - Comprehensive accessibility checking
```bash
ace your-book.epub
```

### Manual Testing

1. **Screen Reader Testing**
   - NVDA (Windows - Free)
   - JAWS (Windows - Commercial)
   - VoiceOver (macOS - Built-in)
   - Orca (Linux - Free)

2. **Navigation Testing**
   - Tab through all interactive elements
   - Test heading navigation (H key in screen readers)
   - Verify table of contents functionality
   - Check reading order flow

3. **Visual Testing**
   - High contrast mode compatibility
   - Text scaling (up to 200%)
   - Color contrast ratios (4.5:1 minimum)
   - Focus indicators visibility

## Real-World Examples

### Academic Textbook

```php
$epub = new EpubBuilder();

$epub->setTitle('Advanced Mathematics: Calculus and Beyond')
     ->setAuthor('Dr. Sarah Johnson')
     ->setDescription('Comprehensive calculus textbook with accessible mathematical notation')
     ->addSubject('Mathematics')
     ->addSubject('Calculus')
     ->addSubject('Education');

// Accessibility for mathematical content
$epub->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessModeSufficient(['textual'])  // Math can be read as text
     ->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityFeature('describedMath')    // Mathematical descriptions
     ->addAccessibilityFeature('MathML')           // MathML support
     ->addAccessibilityFeature('tableOfContents')
     ->addAccessibilityFeature('index')
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('Mathematics textbook with complete alternative text for all equations and diagrams, MathML markup for complex expressions, and descriptive text for all visual mathematical content.');

$epub->setCertifiedBy('Educational Accessibility Standards Board')
     ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');
```

### Children's Picture Book

```php
$epub = new EpubBuilder();

$epub->setTitle('The Adventures of Accessible Annie')
     ->setAuthor('Children\'s Author Collective')
     ->setDescription('Interactive children\'s story with complete audio narration and visual descriptions')
     ->setLanguage('en')
     ->addSubject('Children\'s Literature')
     ->addSubject('Early Learning');

// Multimedia accessibility
$epub->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessMode('auditory')
     ->addAccessModeSufficient(['textual', 'auditory'])  // Text + audio sufficient
     ->addAccessModeSufficient(['visual', 'auditory'])   // Visual + audio sufficient
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityFeature('audioDescription')
     ->addAccessibilityFeature('synchronizedAudioText')
     ->addAccessibilityFeature('readingOrder')
     ->addAccessibilityFeature('unlocked')               // No DRM for accessibility tools
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('Interactive children\'s book with complete audio narration, detailed descriptions of all illustrations, and synchronized highlighting of text during audio playback.');

$epub->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
     ->addConformsTo('https://www.w3.org/TR/epub-a11y-11/');
```

### Technical Manual

```php
$epub = new EpubBuilder();

$epub->setTitle('Software Development Best Practices')
     ->setAuthor('Tech Industry Consortium')
     ->setDescription('Comprehensive guide to accessible software development')
     ->addSubject('Software Development')
     ->addSubject('Accessibility')
     ->addSubject('Programming');

// Technical content accessibility
$epub->addAccessMode('textual')
     ->addAccessMode('visual')
     ->addAccessModeSufficient(['textual'])              // Code can be read as text
     ->addAccessibilityFeature('structuralNavigation')
     ->addAccessibilityFeature('alternativeText')
     ->addAccessibilityFeature('readingOrder')
     ->addAccessibilityFeature('tableOfContents')
     ->addAccessibilityFeature('index')
     ->addAccessibilityFeature('printPageNumbers')       // Reference citations
     ->addAccessibilityFeature('annotations')            // Code comments
     ->addAccessibilityHazard('none')
     ->setAccessibilitySummary('Technical manual with properly formatted code examples, alternative text for all diagrams and screenshots, comprehensive navigation, and detailed descriptions of visual programming concepts.');

$epub->setCertifiedBy('Software Accessibility Certification Institute')
     ->setCertifierCredential('CPWA - Certified Professional in Web Accessibility')
     ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');
```

## Troubleshooting

### Common Issues

1. **Missing Required Metadata**
   ```php
   // Always include these minimum requirements
   $epub->addAccessMode('textual')
        ->addAccessibilityFeature('structuralNavigation')
        ->addAccessibilityHazard('none');
   ```

2. **Invalid Feature Values**
   ```php
   // Use exact Schema.org vocabulary terms
   $epub->addAccessibilityFeature('alternativeText');  // ✅ Correct
   // $epub->addAccessibilityFeature('alt-text');      // ❌ Invalid
   ```

3. **Incomplete Hazard Declaration**
   ```php
   // Be explicit about hazards
   $epub->addAccessibilityHazard('none');              // ✅ No hazards
   // OR specify what's not present
   $epub->addAccessibilityHazard('noFlashingHazard')
        ->addAccessibilityHazard('noSoundHazard');     // ✅ Specific absences
   ```

### Validation Errors

Common EPUBCheck/Ace validation issues and solutions:

1. **Missing accessibility metadata**: Add required Schema.org properties
2. **Invalid hazard values**: Use only approved vocabulary terms
3. **Inconsistent access modes**: Ensure declared modes match content
4. **Missing alternative text**: Add alt attributes to all images
5. **Poor heading structure**: Use logical heading hierarchy (h1 → h2 → h3)

## Resources and References

### Official Specifications

- [EPUB Accessibility 1.1](https://www.w3.org/TR/epub-a11y-11/)
- [WCAG 2.1 Guidelines](https://www.w3.org/TR/WCAG21/)
- [Schema.org Accessibility](https://schema.org/docs/accessibility.html)
- [EPUB 3.3 Specification](https://www.w3.org/TR/epub-33/)

### Validation Tools

- [EPUBCheck](https://github.com/w3c/epubcheck) - Official EPUB validator
- [Ace by DAISY](https://daisy.github.io/ace/) - Accessibility checker
- [WAVE](https://wave.webaim.org/) - Web accessibility evaluation
- [axe DevTools](https://www.deque.com/axe/devtools/) - Browser accessibility testing

### Learning Resources

- [DAISY Consortium](https://daisy.org/) - Digital accessibility standards
- [WebAIM](https://webaim.org/) - Web accessibility tutorials
- [A11Y Project](https://www.a11yproject.com/) - Community accessibility resources
- [Inclusive Publishing](https://inclusivepublishing.org/) - Publishing accessibility

---

*This guide ensures your EPUBs meet the highest accessibility standards and provide an excellent experience for all readers.*
