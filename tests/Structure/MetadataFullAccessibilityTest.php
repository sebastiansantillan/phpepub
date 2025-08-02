<?php

declare(strict_types=1);

namespace PHPEpub\Tests\Structure;

use PHPUnit\Framework\TestCase;
use PHPEpub\Structure\Metadata;

/**
 * Tests completos para todos los metadatos de accesibilidad EPUB Accessibility 1.1
 */
class MetadataFullAccessibilityTest extends TestCase
{
    private Metadata $metadata;

    protected function setUp(): void
    {
        $this->metadata = new Metadata();
    }

    // === Tests para Access Mode Sufficient ===

    public function testAccessModeSufficientCanBeSet(): void
    {
        $combinations = [['textual'], ['textual', 'visual']];
        $this->metadata->setAccessModeSufficient($combinations);
        $this->assertEquals($combinations, $this->metadata->getAccessModeSufficient());
    }

    public function testAccessModeSufficientCanBeAdded(): void
    {
        $this->metadata->addAccessModeSufficient(['textual'])
                       ->addAccessModeSufficient(['visual', 'auditory']);

        $expected = [['textual'], ['visual', 'auditory']];
        $this->assertEquals($expected, $this->metadata->getAccessModeSufficient());
    }

    public function testAccessModeSufficientValidatesInvalidModes(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid access mode in combination: invalid');
        
        $this->metadata->addAccessModeSufficient(['textual', 'invalid']);
    }

    public function testAccessModeSufficientCanBeCleared(): void
    {
        $this->metadata->addAccessModeSufficient(['textual']);
        $this->metadata->clearAccessModeSufficient();
        $this->assertEmpty($this->metadata->getAccessModeSufficient());
    }

    // === Tests para Accessibility Features ===

    public function testAccessibilityFeaturesCanBeSet(): void
    {
        $features = ['alternativeText', 'structuralNavigation'];
        $this->metadata->setAccessibilityFeatures($features);
        $this->assertEquals($features, $this->metadata->getAccessibilityFeatures());
    }

    public function testAccessibilityFeatureCanBeAdded(): void
    {
        $this->metadata->addAccessibilityFeature('alternativeText')
                       ->addAccessibilityFeature('tableOfContents');

        $this->assertEquals(['alternativeText', 'tableOfContents'], 
                          $this->metadata->getAccessibilityFeatures());
    }

    public function testAccessibilityFeatureValidatesInvalidFeature(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid accessibility feature: invalidFeature');
        
        $this->metadata->addAccessibilityFeature('invalidFeature');
    }

    public function testAccessibilityFeatureAcceptsValidFeatures(): void
    {
        $validFeatures = [
            'alternativeText', 'annotations', 'audioDescription', 'bookmarks',
            'braille', 'captions', 'ChemML', 'describedMath'
        ];

        foreach ($validFeatures as $feature) {
            $this->metadata->addAccessibilityFeature($feature);
        }

        $this->assertEquals($validFeatures, $this->metadata->getAccessibilityFeatures());
    }

    public function testAccessibilityFeatureCanBeRemoved(): void
    {
        $this->metadata->addAccessibilityFeature('alternativeText')
                       ->addAccessibilityFeature('tableOfContents')
                       ->removeAccessibilityFeature('alternativeText');

        $this->assertEquals(['tableOfContents'], $this->metadata->getAccessibilityFeatures());
    }

    public function testAccessibilityFeaturesCanBeCleared(): void
    {
        $this->metadata->addAccessibilityFeature('alternativeText');
        $this->metadata->clearAccessibilityFeatures();
        $this->assertEmpty($this->metadata->getAccessibilityFeatures());
    }

    public function testAccessibilityFeatureCanBeChecked(): void
    {
        $this->metadata->addAccessibilityFeature('alternativeText');
        $this->assertTrue($this->metadata->hasAccessibilityFeature('alternativeText'));
        $this->assertFalse($this->metadata->hasAccessibilityFeature('braille'));
    }

    // === Tests para Accessibility Hazards ===

    public function testAccessibilityHazardsCanBeSet(): void
    {
        $hazards = ['noFlashingHazard', 'noSoundHazard'];
        $this->metadata->setAccessibilityHazards($hazards);
        $this->assertEquals($hazards, $this->metadata->getAccessibilityHazards());
    }

