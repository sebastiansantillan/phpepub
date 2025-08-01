<?php

declare(strict_types=1);

namespace PHPEpub\Generator;

use PHPEpub\Structure\Metadata;
use PHPEpub\Structure\Chapter;
use PHPEpub\Exception\EpubException;
use PHPEpub\Enum\ImageMimeType;
use ZipArchive;
use DOMDocument;

/**
 * Generador de archivos EPUB
 */
class EpubGenerator
{
    private const EPUB_VERSION = '3.0';
    private const MIMETYPE = 'application/epub+zip';

    /**
     * Genera el archivo EPUB
     */
    public function generate(string $filename, Metadata $metadata, array $chapters, array $images = [], array $stylesheets = []): bool
    {
        $zip = new ZipArchive();
        
        if ($zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new EpubException("No se pudo crear el archivo ZIP: {$filename}");
        }

        try {
            // Estructura básica EPUB
            $this->addMimetype($zip);
            $this->addContainer($zip);
            $this->addPackageDocument($zip, $metadata, $chapters, $images, $stylesheets);
            $this->addNavigationDocument($zip, $metadata, $chapters);
            $this->addChapters($zip, $metadata, $chapters);
            $this->addDefaultStylesheet($zip);
            $this->addImages($zip, $images);
            $this->addStylesheets($zip, $stylesheets);
            
            if ($metadata->getCover()) {
                $this->addCover($zip, $metadata->getCover());
            }

            $zip->close();
            return true;
        } catch (\Exception $e) {
            $zip->close();
            if (file_exists($filename)) {
                unlink($filename);
            }
            throw new EpubException("Error generando EPUB: " . $e->getMessage());
        }
    }

    private function addMimetype(ZipArchive $zip): void
    {
        $zip->addFromString('mimetype', self::MIMETYPE);
        $zip->setCompressionName('mimetype', ZipArchive::CM_STORE);
    }

    private function addContainer(ZipArchive $zip): void
    {
        $containerXml = '<?xml version="1.0" encoding="UTF-8"?>
<container version="1.0" xmlns="urn:oasis:names:tc:opendocument:xmlns:container">
    <rootfiles>
        <rootfile full-path="OEBPS/content.opf" media-type="application/oebps-package+xml"/>
    </rootfiles>
</container>';

        $zip->addFromString('META-INF/container.xml', $containerXml);
    }

    private function addPackageDocument(ZipArchive $zip, Metadata $metadata, array $chapters, array $images, array $stylesheets): void
    {
        $packageContent = $this->generatePackageDocument($metadata, $chapters, $images, $stylesheets);
        $zip->addFromString('OEBPS/content.opf', $packageContent);
    }

    private function generatePackageDocument(Metadata $metadata, array $chapters, array $images, array $stylesheets): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $package = $dom->createElement('package');
        $package->setAttribute('version', self::EPUB_VERSION);
        $package->setAttribute('xmlns', 'http://www.idpf.org/2007/opf');
        $package->setAttribute('unique-identifier', 'BookId');
        $package->setAttribute('xml:lang', $metadata->getLanguage());
        $dom->appendChild($package);

        // Metadata
        $metadataElement = $dom->createElement('metadata');
        $metadataElement->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
        $metadataElement->setAttribute('xmlns:opf', 'http://www.idpf.org/2007/opf');
        $metadataElement->setAttribute('xmlns:schema', 'http://schema.org/');
        $metadataElement->setAttribute('xmlns:a11y', 'http://www.idpf.org/epub/vocab/package/a11y/#');
        $metadataElement->setAttribute('xmlns:dcterms', 'http://purl.org/dc/terms/');
        $package->appendChild($metadataElement);

        $this->addMetadataElements($dom, $metadataElement, $metadata);

        // Manifest
        $manifest = $dom->createElement('manifest');
        $package->appendChild($manifest);

        $this->addManifestItems($dom, $manifest, $chapters, $images, $stylesheets);

        // Spine
        $spine = $dom->createElement('spine');
        $spine->setAttribute('toc', 'nav');
        $package->appendChild($spine);

        $this->addSpineItems($dom, $spine, $chapters);

