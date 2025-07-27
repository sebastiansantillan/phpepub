<?php

declare(strict_types=1);

namespace PHPEpub\Structure;

/**
 * Clase para manejar los metadatos del libro EPUB
 */
class Metadata
{
    private string $title = '';
    private string $author = '';
    private string $language = 'es';
    private string $description = '';
    private string $isbn = '';
    private string $publisher = '';
    private string $publicationDate = '';
    private string $cover = '';
    private string $identifier = '';

    public function __construct()
    {
        $this->identifier = uniqid('epub_');
        $this->publicationDate = date('Y-m-d\TH:i:s\Z');
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
}