    public function testAccessibilityHazardCanBeAdded(): void
    {
        $this->metadata->addAccessibilityHazard('noFlashingHazard')
                       ->addAccessibilityHazard('noMotionSimulationHazard');

        $this->assertEquals(['noFlashingHazard', 'noMotionSimulationHazard'], 
                          $this->metadata->getAccessibilityHazards());
    }

    public function testAccessibilityHazardValidatesInvalidHazard(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid accessibility hazard: invalidHazard');
        
        $this->metadata->addAccessibilityHazard('invalidHazard');
    }

    public function testAccessibilityHazardAcceptsValidHazards(): void
    {
        $validHazards = [
            'flashing', 'motionSimulation', 'sound', 'noFlashingHazard',
            'noMotionSimulationHazard', 'noSoundHazard', 'none', 'unknown'
        ];

        foreach ($validHazards as $hazard) {
            $this->metadata->addAccessibilityHazard($hazard);
        }

        $this->assertEquals($validHazards, $this->metadata->getAccessibilityHazards());
    }

    public function testAccessibilityHazardCanBeRemoved(): void
    {
        $this->metadata->addAccessibilityHazard('noFlashingHazard')
                       ->addAccessibilityHazard('noSoundHazard')
                       ->removeAccessibilityHazard('noFlashingHazard');

        $this->assertEquals(['noSoundHazard'], $this->metadata->getAccessibilityHazards());
    }

    public function testAccessibilityHazardsCanBeCleared(): void
    {
        $this->metadata->addAccessibilityHazard('noFlashingHazard');
        $this->metadata->clearAccessibilityHazards();
        $this->assertEmpty($this->metadata->getAccessibilityHazards());
    }

    public function testAccessibilityHazardCanBeChecked(): void
    {
        $this->metadata->addAccessibilityHazard('noFlashingHazard');
        $this->assertTrue($this->metadata->hasAccessibilityHazard('noFlashingHazard'));
        $this->assertFalse($this->metadata->hasAccessibilityHazard('flashing'));
    }

    // === Tests para Accessibility Summary ===

    public function testAccessibilitySummaryCanBeSet(): void
    {
        $summary = 'Este libro cumple con WCAG 2.1 Level AA';
        $this->metadata->setAccessibilitySummary($summary);
        $this->assertEquals($summary, $this->metadata->getAccessibilitySummary());
    }

    // === Tests para Certification Metadata ===

    public function testCertifiedByCanBeSet(): void
    {
        $certifiedBy = 'Editorial Inclusiva';
        $this->metadata->setCertifiedBy($certifiedBy);
        $this->assertEquals($certifiedBy, $this->metadata->getCertifiedBy());
    }

    public function testCertifierCredentialCanBeSet(): void
    {
        $credential = 'IAAP CPACC';
        $this->metadata->setCertifierCredential($credential);
        $this->assertEquals($credential, $this->metadata->getCertifierCredential());
    }

    public function testCertifierReportCanBeSet(): void
    {
        $report = 'https://example.com/report.html';
        $this->metadata->setCertifierReport($report);
        $this->assertEquals($report, $this->metadata->getCertifierReport());
    }

    // === Tests para Conforms To ===

    public function testConformsToCanBeSet(): void
    {
        $standards = ['EPUB Accessibility 1.1 - WCAG 2.1 Level AA'];
        $this->metadata->setConformsTo($standards);
        $this->assertEquals($standards, $this->metadata->getConformsTo());
    }

    public function testConformsToCanBeAdded(): void
    {
        $this->metadata->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
                       ->addConformsTo('https://www.w3.org/TR/WCAG21/');

        // El método ahora convierte automáticamente el texto a URLs
        $expected = [
            'http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa',
            'https://www.w3.org/TR/WCAG21/'
        ];
        $this->assertEquals($expected, $this->metadata->getConformsTo());
    }

    public function testConformsToAcceptsValidStandards(): void
    {
        $inputStandards = [
            'EPUB Accessibility 1.1 - WCAG 2.0 Level A',      // Convertido a URLs automáticamente
            'EPUB Accessibility 1.1 - WCAG 2.1 Level AA',     // Convertido a URLs automáticamente  
            'EPUB Accessibility 1.1 - WCAG 2.2 Level AAA'     // Convertido a URLs automáticamente
        ];

        foreach ($inputStandards as $standard) {
            $this->metadata->addConformsTo($standard);
        }

        // Ahora devuelve solo URLs válidas después de la conversión automática
        $expected = [
            'http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa',  // WCAG 2.0 Level A
            'https://www.w3.org/TR/WCAG21/',                             // WCAG 2.1 Level AA
            'https://www.w3.org/TR/WCAG22/'                              // WCAG 2.2 Level AAA
        ];
        $this->assertEquals($expected, $this->metadata->getConformsTo());
    }

