<?php

declare(strict_types=1);

namespace PHPEpub\Tests\Structure;

use PHPUnit\Framework\TestCase;
use PHPEpub\Structure\Metadata;

class MetadataTest extends TestCase
{
    private Metadata $metadata;

    protected function setUp(): void
    {
        $this->metadata = new Metadata();
    }

    public function testDefaultValues(): void
    {
        $this->assertEquals('es', $this->metadata->getLanguage());
        $this->assertNotEmpty($this->metadata->getIdentifier());
        $this->assertNotEmpty($this->metadata->getPublicationDate());
    }

    public function testSetAndGetTitle(): void
    {
        $title = 'Test Title';
        $result = $this->metadata->setTitle($title);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($title, $this->metadata->getTitle());
    }

    public function testSetAndGetAuthor(): void
    {
        $author = 'Test Author';
        $result = $this->metadata->setAuthor($author);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($author, $this->metadata->getAuthor());
    }

    public function testSetAndGetLanguage(): void
    {
        $language = 'en';
        $result = $this->metadata->setLanguage($language);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($language, $this->metadata->getLanguage());
    }

    public function testSetAndGetDescription(): void
    {
        $description = 'Test Description';
        $result = $this->metadata->setDescription($description);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($description, $this->metadata->getDescription());
    }

    public function testSetAndGetIsbn(): void
    {
        $isbn = '978-1234567890';
        $result = $this->metadata->setIsbn($isbn);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($isbn, $this->metadata->getIsbn());
    }

    public function testSetAndGetPublisher(): void
    {
        $publisher = 'Test Publisher';
        $result = $this->metadata->setPublisher($publisher);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($publisher, $this->metadata->getPublisher());
    }

    public function testSetAndGetCover(): void
    {
        $cover = '/path/to/cover.jpg';
        $result = $this->metadata->setCover($cover);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($cover, $this->metadata->getCover());
    }

    public function testSetAndGetIdentifier(): void
    {
        $identifier = 'custom-identifier';
        $result = $this->metadata->setIdentifier($identifier);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($identifier, $this->metadata->getIdentifier());
    }

    public function testSetAndGetPublicationDate(): void
    {
        $date = '2025-01-01T00:00:00Z';
        $result = $this->metadata->setPublicationDate($date);
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals($date, $this->metadata->getPublicationDate());
    }
}
