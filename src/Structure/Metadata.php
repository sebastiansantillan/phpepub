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
        private array $accessModes = ['textual', 'visual'],
        // Metadatos de accesibilidad EPUB Accessibility 1.1
        private array $accessModeSufficient = [],
        private array $accessibilityFeatures = [],
        private array $accessibilityHazards = [],
        private string $accessibilitySummary = '',
        private string $certifiedBy = '',
        private string $certifierCredential = '',
        private string $certifierReport = '',
        private array $conformsTo = []
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

    // === Metadatos de Accesibilidad EPUB Accessibility 1.1 ===

    /**
     * Access Mode Sufficient - Combinaciones suficientes de modos de acceso
     */
    public function getAccessModeSufficient(): array
    {
        return $this->accessModeSufficient;
    }

    public function setAccessModeSufficient(array $accessModeSufficient): self
    {
        $this->accessModeSufficient = $accessModeSufficient;
        return $this;
    }

    public function addAccessModeSufficient(array $modesCombination): self
    {
        $validModes = ['textual', 'visual', 'auditory', 'tactile'];
        
        foreach ($modesCombination as $mode) {
            if (!in_array($mode, $validModes)) {
                throw new \InvalidArgumentException(
                    "Invalid access mode in combination: {$mode}. Valid modes are: " . implode(', ', $validModes)
                );
            }
        }
        
        $this->accessModeSufficient[] = $modesCombination;
        return $this;
    }

    public function clearAccessModeSufficient(): self
    {
        $this->accessModeSufficient = [];
        return $this;
    }

    /**
     * Accessibility Features - Características de accesibilidad presentes
     */
    public function getAccessibilityFeatures(): array
    {
        return $this->accessibilityFeatures;
    }

    public function setAccessibilityFeatures(array $features): self
    {
        $this->accessibilityFeatures = $features;
        return $this;
    }

    public function addAccessibilityFeature(string $feature): self
    {
        $validFeatures = [
            'alternativeText', 'annotations', 'audioDescription', 'bookmarks',
            'braille', 'captions', 'ChemML', 'describedMath', 'displayTransformability',
            'highContrastAudio', 'highContrastDisplay', 'index', 'largePrint',
            'latex', 'longDescription', 'MathML', 'none', 'printPageNumbers',
            'readingOrder', 'rubyAnnotations', 'signLanguage', 'structuralNavigation',
            'synchronizedAudioText', 'tableOfContents', 'tactileGraphic',
            'tactileObject', 'timingControl', 'transcript', 'ttsMarkup',
            'unlocked'
        ];
        
        if (!in_array($feature, $validFeatures)) {
            throw new \InvalidArgumentException(
                "Invalid accessibility feature: {$feature}. Valid features include: alternativeText, annotations, audioDescription, bookmarks, braille, captions, etc."
            );
        }
        
        if (!in_array($feature, $this->accessibilityFeatures)) {
            $this->accessibilityFeatures[] = $feature;
        }
        return $this;
    }

    public function removeAccessibilityFeature(string $feature): self
    {
        $this->accessibilityFeatures = array_filter($this->accessibilityFeatures, fn($f) => $f !== $feature);
        $this->accessibilityFeatures = array_values($this->accessibilityFeatures);
        return $this;
    }

    public function clearAccessibilityFeatures(): self
    {
        $this->accessibilityFeatures = [];
        return $this;
    }

    public function hasAccessibilityFeature(string $feature): bool
    {
        return in_array($feature, $this->accessibilityFeatures);
    }

    /**
     * Accessibility Hazards - Riesgos de accesibilidad presentes
     */
    public function getAccessibilityHazards(): array
    {
        return $this->accessibilityHazards;
    }

    public function setAccessibilityHazards(array $hazards): self
    {
        $this->accessibilityHazards = $hazards;
        return $this;
    }

    public function addAccessibilityHazard(string $hazard): self
    {
        $validHazards = [
            'flashing', 'motionSimulation', 'sound', 'noFlashingHazard',
            'noMotionSimulationHazard', 'noSoundHazard', 'none', 'unknown'
        ];
        
        if (!in_array($hazard, $validHazards)) {
            throw new \InvalidArgumentException(
                "Invalid accessibility hazard: {$hazard}. Valid hazards are: " . implode(', ', $validHazards)
            );
        }
        
        if (!in_array($hazard, $this->accessibilityHazards)) {
            $this->accessibilityHazards[] = $hazard;
        }
        return $this;
    }

    public function removeAccessibilityHazard(string $hazard): self
    {
        $this->accessibilityHazards = array_filter($this->accessibilityHazards, fn($h) => $h !== $hazard);
        $this->accessibilityHazards = array_values($this->accessibilityHazards);
        return $this;
    }

    public function clearAccessibilityHazards(): self
    {
        $this->accessibilityHazards = [];
        return $this;
    }

    public function hasAccessibilityHazard(string $hazard): bool
    {
        return in_array($hazard, $this->accessibilityHazards);
    }

    /**
     * Accessibility Summary - Resumen de características de accesibilidad
     */
    public function getAccessibilitySummary(): string
    {
        return $this->accessibilitySummary;
    }

    public function setAccessibilitySummary(string $summary): self
    {
        $this->accessibilitySummary = $summary;
        return $this;
    }

    /**
     * Certified By - Organización que certifica la accesibilidad
     */
    public function getCertifiedBy(): string
    {
        return $this->certifiedBy;
    }

    public function setCertifiedBy(string $certifiedBy): self
    {
        $this->certifiedBy = $certifiedBy;
        return $this;
    }

    /**
     * Certifier Credential - Credenciales del certificador
     */
    public function getCertifierCredential(): string
    {
        return $this->certifierCredential;
    }

    public function setCertifierCredential(string $credential): self
    {
        $this->certifierCredential = $credential;
        return $this;
    }

    /**
     * Certifier Report - URL del reporte de certificación
     */
    public function getCertifierReport(): string
    {
        return $this->certifierReport;
    }

    public function setCertifierReport(string $report): self
    {
        $this->certifierReport = $report;
        return $this;
    }

    /**
     * Conforms To - Estándares de accesibilidad con los que cumple
     */
    public function getConformsTo(): array
    {
        return $this->conformsTo;
    }

    public function setConformsTo(array $standards): self
    {
        $this->conformsTo = $standards;
        return $this;
    }

    public function addConformsTo(string $standard): self
    {
        $validStandards = [
            'EPUB Accessibility 1.1 - WCAG 2.0 Level A',
            'EPUB Accessibility 1.1 - WCAG 2.0 Level AA',
            'EPUB Accessibility 1.1 - WCAG 2.0 Level AAA',
            'EPUB Accessibility 1.1 - WCAG 2.1 Level A',
            'EPUB Accessibility 1.1 - WCAG 2.1 Level AA',
            'EPUB Accessibility 1.1 - WCAG 2.1 Level AAA',
            'EPUB Accessibility 1.1 - WCAG 2.2 Level A',
            'EPUB Accessibility 1.1 - WCAG 2.2 Level AA',
            'EPUB Accessibility 1.1 - WCAG 2.2 Level AAA'
        ];
        
        // Permitir URLs personalizadas o estándares predefinidos
        if (!in_array($standard, $validStandards) && !filter_var($standard, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(
                "Invalid standard: {$standard}. Must be a valid URL or one of: " . implode(', ', array_slice($validStandards, 0, 3)) . ', etc.'
            );
        }
        
        if (!in_array($standard, $this->conformsTo)) {
            $this->conformsTo[] = $standard;
        }
        return $this;
    }

    public function removeConformsTo(string $standard): self
    {
        $this->conformsTo = array_filter($this->conformsTo, fn($s) => $s !== $standard);
        $this->conformsTo = array_values($this->conformsTo);
        return $this;
    }

    public function clearConformsTo(): self
    {
        $this->conformsTo = [];
        return $this;
    }

    public function hasConformsTo(string $standard): bool
    {
        return in_array($standard, $this->conformsTo);
    }
}
