````markdown
# Contributing Guide

Thank you for your interest in contributing to PHPEpub! This guide will help you get started.

## Development Environment Setup

### Prerequisites

- PHP 7.4 or higher
- Composer
- Git

### Installation

1. Fork the repository
2. Clone your fork:
```bash
git clone https://github.com/sebastiansantillan/phpepub.git
cd phpepub
```

3. Install dependencies:
```bash
composer install
```

4. Run tests to verify everything works:
```bash
composer test
```

## Workflow

### Branches

- `main`: Stable code ready for production
- `develop`: Development code
- `feature/feature-name`: New features
- `bugfix/bug-description`: Bug fixes
- `hotfix/description`: Urgent fixes for production

### Development Process

1. Create a new branch from `develop`:
```bash
git checkout develop
git pull origin develop
git checkout -b feature/my-new-feature
```

2. Develop your feature
3. Write tests for your code
4. Run tests and make sure they pass:
```bash
composer test
composer analyze
```

5. Commit your changes:
```bash
git add .
git commit -m "feat: add new feature"
```

6. Push to your fork:
```bash
git push origin feature/my-new-feature
```

7. Create a Pull Request to the `develop` branch

## Code Standards

### Code Style

We follow PSR-12 for PHP code style:

- Indentation: 4 spaces
- Opening braces on new line for classes and methods
- Opening braces on same line for control structures
- Use strict types: `declare(strict_types=1);`

### Documentation

- All public methods must have PHPDoc documentation
- Include parameter types and return values
- Describe the method's purpose
- Include examples when appropriate

Example:
```php
/**
 * Sets the book title
 * 
 * @param string $title The book title
 * @return self To allow method chaining
 * 
 * @throws EpubException If title is empty
 * 
 * @example
 * $epub->setTitle('My Amazing Book');
 */
public function setTitle(string $title): self
{
    // implementation
}
```

### Error Handling

- Use specific exceptions (`EpubException`)
- Provide clear and useful error messages
- Validate input parameters
- Document exceptions that can be thrown

## Testing

### Writing Tests

- All new functionality must include tests
- Bug fixes must include regression tests
- Aim for 90%+ code coverage

### Test Structure

```php
<?php

namespace PHPEbook\Tests;

use PHPUnit\Framework\TestCase;

class MyClassTest extends TestCase
{
    protected function setUp(): void
    {
        // Setup before each test
    }

    public function testBasicMethod(): void
    {
        // Arrange (Prepare)
        $object = new MyClass();
        
        // Act (Execute)
        $result = $object->method();
        
        // Assert (Verify)
        $this->assertEquals('expected', $result);
    }

    protected function tearDown(): void
    {
        // Cleanup after each test
    }
}
```

### Running Tests

```bash
# All tests
composer test

# Specific tests
vendor/bin/phpunit tests/EpubBuilderTest.php

# With code coverage
vendor/bin/phpunit --coverage-html coverage
```

## Commit Messages

Use the Conventional Commits format:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation changes
- `style:` Formatting changes (don't affect functionality)
- `refactor:` Code refactoring
- `test:` Add or modify tests
- `chore:` Maintenance tasks

Examples:
```
feat: add SVG image support
fix: correct table of contents generation
docs: update README examples
test: add metadata validation tests
```

## Reporting Issues

### Before Reporting

1. Search existing issues
2. Verify you're using the latest version
3. Try to reproduce the problem

### Information to Include

- PHPEbook version
- PHP version
- Operating system
- Code that reproduces the problem
- Complete error message
- Expected vs actual behavior

### Issue Template

```markdown
## Problem Description

Clear description of the problem.

## Steps to Reproduce

1. Step 1
2. Step 2
3. See error

## Expected Behavior

Description of what should happen.

## Actual Behavior

Description of what currently happens.

## Environment

- PHPEbook: vX.X.X
- PHP: X.X.X
- OS: [Ubuntu 20.04 / Windows 10 / macOS Big Sur]

## Example Code

```php
// Code that reproduces the problem
```

## Additional Information

Any other relevant information.
```

## Feature Requests

### Before Requesting

1. Check if a similar request already exists
2. Consider if the feature fits the project goals
3. Think about specific use cases

### Request Template

```markdown
## Feature Summary

Brief description of the proposed feature.

## Motivation

Why would this feature be useful?

## Proposed Solution

Detailed description of how it would work.

## Alternatives Considered

Other solutions you've considered.

## Use Cases

Specific examples of how it would be used.

## Example Code

```php
// Example of how the new feature would be used
```
```

## Review Process

### For Contributors

- Be patient: reviews can take time
- Respond to feedback constructively
- Keep your branch updated with `develop`

### For Reviewers

- Be constructive and kind in comments
- Focus on the code, not the person
- Provide specific suggestions
- Acknowledge good contributions

## Release Process

### Pre-release Checklist

Before creating a new release, ensure:

1. **Code Quality**:
   ```bash
   composer quality  # Runs validation, syntax check, analysis, and tests
   ```

2. **Documentation Updated**:
   - [ ] CHANGELOG.md updated with new changes
   - [ ] README.md reflects current functionality
   - [ ] docs/ updated if needed
   - [ ] Release notes prepared in docs/releases/

3. **Examples Working**:
   ```bash
   composer examples  # Test example scripts
   ```

4. **Version Compatibility**:
   - [ ] PHP version requirements verified
   - [ ] Dependencies up to date
   - [ ] Backward compatibility maintained (for stable versions)

### Creating a Release

1. **Prepare the release**:
   ```bash
   git checkout main
   git pull origin main
   ```

2. **Update version references**:
   - Update badges in README.md if needed
   - Update installation instructions
   - Create release notes in docs/releases/vX.X.X.md

3. **Commit and tag**:
   ```bash
   git add .
   git commit -m "chore: prepare release vX.X.X"
   git tag -a vX.X.X -m "Release vX.X.X"
   git push origin main --tags
   ```

4. **Post-release**:
   - Create GitHub release from tag
   - Update Packagist (automatic via webhook)
   - Announce in relevant channels

## Acknowledgments

All contributors will be recognized in:

- `CONTRIBUTORS.md` file
- Release notes
- Project documentation

## Questions

If you have questions about contributing:

1. Review this guide
2. Search existing issues
3. Create a new issue with the "question" label
4. Contact maintainers

Thank you for contributing to PHPEpub! 🎉

````

## Proceso de Revisión

### Para Contribuyentes

- Sé paciente: las revisiones pueden tomar tiempo
- Responde a los comentarios de manera constructiva
- Mantén tu rama actualizada con `develop`

### Para Revisores

- Sé constructivo y amable en los comentarios
- Enfócate en el código, no en la persona
- Proporciona sugerencias específicas
- Reconoce las buenas contribuciones

## Reconocimientos

Todos los contribuyentes serán reconocidos en:

- Archivo `CONTRIBUTORS.md`
- Releases notes
- Documentación del proyecto

## Preguntas

Si tienes preguntas sobre cómo contribuir:

1. Revisa esta guía
2. Busca en los issues existentes
3. Crea un nuevo issue con la etiqueta "question"
4. Contacta a los mantenedores

¡Gracias por contribuir a PHPEpub! 🎉
