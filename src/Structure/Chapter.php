<?php

declare(strict_types=1);

namespace PHPEpub\Structure;

/**
 * Clase para representar un capítulo del libro
 */
class Chapter
{
    private string $title;
    private string $content;
    private string $filename;
    private int $order;
    private static int $chapterCounter = 0;

    public function __construct(string $title, string $content, ?string $filename = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->filename = $filename ?? $this->generateFilename($title);
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

    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Genera el HTML completo del capítulo
     */
    public function getHtmlContent(): string
    {
        return sprintf(
            '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>%s</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
</head>
<body>
    %s
</body>
</html>',
            htmlspecialchars($this->title),
            $this->content
        );
    }

    /**
     * Genera un nombre de archivo válido basado en el título
     */
    private function generateFilename(string $title): string
    {
        $filename = preg_replace('/[^a-zA-Z0-9\s]/', '', $title);
        $filename = preg_replace('/\s+/', '_', trim($filename));
        $filename = strtolower($filename);
        
        if (empty($filename)) {
            $filename = 'chapter_' . $this->order;
        }
        
        return $filename . '.xhtml';
    }
}
