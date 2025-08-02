<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPEpub\Structure\Metadata;

class MetadataAccessibilityTest extends TestCase
{
    private Metadata $metadata;

    protected function setUp(): void
    {
        $this->metadata = new Metadata(
            'Test Book',
            'Test Author',
            'en',
            'Test Description'
        );
    }

    public function testDefaultAccessModes(): void
    {
        $accessModes = $this->metadata->getAccessModes();
        $this->assertEquals(['textual', 'visual'], $accessModes);
    }

    public function testAddValidAccessMode(): void
    {
        $this->metadata->addAccessMode('auditory');
        
        $accessModes = $this->metadata->getAccessModes();
        $this->assertContains('auditory', $accessModes);
        $this->assertCount(3, $accessModes);
    }

    public function testAddInvalidAccessModeThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid access mode: invalid');
        
        $this->metadata->addAccessMode('invalid');
    }

    public function testValidAccessModes(): void
    {
        $validModes = ['textual', 'visual', 'auditory', 'tactile'];
        
        foreach ($validModes as $mode) {
            $this->metadata->clearAccessModes();
            $this->metadata->addAccessMode($mode);
            $this->assertTrue($this->metadata->hasAccessMode($mode));
        }
    }

    public function testSetAccessModesArray(): void
    {
        $accessModes = ['textual', 'auditory'];
        $this->metadata->setAccessModes($accessModes);
        
        $this->assertEquals($accessModes, $this->metadata->getAccessModes());
    }

    public function testAddDuplicateAccessMode(): void
    {
        $this->metadata->addAccessMode('textual'); // Already exists by default
        
        $accessModes = $this->metadata->getAccessModes();
        $textualCount = array_count_values($accessModes)['textual'];
        $this->assertEquals(1, $textualCount);
    }

    public function testHasAccessMode(): void
    {
        $this->assertTrue($this->metadata->hasAccessMode('textual'));
        $this->assertTrue($this->metadata->hasAccessMode('visual'));
        $this->assertFalse($this->metadata->hasAccessMode('auditory'));
        
        $this->metadata->addAccessMode('auditory');
        $this->assertTrue($this->metadata->hasAccessMode('auditory'));
    }

    public function testRemoveAccessMode(): void
    {
        $this->metadata->addAccessMode('auditory');
        $this->assertTrue($this->metadata->hasAccessMode('auditory'));
        
        $this->metadata->removeAccessMode('auditory');
        $this->assertFalse($this->metadata->hasAccessMode('auditory'));
    }

    public function testRemoveNonExistentAccessMode(): void
    {
        $originalModes = $this->metadata->getAccessModes();
        $this->metadata->removeAccessMode('tactile'); // Doesn't exist
        
        $this->assertEquals($originalModes, $this->metadata->getAccessModes());
    }

    public function testClearAccessModes(): void
    {
        $this->metadata->addAccessMode('auditory');
        $this->assertNotEmpty($this->metadata->getAccessModes());
        
        $this->metadata->clearAccessModes();
        $this->assertEmpty($this->metadata->getAccessModes());
    }

    public function testAccessModesArrayReindexing(): void
    {
        $this->metadata->setAccessModes(['textual', 'visual', 'auditory', 'tactile']);
        $this->metadata->removeAccessMode('visual');
        
        $accessModes = $this->metadata->getAccessModes();
        
        // Verificar que el array está correctamente reindexado
        $this->assertEquals(['textual', 'auditory', 'tactile'], $accessModes);
        $this->assertEquals(array_values($accessModes), $accessModes);
    }

    public function testFluentInterface(): void
    {
        $result = $this->metadata->addAccessMode('auditory')
                                 ->addAccessMode('tactile')
                                 ->removeAccessMode('visual');
        
        $this->assertInstanceOf(Metadata::class, $result);
        
        $accessModes = $this->metadata->getAccessModes();
        $this->assertContains('textual', $accessModes);
        $this->assertContains('auditory', $accessModes);
        $this->assertContains('tactile', $accessModes);
        $this->assertNotContains('visual', $accessModes);
    }

    public function testConstructorWithAccessModes(): void
    {
        $initialAccessModes = ['textual', 'auditory'];
        
        $metadata = new Metadata(
            'Test Book',
            'Test Author',
            'en',
            'Test Description',
            '', // isbn
            '', // publisher
            '', // publicationDate
            '', // cover
            '', // identifier
            [], // subjects
            $initialAccessModes // accessModes
        );
        
        $this->assertEquals($initialAccessModes, $metadata->getAccessModes());
    }

    public function testAccessModesWithAllValidTypes(): void
    {
        $allModes = ['textual', 'visual', 'auditory', 'tactile'];
        
        $this->metadata->setAccessModes($allModes);
        
        foreach ($allModes as $mode) {
            $this->assertTrue($this->metadata->hasAccessMode($mode));
        }
        
        $this->assertEquals($allModes, $this->metadata->getAccessModes());
    }

    public function testAccessModesImmutability(): void
    {
        $accessModes = $this->metadata->getAccessModes();
        $accessModes[] = 'modified'; // Try to modify returned array
        
        // Original should remain unchanged
        $this->assertNotContains('modified', $this->metadata->getAccessModes());
    }
}