    public function testConformsToAcceptsValidUrls(): void
    {
        $validUrls = [
            'https://www.w3.org/TR/WCAG21/',
            'https://example.com/accessibility-standard',
            'http://accessibility.org/standard'
        ];

        foreach ($validUrls as $url) {
            $this->metadata->addConformsTo($url);
        }

        $this->assertEquals($validUrls, $this->metadata->getConformsTo());
    }

    public function testConformsToValidatesInvalidStandard(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid standard: invalid-standard');
        
        $this->metadata->addConformsTo('invalid-standard');
    }

    public function testConformsToCanBeRemoved(): void
    {
        $this->metadata->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')
                       ->addConformsTo('https://www.w3.org/TR/WCAG21/')
                       ->removeConformsTo('http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa');

        // Solo debe quedar la URL que se añadió directamente
        $expected = [
            'https://www.w3.org/TR/WCAG21/'
        ];
        $this->assertEquals($expected, $this->metadata->getConformsTo());
    }

    public function testConformsToCanBeCleared(): void
    {
        $this->metadata->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');
        $this->metadata->clearConformsTo();
        $this->assertEmpty($this->metadata->getConformsTo());
    }

    public function testConformsToCanBeChecked(): void
    {
        $standard = 'EPUB Accessibility 1.1 - WCAG 2.1 Level AA';
        $this->metadata->addConformsTo($standard);
        
        // Ahora el método convierte a URLs, así que verificamos contra las URLs generadas
        $this->assertTrue($this->metadata->hasConformsTo('http://www.idpf.org/epub/a11y/accessibility.html#wcag-aa'));
        $this->assertTrue($this->metadata->hasConformsTo('https://www.w3.org/TR/WCAG21/'));
        $this->assertFalse($this->metadata->hasConformsTo('https://www.w3.org/TR/WCAG20/'));
    }

    // === Tests para Constructor con nuevos parámetros ===

    public function testConstructorWithAccessibilityParameters(): void
    {
        $metadata = new Metadata(
            title: 'Test Book',
            author: 'Test Author',
            accessModeSufficient: [['textual'], ['visual']],
            accessibilityFeatures: ['alternativeText', 'tableOfContents'],
            accessibilityHazards: ['noFlashingHazard'],
            accessibilitySummary: 'Fully accessible',
            certifiedBy: 'Test Certifier',
            certifierCredential: 'Test Credential',
            certifierReport: 'https://example.com/report',
            conformsTo: ['EPUB Accessibility 1.1 - WCAG 2.1 Level AA']
        );

        $this->assertEquals([['textual'], ['visual']], $metadata->getAccessModeSufficient());
        $this->assertEquals(['alternativeText', 'tableOfContents'], $metadata->getAccessibilityFeatures());
        $this->assertEquals(['noFlashingHazard'], $metadata->getAccessibilityHazards());
        $this->assertEquals('Fully accessible', $metadata->getAccessibilitySummary());
        $this->assertEquals('Test Certifier', $metadata->getCertifiedBy());
        $this->assertEquals('Test Credential', $metadata->getCertifierCredential());
        $this->assertEquals('https://example.com/report', $metadata->getCertifierReport());
        $this->assertEquals(['EPUB Accessibility 1.1 - WCAG 2.1 Level AA'], $metadata->getConformsTo());
    }

    // === Test de fluent interface ===

    public function testFluentInterfaceWithAllAccessibilityMethods(): void
    {
        $result = $this->metadata
            ->addAccessModeSufficient(['textual'])
            ->addAccessibilityFeature('alternativeText')
            ->addAccessibilityHazard('noFlashingHazard')
            ->setAccessibilitySummary('Test summary')
            ->setCertifiedBy('Test Certifier')
            ->setCertifierCredential('Test Credential')
            ->setCertifierReport('https://example.com/report')
            ->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA');

        $this->assertInstanceOf(Metadata::class, $result);
        $this->assertSame($this->metadata, $result);
    }
}