        return $dom->saveXML();
    }

    private function addMetadataElements(DOMDocument $dom, \DOMElement $metadataElement, Metadata $metadata): void
    {
        // === ELEMENTOS BÁSICOS OBLIGATORIOS (DC Core) ===
        // Orden recomendado: title, language, identifier primero
        
        $title = $dom->createElement('dc:title', htmlspecialchars($metadata->getTitle()));
        $metadataElement->appendChild($title);

        $language = $dom->createElement('dc:language', $metadata->getLanguage());
        $metadataElement->appendChild($language);

        $identifier = $dom->createElement('dc:identifier', $metadata->getIdentifier());
        $identifier->setAttribute('id', 'BookId');
        $metadataElement->appendChild($identifier);

        // Meta elemento dcterms:modified (requerido por EPUB3)
        $modified = $dom->createElement('meta', date('Y-m-d\TH:i:s\Z'));
        $modified->setAttribute('property', 'dcterms:modified');
        $metadataElement->appendChild($modified);

        // === ELEMENTOS DUBLIN CORE OPCIONALES ===
        
        if ($metadata->getAuthor()) {
            $author = $dom->createElement('dc:creator', htmlspecialchars($metadata->getAuthor()));
            $metadataElement->appendChild($author);
        }

        if ($metadata->getDescription()) {
            $description = $dom->createElement('dc:description', htmlspecialchars($metadata->getDescription()));
            $metadataElement->appendChild($description);
        }

        if($metadata->getPublisher()) {
            $publisher = $dom->createElement('dc:publisher', htmlspecialchars($metadata->getPublisher()));
            $metadataElement->appendChild($publisher);
        }

        $date = $dom->createElement('dc:date', $metadata->getPublicationDate());
        $metadataElement->appendChild($date);

        // Subjects (materias/categorías)
        foreach ($metadata->getSubjects() as $subject) {
            $subjectElement = $dom->createElement('dc:subject', htmlspecialchars($subject));
            $metadataElement->appendChild($subjectElement);
        }

        // === METADATOS DE ACCESIBILIDAD SCHEMA.ORG ===
        
        // Access Modes (obligatorio)
        foreach ($metadata->getAccessModes() as $accessMode) {
            $accessModeElement = $dom->createElement('meta', $accessMode);
            $accessModeElement->setAttribute('property', 'schema:accessMode');
            $metadataElement->appendChild($accessModeElement);
        }

        // Access Mode Sufficient (recomendado) - usar solo la combinación más completa
        $accessModeSufficient = $metadata->getAccessModeSufficient();
        if (!empty($accessModeSufficient)) {
            // Encontrar la combinación más completa (la que tenga más modos)
            $mostComplete = [];
            foreach ($accessModeSufficient as $combination) {
                if (count($combination) > count($mostComplete)) {
                    $mostComplete = $combination;
                }
            }
            
            if (!empty($mostComplete)) {
                $accessModeSufficientElement = $dom->createElement('meta', implode(',', $mostComplete));
                $accessModeSufficientElement->setAttribute('property', 'schema:accessModeSufficient');
                $metadataElement->appendChild($accessModeSufficientElement);
            }
        }

        // Accessibility Features (obligatorio)
        foreach ($metadata->getAccessibilityFeatures() as $feature) {
            $accessibilityFeatureElement = $dom->createElement('meta', $feature);
            $accessibilityFeatureElement->setAttribute('property', 'schema:accessibilityFeature');
            $metadataElement->appendChild($accessibilityFeatureElement);
        }

        // Accessibility Hazards (obligatorio)
        foreach ($metadata->getAccessibilityHazards() as $hazard) {
            $accessibilityHazardElement = $dom->createElement('meta', $hazard);
            $accessibilityHazardElement->setAttribute('property', 'schema:accessibilityHazard');
            $metadataElement->appendChild($accessibilityHazardElement);
        }

        // Accessibility Summary (recomendado)
        if ($metadata->getAccessibilitySummary()) {
            $accessibilitySummaryElement = $dom->createElement('meta', htmlspecialchars($metadata->getAccessibilitySummary()));
            $accessibilitySummaryElement->setAttribute('property', 'schema:accessibilitySummary');
            $metadataElement->appendChild($accessibilitySummaryElement);
        }

        // === METADATOS DE CERTIFICACIÓN EPUB ACCESSIBILITY 1.1 ===
        
        if ($metadata->getCertifiedBy()) {
            $certifiedByElement = $dom->createElement('meta', htmlspecialchars($metadata->getCertifiedBy()));
            $certifiedByElement->setAttribute('property', 'a11y:certifiedBy');
            $metadataElement->appendChild($certifiedByElement);
        }

        if ($metadata->getCertifierCredential()) {
            $certifierCredentialElement = $dom->createElement('meta', htmlspecialchars($metadata->getCertifierCredential()));
            $certifierCredentialElement->setAttribute('property', 'a11y:certifierCredential');
            $metadataElement->appendChild($certifierCredentialElement);
        }

        if ($metadata->getCertifierReport()) {
            $certifierReportElement = $dom->createElement('meta', $metadata->getCertifierReport());
            $certifierReportElement->setAttribute('property', 'a11y:certifierReport');
            $metadataElement->appendChild($certifierReportElement);
        }

        // === METADATOS DE CUMPLIMIENTO (SOLO URLs VÁLIDAS) ===
        
        // Conforms To - solo URLs oficiales
        foreach ($metadata->getConformsTo() as $standard) {
            $conformsToElement = $dom->createElement('meta', $standard);
            $conformsToElement->setAttribute('property', 'dcterms:conformsTo');
            $metadataElement->appendChild($conformsToElement);
        }
    }

    private function addManifestItems(DOMDocument $dom, \DOMElement $manifest, array $chapters, array $images, array $stylesheets): void
    {
        // Navegación
        $navItem = $dom->createElement('item');
        $navItem->setAttribute('id', 'nav');
        $navItem->setAttribute('href', 'nav.xhtml');
        $navItem->setAttribute('media-type', 'application/xhtml+xml');
        $navItem->setAttribute('properties', 'nav');
        $manifest->appendChild($navItem);

        // CSS por defecto
        $cssItem = $dom->createElement('item');
        $cssItem->setAttribute('id', 'style');
        $cssItem->setAttribute('href', 'Styles/style.css');
        $cssItem->setAttribute('media-type', 'text/css');
        $manifest->appendChild($cssItem);

        // Capítulos
        foreach ($chapters as $index => $chapter) {
            $item = $dom->createElement('item');
            $item->setAttribute('id', 'chapter' . ($index + 1));
            $item->setAttribute('href', 'Text/' . $chapter->getFilename());
            $item->setAttribute('media-type', 'application/xhtml+xml');
            $manifest->appendChild($item);
        }

        // Imágenes
        foreach ($images as $image) {
            $item = $dom->createElement('item');
            $item->setAttribute('id', $image['id']);
            $item->setAttribute('href', 'Images/' . basename($image['path']));
            $item->setAttribute('media-type', $this->getImageMimeType($image['path']));
            $manifest->appendChild($item);
        }

        // Hojas de estilo adicionales
        foreach ($stylesheets as $stylesheet) {
            $item = $dom->createElement('item');
            $item->setAttribute('id', $stylesheet['id']);
            $item->setAttribute('href', 'Styles/' . basename($stylesheet['path']));
            $item->setAttribute('media-type', 'text/css');
            $manifest->appendChild($item);
        }
    }

    private function addSpineItems(DOMDocument $dom, \DOMElement $spine, array $chapters): void
    {
        foreach ($chapters as $index => $chapter) {
            $itemref = $dom->createElement('itemref');
            $itemref->setAttribute('idref', 'chapter' . ($index + 1));
            $spine->appendChild($itemref);
        }
    }

    private function addNavigationDocument(ZipArchive $zip, Metadata $metadata, array $chapters): void
    {
        $navContent = $this->generateNavigationDocument($metadata, $chapters);
        $zip->addFromString('OEBPS/nav.xhtml', $navContent);
    }

    private function generateNavigationDocument(Metadata $metadata, array $chapters): string
    {
        $linksHtml = '';
        foreach ($chapters as $chapter) {
            $title = htmlspecialchars($chapter->getTitle());
            $filename = $chapter->getFilename();
            $linksHtml .= "        <li><a href=\"Text/{$filename}\">{$title}</a></li>\n";
        }

        $language = $metadata->getLanguage();
        
        return '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:epub="http://www.idpf.org/2007/ops" xml:lang="' . $language . '" lang="' . $language . '">
<head>
    <title>Tabla de Contenidos</title>
</head>
<body>
    <nav epub:type="toc" id="toc">
        <h1>Tabla de Contenidos</h1>
        <ol>
' . $linksHtml . '        </ol>
    </nav>
</body>
</html>';
    }

    private function addChapters(ZipArchive $zip, Metadata $metadata, array $chapters): void
    {
        foreach ($chapters as $chapter) {
            $zip->addFromString('OEBPS/Text/' . $chapter->getFilename(), $chapter->getHtmlContent($metadata->getLanguage()));
        }
    }

    private function addDefaultStylesheet(ZipArchive $zip): void
    {
        $css = 'body {
    font-family: Georgia, serif;
    line-height: 1.6;
    margin: 1em;
    color: #333;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Helvetica Neue", Arial, sans-serif;
    color: #222;
    margin-top: 1.5em;
    margin-bottom: 0.5em;
}

