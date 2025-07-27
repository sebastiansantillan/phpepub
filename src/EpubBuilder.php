<?php

declare(strict_types=1);

namespace PHPEpub;

use PHPEpub\Exception\EpubException;
use PHPEpub\Structure\Chapter;
use PHPEpub\Structure\Metadata;
use PHPEpub\Generator\EpubGenerator;

/**
 * Clase principal para construir archivos EPUB
 */
class EpubBuilder
{
    private Metadata $metadata;
    private array $chapters = [];
    private array $images = [];
    private array $stylesheets = [];
    private EpubGenerator $generator;

    public function __construct()
    {
        $this->metadata = new Metadata();
        $this->generator = new EpubGenerator();
    }

    /**
     * Establece el título del libro
     */
    public function setTitle(string $title): self
    {
        $this->metadata->setTitle($title);
        return $this;
    }

    /**
     * Establece el autor del libro
     */
    public function setAuthor(string $author): self
    {
        $this->metadata->setAuthor($author);
        return $this;
    }

    /**
     * Establece el idioma del libro
     */
    public function setLanguage(string $language): self
    {
        $this->metadata->setLanguage($language);
        return $this;
    }

    /**
     * Establece la descripción del libro
     */
    public function setDescription(string $description): self
    {
        $this->metadata->setDescription($description);
        return $this;
    }

    /**
     * Establece el ISBN del libro
     */
    public function setIsbn(string $isbn): self
    {
        $this->metadata->setIsbn($isbn);
        return $this;
    }

    /**
     * Establece la imagen de portada
     */
    public function setCover(string $imagePath): self
    {
        if (!file_exists($imagePath)) {
            throw new EpubException("El archivo de imagen no existe: {$imagePath}");
        }
        
        $this->metadata->setCover($imagePath);
        return $this;
    }

    /**
     * Agrega un capítulo al libro
     */
    public function addChapter(string $title, string $content, ?string $filename = null): self
    {
        $chapter = new Chapter($title, $content, $filename);
        $this->chapters[] = $chapter;
        return $this;
    }

    /**
     * Agrega una imagen al libro
     */
    public function addImage(string $imagePath, ?string $id = null): self
    {
        if (!file_exists($imagePath)) {
            throw new EpubException("El archivo de imagen no existe: {$imagePath}");
        }

        $this->images[] = [
            'path' => $imagePath,
            'id' => $id ?? basename($imagePath)
        ];
        
        return $this;
    }

    /**
     * Agrega una hoja de estilos CSS
     */
    public function addStylesheet(string $cssPath, ?string $id = null): self
    {
        if (!file_exists($cssPath)) {
            throw new EpubException("El archivo CSS no existe: {$cssPath}");
        }

        $this->stylesheets[] = [
            'path' => $cssPath,
            'id' => $id ?? basename($cssPath)
        ];
        
        return $this;
    }

    /**
     * Guarda el archivo EPUB
     */
    public function save(string $filename): bool
    {
        if (empty($this->chapters)) {
            throw new EpubException("No se pueden generar libros sin capítulos");
        }

        if (empty($this->metadata->getTitle())) {
            throw new EpubException("El título es requerido");
        }

        return $this->generator->generate($filename, $this->metadata, $this->chapters, $this->images, $this->stylesheets);
    }

    /**
     * Obtiene los metadatos actuales
     */
    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    /**
     * Obtiene los capítulos actuales
     */
    public function getChapters(): array
    {
        return $this->chapters;
    }
}
