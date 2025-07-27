<?php

declare(strict_types=1);

namespace PHPEpub\Tests;

use PHPUnit\Framework\TestCase;
use PHPEpub\EpubBuilder;
use PHPEpub\Exception\EpubException;

class EpubBuilderTest extends TestCase
{
    private EpubBuilder $epub;

    protected function setUp(): void
    {
        $this->epub = new EpubBuilder();
    }

    public function testSetTitle(): void
    {
        $title = 'Test Book Title';
        $result = $this->epub->setTitle($title);
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals($title, $this->epub->getMetadata()->getTitle());
    }

    public function testSetAuthor(): void
    {
        $author = 'Test Author';
        $result = $this->epub->setAuthor($author);
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals($author, $this->epub->getMetadata()->getAuthor());
    }

    public function testSetLanguage(): void
    {
        $language = 'en';
        $result = $this->epub->setLanguage($language);
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals($language, $this->epub->getMetadata()->getLanguage());
    }

    public function testSetDescription(): void
    {
        $description = 'Test book description';
        $result = $this->epub->setDescription($description);
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals($description, $this->epub->getMetadata()->getDescription());
    }

    public function testSetIsbn(): void
    {
        $isbn = '978-1234567890';
        $result = $this->epub->setIsbn($isbn);
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals($isbn, $this->epub->getMetadata()->getIsbn());
    }

    public function testAddChapter(): void
    {
        $title = 'Test Chapter';
        $content = '<h1>Test Content</h1>';
        
        $result = $this->epub->addChapter($title, $content);
        $chapters = $this->epub->getChapters();
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertCount(1, $chapters);
        $this->assertEquals($title, $chapters[0]->getTitle());
        $this->assertEquals($content, $chapters[0]->getContent());
    }

    public function testAddMultipleChapters(): void
    {
        $this->epub->addChapter('Chapter 1', '<h1>Content 1</h1>')
                  ->addChapter('Chapter 2', '<h1>Content 2</h1>');
        
        $chapters = $this->epub->getChapters();
        
        $this->assertCount(2, $chapters);
        $this->assertEquals('Chapter 1', $chapters[0]->getTitle());
        $this->assertEquals('Chapter 2', $chapters[1]->getTitle());
    }

    public function testFluentInterface(): void
    {
        $result = $this->epub->setTitle('Test Book')
                            ->setAuthor('Test Author')
                            ->setLanguage('es')
                            ->setDescription('Test Description')
                            ->addChapter('Chapter 1', '<h1>Content</h1>');
        
        $this->assertInstanceOf(EpubBuilder::class, $result);
        $this->assertEquals('Test Book', $this->epub->getMetadata()->getTitle());
        $this->assertEquals('Test Author', $this->epub->getMetadata()->getAuthor());
        $this->assertCount(1, $this->epub->getChapters());
    }

    public function testSaveWithoutChaptersThrowsException(): void
    {
        $this->expectException(EpubException::class);
        $this->expectExceptionMessage('No se pueden generar libros sin capítulos');
        
        $this->epub->setTitle('Test Book')->save('test.epub');
    }

    public function testSaveWithoutTitleThrowsException(): void
    {
        $this->expectException(EpubException::class);
        $this->expectExceptionMessage('El título es requerido');
        
        $this->epub->addChapter('Chapter 1', '<h1>Content</h1>')
                  ->save('test.epub');
    }

    public function testSetCoverWithNonExistentFileThrowsException(): void
    {
        $this->expectException(EpubException::class);
        $this->expectExceptionMessage('El archivo de imagen no existe');
        
        $this->epub->setCover('/non/existent/file.jpg');
    }

    public function testAddImageWithNonExistentFileThrowsException(): void
    {
        $this->expectException(EpubException::class);
        $this->expectExceptionMessage('El archivo de imagen no existe');
        
        $this->epub->addImage('/non/existent/image.jpg');
    }

    public function testAddStylesheetWithNonExistentFileThrowsException(): void
    {
        $this->expectException(EpubException::class);
        $this->expectExceptionMessage('El archivo CSS no existe');
        
        $this->epub->addStylesheet('/non/existent/style.css');
    }

    protected function tearDown(): void
    {
        // Limpiar archivos de prueba si existen
        $testFiles = ['test.epub', 'test-book.epub'];
        foreach ($testFiles as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
