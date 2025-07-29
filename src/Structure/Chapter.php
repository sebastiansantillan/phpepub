<?php

declare(strict_types=1);

namespace PHPEpub\Structure;

/**
 * Clase para representar un capítulo del libro
 */
class Chapter
{
    private static int $chapterCounter = 0;
    private readonly int $order;

    public function __construct(
        private string $title,
        private string $content,
        private string $filename = ''
    ) {
        $this->filename = $filename ?: $this->generateFilename($title);
        $this->order = ++self::$chapterCounter;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Genera el HTML completo del capítulo
     */
    public function getHtmlContent(string $language = 'en'): string
    {
        return sprintf(
            '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="%s" lang="%s">
<head>
    <title>%s</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
</head>
<body>
    %s
</body>
</html>',
            htmlspecialchars($language),
            htmlspecialchars($language),
            htmlspecialchars($this->title),
            $this->content
        );
    }

    /**
     * Genera un nombre de archivo válido basado en el título
     */
    private function generateFilename(string $title): string
    {
        // Normalizar caracteres con acentos a sus equivalentes sin acentos
        $filename = $this->removeAccents($title);
        
        // Remover caracteres especiales (mantener solo letras, números y espacios)
        $filename = preg_replace('/[^a-zA-Z0-9\s]/', '', $filename);
        
        // Reemplazar espacios múltiples con uno solo y luego convertir a guiones bajos
        $filename = preg_replace('/\s+/', '_', trim($filename));
        
        // Convertir a minúsculas
        $filename = strtolower($filename);
        
        // Si el filename queda vacío, usar un nombre por defecto
        if (empty($filename)) {
            $filename = 'chapter_' . $this->order;
        }
        
        return $filename . '.xhtml';
    }

    /**
     * Convierte caracteres con acentos a sus equivalentes sin acentos
     */
    private function removeAccents(string $text): string
    {
        // Mapa de caracteres con acentos a sin acentos
        $accentMap = [
            // Vocales con acentos
            'á' => 'a', 'à' => 'a', 'ä' => 'a', 'â' => 'a', 'ā' => 'a', 'ã' => 'a',
            'é' => 'e', 'è' => 'e', 'ë' => 'e', 'ê' => 'e', 'ē' => 'e',
            'í' => 'i', 'ì' => 'i', 'ï' => 'i', 'î' => 'i', 'ī' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ö' => 'o', 'ô' => 'o', 'ō' => 'o', 'õ' => 'o',
            'ú' => 'u', 'ù' => 'u', 'ü' => 'u', 'û' => 'u', 'ū' => 'u',
            
            // Vocales mayúsculas con acentos
            'Á' => 'A', 'À' => 'A', 'Ä' => 'A', 'Â' => 'A', 'Ā' => 'A', 'Ã' => 'A',
            'É' => 'E', 'È' => 'E', 'Ë' => 'E', 'Ê' => 'E', 'Ē' => 'E',
            'Í' => 'I', 'Ì' => 'I', 'Ï' => 'I', 'Î' => 'I', 'Ī' => 'I',
            'Ó' => 'O', 'Ò' => 'O', 'Ö' => 'O', 'Ô' => 'O', 'Ō' => 'O', 'Õ' => 'O',
            'Ú' => 'U', 'Ù' => 'U', 'Ü' => 'U', 'Û' => 'U', 'Ū' => 'U',
            
            // Caracteres especiales del español
            'ñ' => 'n', 'Ñ' => 'N',
            'ç' => 'c', 'Ç' => 'C',
            
            // Otros caracteres europeos comunes
            'ø' => 'o', 'Ø' => 'O',
            'å' => 'a', 'Å' => 'A',
            'æ' => 'ae', 'Æ' => 'AE',
            'œ' => 'oe', 'Œ' => 'OE',
            'ß' => 'ss',
            
            // Caracteres con diéresis
            'ÿ' => 'y', 'Ÿ' => 'Y'
        ];
        
        return strtr($text, $accentMap);
    }
}
