<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPEpub\Structure\Metadata;

class MetadataSubjectsTest extends TestCase
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

    public function testInitialSubjectsEmpty(): void
    {
        $this->assertEmpty($this->metadata->getSubjects());
    }

    public function testAddSingleSubject(): void
    {
        $this->metadata->addSubject('Programming');
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(1, $subjects);
        $this->assertContains('Programming', $subjects);
    }

    public function testAddMultipleSubjects(): void
    {
        $this->metadata->addSubject('Programming')
                       ->addSubject('PHP')
                       ->addSubject('Web Development');
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(3, $subjects);
        $this->assertContains('Programming', $subjects);
        $this->assertContains('PHP', $subjects);
        $this->assertContains('Web Development', $subjects);
    }

    public function testSetSubjectsArray(): void
    {
        $subjectsArray = ['PHP', 'Laravel', 'Symfony', 'MySQL'];
        $this->metadata->setSubjects($subjectsArray);
        
        $this->assertEquals($subjectsArray, $this->metadata->getSubjects());
    }

    public function testAddDuplicateSubject(): void
    {
        $this->metadata->addSubject('PHP')
                       ->addSubject('PHP'); // Duplicate
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(1, $subjects);
        $this->assertEquals(['PHP'], $subjects);
    }

    public function testHasSubject(): void
    {
        $this->metadata->addSubject('Programming');
        
        $this->assertTrue($this->metadata->hasSubject('Programming'));
        $this->assertFalse($this->metadata->hasSubject('Python'));
    }

    public function testRemoveSubject(): void
    {
        $this->metadata->addSubject('PHP')
                       ->addSubject('Laravel')
                       ->addSubject('Symfony');
        
        $this->metadata->removeSubject('Laravel');
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(2, $subjects);
        $this->assertContains('PHP', $subjects);
        $this->assertContains('Symfony', $subjects);
        $this->assertNotContains('Laravel', $subjects);
    }

    public function testRemoveNonExistentSubject(): void
    {
        $this->metadata->addSubject('PHP');
        $this->metadata->removeSubject('NonExistent');
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(1, $subjects);
        $this->assertContains('PHP', $subjects);
    }

    public function testClearSubjects(): void
    {
        $this->metadata->addSubject('PHP')
                       ->addSubject('Laravel')
                       ->addSubject('Symfony');
        
        $this->assertCount(3, $this->metadata->getSubjects());
        
        $this->metadata->clearSubjects();
        
        $this->assertEmpty($this->metadata->getSubjects());
    }

    public function testSubjectsArrayReindexing(): void
    {
        $this->metadata->setSubjects(['PHP', 'Laravel', 'Symfony', 'MySQL']);
        $this->metadata->removeSubject('Laravel');
        
        $subjects = $this->metadata->getSubjects();
        
        // Verificar que el array está correctamente reindexado
        $this->assertEquals(['PHP', 'Symfony', 'MySQL'], $subjects);
        $this->assertEquals(array_values($subjects), $subjects);
    }

    public function testFluentInterface(): void
    {
        $result = $this->metadata->addSubject('PHP')
                                 ->addSubject('Laravel')
                                 ->removeSubject('Laravel')
                                 ->addSubject('Symfony');
        
        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertEquals(['PHP', 'Symfony'], $this->metadata->getSubjects());
    }

    public function testConstructorWithSubjects(): void
    {
        $initialSubjects = ['Programming', 'PHP', 'Web Development'];
        
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
            $initialSubjects
        );
        
        $this->assertEquals($initialSubjects, $metadata->getSubjects());
    }

    public function testSubjectsWithSpecialCharacters(): void
    {
        $this->metadata->addSubject('Desarrollo Web')
                       ->addSubject('Programación')
                       ->addSubject('C++')
                       ->addSubject('Machine Learning & AI');
        
        $subjects = $this->metadata->getSubjects();
        $this->assertCount(4, $subjects);
        $this->assertContains('Desarrollo Web', $subjects);
        $this->assertContains('Programación', $subjects);
        $this->assertContains('C++', $subjects);
        $this->assertContains('Machine Learning & AI', $subjects);
    }
}
