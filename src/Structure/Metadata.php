<?php

declare(strict_types=1);

namespace PHPEpub\Structure;

/**
 * Clase para manejar los metadatos del libro EPUB
 */
class Metadata
{
    public function __construct(
        private string $title = '',
        private string $author = '',
        private string $language = 'es',
        private string $description = '',
        private string $isbn = '',
        private string $publisher = '',
        private string $publicationDate = '',
        private string $cover = '',
        private string $identifier = '',
        private array $subjects = [],
        private array $accessModes = ['textual', 'visual']
    ) {
        $this->identifier = $identifier ?: uniqid('epub_');
        $this->publicationDate = $publicationDate ?: date('Y-m-d\TH:i:s\Z');
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;
        return $this;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function setPublicationDate(string $date): self
    {
        $this->publicationDate = $date;
        return $this;
    }

    public function getPublicationDate(): string
    {
        return $this->publicationDate;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;
        return $this;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function getSubjects(): array
    {
        return $this->subjects;
    }

    public function setSubjects(array $subjects): self
    {
        $this->subjects = $subjects;
        return $this;
    }

    public function addSubject(string $subject): self
    {
        if (!in_array($subject, $this->subjects)) {
            $this->subjects[] = $subject;
        }
        return $this;
    }

    public function removeSubject(string $subject): self
    {
        $this->subjects = array_filter($this->subjects, fn($s) => $s !== $subject);
        $this->subjects = array_values($this->subjects); // Reindexar el array
        return $this;
    }

    public function clearSubjects(): self
    {
        $this->subjects = [];
        return $this;
    }

    public function hasSubject(string $subject): bool
    {
        return in_array($subject, $this->subjects);
    }

    public function getAccessModes(): array
    {
        return $this->accessModes;
    }

    public function setAccessModes(array $accessModes): self
    {
        $this->accessModes = $accessModes;
        return $this;
    }

    public function addAccessMode(string $accessMode): self
    {
        $validModes = ['textual', 'visual', 'auditory', 'tactile'];
        
        if (!in_array($accessMode, $validModes)) {
            throw new \InvalidArgumentException(
                "Invalid access mode: {$accessMode}. Valid modes are: " . implode(', ', $validModes)
            );
        }
        
        if (!in_array($accessMode, $this->accessModes)) {
            $this->accessModes[] = $accessMode;
        }
        return $this;
    }

    public function removeAccessMode(string $accessMode): self
    {
        $this->accessModes = array_filter($this->accessModes, fn($mode) => $mode !== $accessMode);
        $this->accessModes = array_values($this->accessModes); // Reindexar el array
        return $this;
    }

    public function clearAccessModes(): self
    {
        $this->accessModes = [];
        return $this;
    }

    public function hasAccessMode(string $accessMode): bool
    {
        return in_array($accessMode, $this->accessModes);
    }
}
