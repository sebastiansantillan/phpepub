<?php

declare(strict_types=1);

namespace PHPEpub\Enum;

/**
 * Enum para tipos MIME de imágenes soportadas
 */
enum ImageMimeType: string
{
    case JPEG = 'image/jpeg';
    case PNG = 'image/png';
    case GIF = 'image/gif';
    case SVG = 'image/svg+xml';
    case WEBP = 'image/webp';

    /**
     * Obtiene el tipo MIME basado en la extensión del archivo
     */
    public static function fromExtension(string $extension): self
    {
        return match (strtolower($extension)) {
            'jpg', 'jpeg' => self::JPEG,
            'png' => self::PNG,
            'gif' => self::GIF,
            'svg' => self::SVG,
            'webp' => self::WEBP,
            default => self::JPEG
        };
    }

    /**
     * Obtiene las extensiones válidas
     */
    public static function getValidExtensions(): array
    {
        return ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
    }

    /**
     * Verifica si una extensión es válida
     */
    public static function isValidExtension(string $extension): bool
    {
        return in_array(strtolower($extension), self::getValidExtensions(), strict: true);
    }
}
