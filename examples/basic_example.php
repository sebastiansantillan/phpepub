<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    // Create a new builder instance
    $epub = new EpubBuilder();

    // Configure metadata
    $epub->setTitle('My First Book with PHPEbook')
         ->setAuthor('Example Author')
         ->setLanguage('en')
         ->setDescription('This is an example book created with the PHPEbook library to demonstrate its basic capabilities.');

    // Add chapters
    $epub->addChapter(
        'Introduction',
        '<h1>Introduction</h1>
        <p>Welcome to this example book. In this first chapter we will explore the basic features of the PHPEpub library.</p>
        <p>PHPEpub allows you to create EPUB files easily and programmatically, with complete support for metadata, multiple chapters, images and CSS styles.</p>'
    );

    $epub->addChapter(
        'Main Features',
        '<h1>Main Features</h1>
        <h2>Ease of Use</h2>
        <p>The library is designed with a fluent interface that allows chaining configuration methods.</p>
        
        <h2>Compatibility</h2>
        <p>Generates EPUB 3.0 files compatible with most e-book readers.</p>
        
        <h2>Customization</h2>
        <p>Allows adding custom CSS styles, images and complete metadata.</p>'
    );

    $epub->addChapter(
        'Example Code',
        '<h1>Example Code</h1>
        <p>Here is a basic example of how to use PHPEpub:</p>
        
        <pre><code>use PHPEpub\EpubBuilder;

$epub = new EpubBuilder();
$epub-&gt;setTitle("My Book")
     -&gt;setAuthor("My Name")
     -&gt;addChapter("Chapter 1", "&lt;h1&gt;First Chapter&lt;/h1&gt;")
     -&gt;save("my-book.epub");</code></pre>
     
        <p>It\'s that simple!</p>'
    );

    $epub->addChapter(
        'Conclusion',
        '<h1>Conclusion</h1>
        <p>We hope this example has been useful for understanding how PHPEpub works.</p>
        <p>For more information, check the complete documentation in the project repository.</p>
        
        <blockquote>
            <p>"Simplicity is the ultimate sophistication." - Leonardo da Vinci</p>
        </blockquote>'
    );

    // Generate the EPUB file
    $filename = 'phpebook-example.epub';
    if ($epub->save($filename)) {
        echo "✅ Book generated successfully: {$filename}\n";
        echo "📖 You can open this file with any EPUB reader\n";
    } else {
        echo "❌ Error generating the book\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
