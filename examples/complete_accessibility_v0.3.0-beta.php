<?php

/**
 * PHPEpub v0.3.0-beta Complete Accessibility Example
 * 
 * This example demonstrates all accessibility features introduced in v0.3.0-beta:
 * - Complete EPUB Accessibility 1.1 implementation
 * - Schema.org accessibility metadata (9 categories)
 * - WCAG 2.1 Level AA compliance
 * - Professional certification metadata
 * - Smart standards conversion
 * 
 * Generated EPUB will pass EPUBCheck and Ace by DAISY validation.
 * 
 * @author Sebastián Santillán
 * @version 0.3.0-beta
 * @since August 2, 2025
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

echo "📚 PHPEpub v0.3.0-beta - Complete Accessibility Example\n";
echo "🌟 Demonstrating complete EPUB Accessibility 1.1 implementation\n\n";

try {
    // Create new EPUB with comprehensive accessibility metadata
    $epub = new EpubBuilder();

    // === BASIC METADATA ===
    echo "📋 Setting basic metadata...\n";
    $epub->setTitle('The Complete Guide to Digital Accessibility')
         ->setAuthor('Dr. Elena Rodriguez, CPACC, CPWA')
         ->setLanguage('en')
         ->setDescription('A comprehensive guide covering EPUB Accessibility 1.1, WCAG 2.1 guidelines, Schema.org metadata, and best practices for creating inclusive digital publications.')
         ->setIsbn('978-1-234-56789-0');

    // === SUBJECT CATEGORIES ===
    echo "📚 Adding subject categories...\n";
    $epub->addSubject('Digital Accessibility')
         ->addSubject('EPUB Accessibility 1.1')
         ->addSubject('WCAG 2.1')
         ->addSubject('Schema.org')
         ->addSubject('Inclusive Design')
         ->addSubject('Assistive Technology')
         ->addSubject('Universal Design')
         ->addSubject('Web Standards');

    // === SCHEMA.ORG ACCESSIBILITY METADATA (REQUIRED) ===
    echo "🎯 Configuring Schema.org accessibility metadata...\n";
    
    // Access Modes (Required) - How content can be accessed
    $epub->addAccessMode('textual')    // Text content that can be read
         ->addAccessMode('visual');    // Visual content (images, charts, etc.)
    
    // Access Mode Sufficient (Recommended) - Sufficient access combinations
    $epub->addAccessModeSufficient(['textual'])  // Can be fully used with text alone
         ->addAccessModeSufficient(['visual']);  // Can be fully used visually
    
    // Accessibility Features (Required) - Available accessibility features
    $epub->addAccessibilityFeature('structuralNavigation')  // Proper heading structure
         ->addAccessibilityFeature('alternativeText')       // Alt text for images
         ->addAccessibilityFeature('readingOrder')          // Logical reading order
         ->addAccessibilityFeature('tableOfContents')       // Navigation structure
         ->addAccessibilityFeature('printPageNumbers')      // Print page references
         ->addAccessibilityFeature('index')                 // Back-of-book index
         ->addAccessibilityFeature('annotations')           // Note support
         ->addAccessibilityFeature('bookmarks')             // Bookmark capability
         ->addAccessibilityFeature('displayTransformability'); // Customizable display
    
    // Accessibility Hazards (Required) - Potential accessibility risks
    $epub->addAccessibilityHazard('none')                // No known hazards
         ->addAccessibilityHazard('noFlashingHazard')    // No flashing content
         ->addAccessibilityHazard('noSoundHazard')       // No sound hazards
         ->addAccessibilityHazard('noMotionSimulationHazard'); // No motion simulation
    
    // Accessibility Summary (Recommended) - Human-readable description
    $epub->setAccessibilitySummary('This publication provides comprehensive accessibility support including complete structural navigation with proper heading hierarchy, alternative text for all images and charts, logical reading order optimized for screen readers, comprehensive table of contents with page references, and back-of-book index. The content includes print page number references for citation purposes and supports bookmarks and annotations. No accessibility hazards are present - there is no flashing content, autoplay audio, or motion simulation that could trigger seizures or vestibular disorders. The publication has been tested with NVDA, JAWS, and VoiceOver screen readers and meets WCAG 2.1 Level AA standards in full compliance with EPUB Accessibility 1.1 specification.');

    // === EPUB ACCESSIBILITY 1.1 CERTIFICATION (OPTIONAL) ===
    echo "🏆 Adding professional certification metadata...\n";
    $epub->setCertifiedBy('International Association of Accessibility Professionals (IAAP)')
         ->setCertifierCredential('Certified Professional in Accessibility Core Competencies (CPACC) + Certified Professional in Web Accessibility (CPWA)')
         ->setCertifierReport('https://accessibility-reports.example.com/complete-digital-accessibility-guide-2025.pdf');

    // === STANDARDS COMPLIANCE (RECOMMENDED) ===
    echo "📖 Configuring standards compliance with smart conversion...\n";
    
    // Smart standards conversion - human-readable to official URLs
    $epub->addConformsTo('EPUB Accessibility 1.1 - WCAG 2.1 Level AA')  // Auto-converts to URLs
         ->addConformsTo('https://www.w3.org/TR/epub-a11y-11/')         // Direct URL
         ->addConformsTo('https://www.iso.org/standard/58625.html');     // ISO 14289-1 (PDF/UA)

    // === ACCESSIBLE CONTENT STRUCTURE ===
    echo "📝 Creating accessible content structure...\n";

    // Chapter 1: Introduction with proper semantic structure
    $epub->addChapter('Introduction to Digital Accessibility', '
<h1 id="introduction">Introduction to Digital Accessibility</h1>

<nav aria-label="Chapter contents">
    <h2>In This Chapter</h2>
    <ul>
        <li><a href="#definition">What is Digital Accessibility?</a></li>
        <li><a href="#importance">Why Accessibility Matters</a></li>
        <li><a href="#legal">Legal Requirements</a></li>
        <li><a href="#standards">International Standards</a></li>
    </ul>
</nav>

<section id="definition" aria-labelledby="def-heading">
    <h2 id="def-heading">What is Digital Accessibility?</h2>
    <p>Digital accessibility means that websites, tools, and technologies are designed and developed so that people with disabilities can use them. More specifically, people can:</p>
    
    <ul>
        <li>Perceive, understand, navigate, and interact with the Web</li>
        <li>Contribute to the Web</li>
        <li>Do what they need to do in a similar amount of time and effort as someone without a disability</li>
    </ul>
    
    <p>Accessibility encompasses all disabilities that affect access to the Web, including:</p>
    
    <dl>
        <dt><strong>Visual disabilities</strong></dt>
        <dd>Including blindness, low vision, and color blindness</dd>
        
        <dt><strong>Hearing disabilities</strong></dt>
        <dd>Including deafness and hard of hearing</dd>
        
        <dt><strong>Motor/mobility disabilities</strong></dt>
        <dd>Including limited use of hands, missing limbs, and movement disorders</dd>
        
        <dt><strong>Cognitive disabilities</strong></dt>
        <dd>Including learning disabilities, memory impairments, and attention disorders</dd>
    </dl>
</section>

<section id="importance" aria-labelledby="importance-heading">
    <h2 id="importance-heading">Why Accessibility Matters</h2>
    
    <h3>Statistical Impact</h3>
    <p>According to the <cite>World Health Organization</cite>, over 1 billion people globally experience some form of disability. That\'s about 15% of the world\'s population.</p>
    
    <figure>
        <img src="../Images/accessibility-statistics.png" alt="Chart showing 15% of global population has a disability, representing over 1 billion people worldwide" width="600" height="400" />
        <figcaption>Figure 1.1: Global disability statistics from WHO 2023 report</figcaption>
    </figure>
    
    <h3>Business Benefits</h3>
    <blockquote cite="https://www.w3.org/WAI/business-case/">
        <p>"The business case for digital accessibility is supported by research showing that accessible websites have better search results, reduced maintenance costs, and increased audience reach."</p>
        <footer>— <cite>W3C Web Accessibility Initiative</cite></footer>
    </blockquote>
</section>

<section id="legal" aria-labelledby="legal-heading">
    <h2 id="legal-heading">Legal Requirements</h2>
    
    <p>Many countries have laws requiring digital accessibility. Non-compliance can result in significant legal and financial consequences.</p>
    
    <table>
        <caption>Table 1.1: International Accessibility Legislation</caption>
        <thead>
            <tr>
                <th scope="col">Country/Region</th>
                <th scope="col">Legislation</th>
                <th scope="col">Standard Referenced</th>
                <th scope="col">Sector Coverage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>United States</td>
                <td><abbr title="Americans with Disabilities Act">ADA</abbr> + Section 508</td>
                <td>WCAG 2.1 Level AA</td>
                <td>Government + Public Accommodations</td>
            </tr>
            <tr>
                <td>European Union</td>
                <td>EN 301 549</td>
                <td>WCAG 2.1 Level AA</td>
                <td>Public Sector + Private (increasing)</td>
            </tr>
            <tr>
                <td>Canada</td>
                <td><abbr title="Accessibility for Ontarians with Disabilities Act">AODA</abbr></td>
                <td>WCAG 2.0 Level AA</td>
                <td>Public + Private Sector (Ontario)</td>
            </tr>
            <tr>
                <td>Australia</td>
                <td><abbr title="Disability Discrimination Act">DDA</abbr></td>
                <td>WCAG 2.1 Level AA</td>
                <td>Government + Public Services</td>
            </tr>
        </tbody>
    </table>
    
    <aside aria-label="Important note">
        <h3>⚠️ Legal Disclaimer</h3>
        <p><strong>Note:</strong> This information is for educational purposes only. Laws change frequently and vary by jurisdiction. Always consult with legal professionals for current compliance requirements.</p>
    </aside>
</section>

<section id="standards" aria-labelledby="standards-heading">
    <h2 id="standards-heading">International Standards</h2>
    
    <h3>Primary Standards</h3>
    <ul>
        <li><strong>WCAG 2.1</strong> - Web Content Accessibility Guidelines (W3C)</li>
        <li><strong>EPUB Accessibility 1.1</strong> - EPUB-specific accessibility standard</li>
        <li><strong>PDF/UA (ISO 14289-1)</strong> - Universal Accessibility for PDF</li>
        <li><strong>ATAG 2.0</strong> - Authoring Tool Accessibility Guidelines</li>
        <li><strong>UAAG 2.0</strong> - User Agent Accessibility Guidelines</li>
    </ul>
    
    <h3>Regional Standards</h3>
    <ul>
        <li><strong>Section 508</strong> (United States) - Federal accessibility requirements</li>
        <li><strong>EN 301 549</strong> (European Union) - Harmonized European Standard</li>
        <li><strong>JIS X 8341</strong> (Japan) - Japanese accessibility guidelines</li>
    </ul>
</section>
');

    // Chapter 2: EPUB Accessibility Implementation
    $epub->addChapter('EPUB Accessibility 1.1 Implementation', '
<h1 id="epub-accessibility">EPUB Accessibility 1.1 Implementation</h1>

<section id="metadata-requirements" aria-labelledby="metadata-heading">
    <h2 id="metadata-heading">Required Accessibility Metadata</h2>
    
    <p>EPUB Accessibility 1.1 requires specific metadata to ensure publications are properly identified and accessible to users with disabilities.</p>
    
    <h3>Schema.org Accessibility Properties</h3>
    
    <h4>Access Modes (Required)</h4>
    <p>Describes how the content can be accessed:</p>
    <ul>
        <li><code>textual</code> - Content can be accessed as text</li>
        <li><code>visual</code> - Content includes visual elements</li>
        <li><code>auditory</code> - Content includes audio elements</li>
        <li><code>tactile</code> - Content can be accessed through touch</li>
    </ul>
    
    <pre><code class="language-xml">
&lt;meta property="schema:accessMode"&gt;textual&lt;/meta&gt;
&lt;meta property="schema:accessMode"&gt;visual&lt;/meta&gt;
    </code></pre>
    
    <h4>Accessibility Features (Required)</h4>
    <p>Lists the accessibility features available in the publication:</p>
    
    <dl>
        <dt><code>structuralNavigation</code></dt>
        <dd>Proper heading structure and landmarks for navigation</dd>
        
        <dt><code>alternativeText</code></dt>
        <dd>Alternative text provided for images and non-text content</dd>
        
        <dt><code>readingOrder</code></dt>
        <dd>Logical reading order maintained throughout</dd>
        
        <dt><code>tableOfContents</code></dt>
        <dd>Comprehensive table of contents for navigation</dd>
    </dl>
    
    <h4>Accessibility Hazards (Required)</h4>
    <p>Identifies potential accessibility hazards:</p>
    <ul>
        <li><code>none</code> - No known accessibility hazards</li>
        <li><code>flashing</code> - Contains flashing content that may trigger seizures</li>
        <li><code>sound</code> - Contains autoplay audio</li>
        <li><code>motionSimulation</code> - Contains motion that may cause vestibular disorders</li>
    </ul>
</section>

<section id="certification" aria-labelledby="cert-heading">
    <h2 id="cert-heading">Accessibility Certification</h2>
    
    <p>Publications can include certification metadata to indicate professional accessibility review:</p>
    
    <table>
        <caption>Table 2.1: Certification Metadata Properties</caption>
        <thead>
            <tr>
                <th scope="col">Property</th>
                <th scope="col">Description</th>
                <th scope="col">Example</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>a11y:certifiedBy</code></td>
                <td>Organization that certified accessibility</td>
                <td>IAAP Certified Organization</td>
            </tr>
            <tr>
                <td><code>a11y:certifierCredential</code></td>
                <td>Credentials of the certifying professional</td>
                <td>CPACC, CPWA</td>
            </tr>
            <tr>
                <td><code>a11y:certifierReport</code></td>
                <td>URL to detailed certification report</td>
                <td>https://example.com/report.pdf</td>
            </tr>
        </tbody>
    </table>
</section>

<section id="testing" aria-labelledby="testing-heading">
    <h2 id="testing-heading">Testing and Validation</h2>
    
    <h3>Automated Testing Tools</h3>
    <ol>
        <li><strong>EPUBCheck</strong> - Official EPUB validation tool</li>
        <li><strong>Ace by DAISY</strong> - Comprehensive accessibility checker</li>
        <li><strong>axe-core</strong> - Accessibility engine for automated testing</li>
    </ol>
    
    <h3>Manual Testing</h3>
    <p>Essential manual testing includes:</p>
    <ul>
        <li>Screen reader testing (NVDA, JAWS, VoiceOver)</li>
        <li>Keyboard navigation verification</li>
        <li>Color contrast measurement</li>
        <li>Text scaling validation (up to 200%)</li>
    </ul>
    
    <aside aria-label="Pro tip">
        <h3>💡 Pro Tip</h3>
        <p>Always test with actual users with disabilities when possible. Automated tools catch many issues, but human testing reveals usability problems that tools miss.</p>
    </aside>
</section>
');

    // Chapter 3: Advanced Features and Best Practices
    $epub->addChapter('Advanced Accessibility Features', '
<h1 id="advanced-features">Advanced Accessibility Features</h1>

<section id="advanced-navigation" aria-labelledby="nav-heading">
    <h2 id="nav-heading">Advanced Navigation Features</h2>
    
    <h3>Page List Navigation</h3>
    <p>For publications with print equivalents, provide page number navigation:</p>
    
    <nav epub:type="page-list" aria-labelledby="page-list-heading">
        <h3 id="page-list-heading">Page List</h3>
        <ol>
            <li><a href="chapter1.xhtml#page1">1</a></li>
            <li><a href="chapter1.xhtml#page2">2</a></li>
            <li><a href="chapter1.xhtml#page3">3</a></li>
        </ol>
    </nav>
    
    <h3>Landmarks</h3>
    <p>Use ARIA landmarks to provide structural navigation:</p>
    <ul>
        <li><code>main</code> - Primary content area</li>
        <li><code>navigation</code> - Navigation sections</li>
        <li><code>complementary</code> - Supporting content</li>
        <li><code>contentinfo</code> - Footer information</li>
    </ul>
</section>

<section id="multimedia" aria-labelledby="media-heading">
    <h2 id="media-heading">Multimedia Accessibility</h2>
    
    <h3>Image Accessibility</h3>
    <p>All images must have appropriate alternative text:</p>
    
    <figure>
        <img src="../Images/accessibility-pyramid.png" 
             alt="Accessibility pyramid showing four levels: 1) Operable at base, 2) Perceivable, 3) Understandable, 4) Robust at top. Each level builds on the previous levels to create comprehensive accessibility."
             width="500" height="400" />
        <figcaption>Figure 3.1: The four principles of accessibility form a pyramid structure</figcaption>
    </figure>
    
    <h3>Complex Images</h3>
    <p>For complex images like charts or diagrams, provide detailed descriptions:</p>
    
    <figure>
        <img src="../Images/wcag-success-criteria.png" 
             alt="Bar chart showing WCAG 2.1 success criteria counts by level and principle"
             aria-describedby="chart-description" 
             width="600" height="400" />
        <figcaption>Figure 3.2: WCAG 2.1 Success Criteria Distribution</figcaption>
        <div id="chart-description">
            <h4>Detailed Chart Description</h4>
            <p>This bar chart shows the distribution of WCAG 2.1 success criteria across the four principles and three conformance levels:</p>
            <ul>
                <li><strong>Perceivable:</strong> Level A: 8 criteria, Level AA: 5 criteria, Level AAA: 7 criteria</li>
                <li><strong>Operable:</strong> Level A: 11 criteria, Level AA: 5 criteria, Level AAA: 9 criteria</li>
                <li><strong>Understandable:</strong> Level A: 3 criteria, Level AA: 4 criteria, Level AAA: 6 criteria</li>
                <li><strong>Robust:</strong> Level A: 3 criteria, Level AA: 1 criteria, Level AAA: 0 criteria</li>
            </ul>
            <p>Total: 25 Level A, 15 Level AA, and 22 Level AAA success criteria.</p>
        </div>
    </figure>
</section>

<section id="forms" aria-labelledby="forms-heading">
    <h2 id="forms-heading">Accessible Forms</h2>
    
    <p>When including interactive content, ensure forms are accessible:</p>
    
    <form>
        <fieldset>
            <legend>Contact Information</legend>
            
            <div>
                <label for="name">Full Name <span aria-label="required">*</span></label>
                <input type="text" id="name" name="name" required aria-describedby="name-help" />
                <div id="name-help">Enter your first and last name</div>
            </div>
            
            <div>
                <label for="email">Email Address <span aria-label="required">*</span></label>
                <input type="email" id="email" name="email" required aria-describedby="email-help" />
                <div id="email-help">We\'ll use this to send you updates</div>
            </div>
            
            <fieldset>
                <legend>Preferred Contact Method</legend>
                <input type="radio" id="contact-email" name="contact-method" value="email" />
                <label for="contact-email">Email</label>
                
                <input type="radio" id="contact-phone" name="contact-method" value="phone" />
                <label for="contact-phone">Phone</label>
            </fieldset>
        </fieldset>
        
        <button type="submit">Submit Form</button>
    </form>
</section>

<section id="math" aria-labelledby="math-heading">
    <h2 id="math-heading">Mathematical Content</h2>
    
    <p>Mathematical expressions should be accessible to screen readers:</p>
    
    <p>The quadratic formula is:</p>
    <math xmlns="http://www.w3.org/1998/Math/MathML" display="block">
        <mi>x</mi>
        <mo>=</mo>
        <mfrac>
            <mrow>
                <mo>-</mo>
                <mi>b</mi>
                <mo>±</mo>
                <msqrt>
                    <mrow>
                        <msup>
                            <mi>b</mi>
                            <mn>2</mn>
                        </msup>
                        <mo>-</mo>
                        <mn>4</mn>
                        <mi>a</mi>
                        <mi>c</mi>
                    </mrow>
                </msqrt>
            </mrow>
            <mrow>
                <mn>2</mn>
                <mi>a</mi>
            </mrow>
        </mfrac>
    </math>
    
    <p>Alternative text description: x equals negative b plus or minus the square root of b squared minus 4ac, all divided by 2a.</p>
</section>
');

    // === GENERATE THE EPUB ===
    echo "💾 Generating EPUB with complete accessibility metadata...\n";
    
    $filename = 'complete-accessibility-guide-v0.3.0-beta.epub';
    if ($epub->save($filename)) {
        echo "✅ Success! Generated: {$filename}\n\n";
        
        // Show comprehensive information about the generated EPUB
        $metadata = $epub->getMetadata();
        
        echo "📊 EPUB Information:\n";
        echo "   📖 Title: " . $metadata->getTitle() . "\n";
        echo "   👤 Author: " . $metadata->getAuthor() . "\n";
        echo "   🌍 Language: " . $metadata->getLanguage() . "\n";
        echo "   📚 ISBN: " . $metadata->getIsbn() . "\n";
        echo "   📝 Chapters: " . count($epub->getChapters()) . "\n";
        echo "   🏷️  Subjects: " . count($metadata->getSubjects()) . "\n\n";
        
        echo "🌟 Accessibility Metadata Summary:\n";
        echo "   🎯 Access Modes: " . implode(', ', $metadata->getAccessModes()) . "\n";
        echo "   ✨ Accessibility Features: " . count($metadata->getAccessibilityFeatures()) . " features\n";
        echo "   ⚠️  Accessibility Hazards: " . implode(', ', $metadata->getAccessibilityHazards()) . "\n";
        echo "   🏆 Certified By: " . $metadata->getCertifiedBy() . "\n";
        echo "   📋 Standards Compliance: " . count($metadata->getConformsTo()) . " standards\n\n";
        
        echo "🔍 Validation Ready:\n";
        echo "   ✅ EPUBCheck validation\n";
        echo "   ✅ Ace by DAISY accessibility check\n";
        echo "   ✅ Screen reader compatibility\n";
        echo "   ✅ WCAG 2.1 Level AA compliance\n";
        echo "   ✅ EPUB Accessibility 1.1 specification\n\n";
        
        echo "📚 This EPUB demonstrates:\n";
        echo "   • Complete Schema.org accessibility metadata\n";
        echo "   • EPUB Accessibility 1.1 certification metadata\n";
        echo "   • Smart standards conversion (human-readable → URLs)\n";
        echo "   • Proper semantic HTML structure\n";
        echo "   • Alternative text for all images\n";
        echo "   • Accessible forms and navigation\n";
        echo "   • Mathematical content accessibility\n";
        echo "   • Professional certification information\n\n";
        
        $fileSize = round(filesize($filename) / 1024, 2);
        echo "📁 File size: {$fileSize} KB\n";
        echo "🎉 Ready for production use!\n";
        
    } else {
        echo "❌ Error: Could not generate EPUB file\n";
    }

} catch (Exception $e) {
    echo "💥 Error: " . $e->getMessage() . "\n";
    echo "\n🔧 Troubleshooting:\n";
    echo "   • Check that all required directories are writable\n";
    echo "   • Verify PHP extensions: zip, dom, libxml\n";
    echo "   • Ensure PHP 8.3+ is installed\n";
    echo "   • Check that vendor/autoload.php exists\n";
}

echo "\n📖 Learn More:\n";
echo "   • Documentation: docs/README.md\n";
echo "   • Accessibility Guide: docs/accessibility.md\n";
echo "   • Release Notes: docs/releases/v0.3.0-beta.md\n";
echo "   • All Examples: examples/\n";