h1 {
    font-size: 2em;
    border-bottom: 2px solid #333;
    padding-bottom: 0.3em;
}

h2 {
    font-size: 1.5em;
}

p {
    margin-bottom: 1em;
    text-align: justify;
}

blockquote {
    margin: 1em 2em;
    padding: 0.5em 1em;
    border-left: 3px solid #ccc;
    font-style: italic;
}

code {
    font-family: "Courier New", monospace;
    background-color: #f5f5f5;
    padding: 0.2em;
    border-radius: 3px;
}

pre {
    background-color: #f5f5f5;
    padding: 1em;
    border-radius: 5px;
    overflow-x: auto;
}

img {
    max-width: 100%;
    height: auto;
}';

        $zip->addFromString('OEBPS/Styles/style.css', $css);
    }

    private function addImages(ZipArchive $zip, array $images): void
    {
        foreach ($images as $image) {
            $zip->addFile($image['path'], 'OEBPS/Images/' . basename($image['path']));
        }
    }

    private function addStylesheets(ZipArchive $zip, array $stylesheets): void
    {
        foreach ($stylesheets as $stylesheet) {
            $zip->addFile($stylesheet['path'], 'OEBPS/Styles/' . basename($stylesheet['path']));
        }
    }

    private function addCover(ZipArchive $zip, string $coverPath): void
    {
        $zip->addFile($coverPath, 'OEBPS/Images/cover' . $this->getImageExtension($coverPath));
    }

    private function getImageMimeType(string $imagePath): string
    {
        $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        return ImageMimeType::fromExtension($extension)->value;
    }

    private function getImageExtension(string $imagePath): string
    {
        return '.' . strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
    }
}
