<?php

declare(strict_types=1);

namespace PHPEpub\ValueObject;

use PHPEpub\Enum\ImageMimeType;

/**
 * Value Object para información de imagen
 */
readonly class ImageInfo
{
    public function __construct(
        public string $path,
        public string $id,
        public ImageMimeType $mimeType,
        public int $size
    ) {
    }

    /**
     * Crea una instancia desde un archivo
     */
    public static function fromFile(string $path, ?string $id = null): self
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("El archivo no existe: {$path}");
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        if (!ImageMimeType::isValidExtension($extension)) {
            $validExtensions = implode(', ', ImageMimeType::getValidExtensions());
            throw new \InvalidArgumentException("Formato no soportado: {$extension}. Válidos: {$validExtensions}");
        }

        return new self(
            path: $path,
            id: $id ?? basename($path),
            mimeType: ImageMimeType::fromExtension($extension),
            size: filesize($path) ?: 0
        );
    }

    /**
     * Obtiene el nombre base del archivo
     */
    public function getBasename(): string
    {
        return basename($this->path);
    }

    /**
     * Verifica si el archivo es válido
     */
    public function isValid(): bool
    {
        return file_exists($this->path) && $this->size > 0;
    }

    /**
     * Obtiene información formateada del tamaño
     */
    public function getFormattedSize(): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->size;
        $unitIndex = 0;

        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }

        return round($size, 2) . ' ' . $units[$unitIndex];
    }
}
