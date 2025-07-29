<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    $epub = new EpubBuilder();

    // More complete metadata
    $epub->setTitle('Advanced Book with PHPEbook')
         ->setAuthor('Expert Developer')
         ->setLanguage('en')
         ->setDescription('An advanced example that showcases all PHPEpub features')
         ->setIsbn('978-0000000000');

    // If you have a cover image, uncomment the following line
    // $epub->setCover(__DIR__ . '/assets/cover.jpg');

    // Chapters with more elaborate content
    $epub->addChapter(
        'Preface',
        '<h1>Preface</h1>
        <p>This book demonstrates advanced PHPEpub features, including complex formatting, lists, tables and more.</p>'
    );

    $epub->addChapter(
        'Lists and Formatting',
        '<h1>Lists and Formatting</h1>
        <h2>Feature List</h2>
        <ul>
            <li><strong>Bold</strong> and <em>italic</em></li>
            <li>Ordered and unordered lists</li>
            <li>Tables and code</li>
            <li>Quotes and special blocks</li>
        </ul>
        
        <h2>Numbered List</h2>
        <ol>
            <li>First element</li>
            <li>Second element</li>
            <li>Third element</li>
        </ol>'
    );

    $epub->addChapter(
        'Tables',
        '<h1>Tables</h1>
        <p>PHPEpub supports standard HTML tables:</p>
        
        <table border="1" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 8px;">Feature</th>
                    <th style="padding: 8px;">Support</th>
                    <th style="padding: 8px;">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 8px;">Metadata</td>
                    <td style="padding: 8px;">✅ Complete</td>
                    <td style="padding: 8px;">Title, author, ISBN, etc.</td>
                </tr>
                <tr>
                    <td style="padding: 8px;">Images</td>
                    <td style="padding: 8px;">✅ Complete</td>
                    <td style="padding: 8px;">JPG, PNG, GIF, SVG</td>
                </tr>
                <tr>
                    <td style="padding: 8px;">CSS</td>
                    <td style="padding: 8px;">✅ Complete</td>
                    <td style="padding: 8px;">Custom styles</td>
                </tr>
            </tbody>
        </table>'
    );

    // If you have images, you can add them like this:
    // $epub->addImage(__DIR__ . '/assets/diagram.png', 'diagram');

    // If you have custom CSS:
    // $epub->addStylesheet(__DIR__ . '/assets/custom.css', 'custom');

    // Generate the file
    $filename = 'advanced-example.epub';
    if ($epub->save($filename)) {
        echo "✅ Advanced book generated: {$filename}\n";
        
        // Show book information
        $metadata = $epub->getMetadata();
        echo "\n📚 Book information:\n";
        echo "   Title: " . $metadata->getTitle() . "\n";
        echo "   Author: " . $metadata->getAuthor() . "\n";
        echo "   Language: " . $metadata->getLanguage() . "\n";
        echo "   Chapters: " . count($epub->getChapters()) . "\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
