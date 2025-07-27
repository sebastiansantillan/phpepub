<?php

declare(strict_types=1);

namespace PHPEpub\Tests\Structure;

use PHPUnit\Framework\TestCase;
use PHPEpub\Structure\Chapter;

class ChapterTest extends TestCase
{
    public function testChapterCreation(): void
    {
        $title = 'Test Chapter';
        $content = '<h1>Test Content</h1>';
        
        $chapter = new Chapter($title, $content);
        
        $this->assertEquals($title, $chapter->getTitle());
        $this->assertEquals($content, $chapter->getContent());
        $this->assertEquals('test_chapter.xhtml', $chapter->getFilename());
        $this->assertEquals(1, $chapter->getOrder());
    }

    public function testChapterWithCustomFilename(): void
    {
        $title = 'Test Chapter';
        $content = '<h1>Test Content</h1>';
        $filename = 'custom_chapter.xhtml';
        
        $chapter = new Chapter($title, $content, $filename);
        
        $this->assertEquals($filename, $chapter->getFilename());
    }

    public function testChapterOrder(): void
    {
        $chapter1 = new Chapter('Chapter 1', '<h1>Content 1</h1>');
        $chapter2 = new Chapter('Chapter 2', '<h1>Content 2</h1>');
        $chapter3 = new Chapter('Chapter 3', '<h1>Content 3</h1>');
        
        $this->assertTrue($chapter1->getOrder() < $chapter2->getOrder());
        $this->assertTrue($chapter2->getOrder() < $chapter3->getOrder());
    }

    public function testFilenameGeneration(): void
    {
        $testCases = [
            'Simple Title' => 'simple_title.xhtml',
            'Title with Numbers 123' => 'title_with_numbers_123.xhtml',
            'Title with Special @#$ Characters!' => 'title_with_special_characters.xhtml',
            '   Spaced   Title   ' => 'spaced_title.xhtml',
            '' => 'chapter_' // Will include order number
        ];
        
        foreach ($testCases as $title => $expectedPrefix) {
            $chapter = new Chapter($title, '<h1>Content</h1>');
            
            if ($title === '') {
                $this->assertStringStartsWith($expectedPrefix, $chapter->getFilename());
            } else {
                $this->assertEquals($expectedPrefix, $chapter->getFilename());
            }
        }
    }

    public function testGetHtmlContent(): void
    {
        $title = 'Test Chapter';
        $content = '<h1>Test Content</h1><p>Paragraph</p>';
        
        $chapter = new Chapter($title, $content);
        $html = $chapter->getHtmlContent();
        
        $this->assertStringContainsString('<!DOCTYPE html>', $html);
        $this->assertStringContainsString('<html xmlns="http://www.w3.org/1999/xhtml">', $html);
        $this->assertStringContainsString('<title>Test Chapter</title>', $html);
        $this->assertStringContainsString('<link rel="stylesheet"', $html);
        $this->assertStringContainsString($content, $html);
    }

    public function testSetMethods(): void
    {
        $chapter = new Chapter('Original Title', '<h1>Original</h1>');
        
        $result = $chapter->setTitle('New Title');
        $this->assertInstanceOf(Chapter::class, $result);
        $this->assertEquals('New Title', $chapter->getTitle());
        
        $result = $chapter->setContent('<h1>New Content</h1>');
        $this->assertInstanceOf(Chapter::class, $result);
        $this->assertEquals('<h1>New Content</h1>', $chapter->getContent());
        
        $result = $chapter->setFilename('new_filename.xhtml');
        $this->assertInstanceOf(Chapter::class, $result);
        $this->assertEquals('new_filename.xhtml', $chapter->getFilename());
        
        // Order is readonly and set automatically, so we just test it exists
        $this->assertIsInt($chapter->getOrder());
        $this->assertGreaterThan(0, $chapter->getOrder());
    }
}
