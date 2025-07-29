<?php

declare(strict_types=1);

namespace PHPEpub\Tests\Enum;

use PHPUnit\Framework\TestCase;
use PHPEpub\Enum\ImageMimeType;

class ImageMimeTypeTest extends TestCase
{
    public function testFromExtension(): void
    {
        $this->assertEquals(ImageMimeType::JPEG, ImageMimeType::fromExtension('jpg'));
        $this->assertEquals(ImageMimeType::JPEG, ImageMimeType::fromExtension('jpeg'));
        $this->assertEquals(ImageMimeType::PNG, ImageMimeType::fromExtension('png'));
        $this->assertEquals(ImageMimeType::GIF, ImageMimeType::fromExtension('gif'));
        $this->assertEquals(ImageMimeType::SVG, ImageMimeType::fromExtension('svg'));
        $this->assertEquals(ImageMimeType::WEBP, ImageMimeType::fromExtension('webp'));
    }

    public function testFromExtensionCaseInsensitive(): void
    {
        $this->assertEquals(ImageMimeType::JPEG, ImageMimeType::fromExtension('JPG'));
        $this->assertEquals(ImageMimeType::PNG, ImageMimeType::fromExtension('PNG'));
    }

    public function testFromExtensionDefault(): void
    {
        $this->assertEquals(ImageMimeType::JPEG, ImageMimeType::fromExtension('unknown'));
        $this->assertEquals(ImageMimeType::JPEG, ImageMimeType::fromExtension('txt'));
    }

    public function testGetValidExtensions(): void
    {
        $extensions = ImageMimeType::getValidExtensions();
        
        $this->assertContains('jpg', $extensions);
        $this->assertContains('jpeg', $extensions);
        $this->assertContains('png', $extensions);
        $this->assertContains('gif', $extensions);
        $this->assertContains('svg', $extensions);
        $this->assertContains('webp', $extensions);
    }

    public function testIsValidExtension(): void
    {
        $this->assertTrue(ImageMimeType::isValidExtension('jpg'));
        $this->assertTrue(ImageMimeType::isValidExtension('JPG'));
        $this->assertTrue(ImageMimeType::isValidExtension('png'));
        $this->assertTrue(ImageMimeType::isValidExtension('gif'));
        $this->assertTrue(ImageMimeType::isValidExtension('svg'));
        $this->assertTrue(ImageMimeType::isValidExtension('webp'));
        
        $this->assertFalse(ImageMimeType::isValidExtension('txt'));
        $this->assertFalse(ImageMimeType::isValidExtension('pdf'));
        $this->assertFalse(ImageMimeType::isValidExtension('unknown'));
    }

    public function testEnumValues(): void
    {
        $this->assertEquals('image/jpeg', ImageMimeType::JPEG->value);
        $this->assertEquals('image/png', ImageMimeType::PNG->value);
        $this->assertEquals('image/gif', ImageMimeType::GIF->value);
        $this->assertEquals('image/svg+xml', ImageMimeType::SVG->value);
        $this->assertEquals('image/webp', ImageMimeType::WEBP->value);
    }
}
