````markdown
# Security Policy

## Supported Versions

The following versions of PHPEpub currently receive security updates:

| Version | Supported          |
| ------- | ------------------ |
| 1.x.x   | :white_check_mark: |
| < 1.0   | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability, please DO NOT create a public issue. Instead:

### How to Report

1. **Email**: Send an email to security@phpebook.org with details
2. **Information to include**:
   - Detailed description of the vulnerability
   - Steps to reproduce the problem
   - Affected versions
   - Possible impact
   - Suggestions for fixing (if you have any)

### Response Process

1. **Confirmation** (24-48 hours): We'll confirm receipt of your report
2. **Initial assessment** (3-5 days): We'll evaluate the vulnerability and its impact
3. **Patch development** (1-2 weeks): We'll develop and test a fix
4. **Coordinated disclosure**: We'll work with you for responsible disclosure

### Our Commitments

- We'll respond to security reports within 48 hours
- We'll maintain confidentiality until a fix is published
- We'll keep you informed about progress
- We'll give you credit for the discovery (if you want it)

### What is NOT a Security Vulnerability

- Issues requiring physical access to the system
- Issues in unsupported versions
- Vulnerabilities in third-party dependencies (report directly to them)
- Usability issues without security implications

## Security Best Practices

### For Developers

When using PHPEpub:

1. **Input validation**: Always validate HTML content before adding it to chapters
2. **Sanitization**: Use `htmlspecialchars()` for untrusted content
3. **Source files**: Verify that images and CSS come from trusted sources
4. **Permissions**: Ensure EPUB files are generated with appropriate permissions

### Secure Example

```php
// ✅ Secure: sanitized content
$content = htmlspecialchars($userContent);
$epub->addChapter('Chapter', "<h1>{$content}</h1>");

// ❌ Insecure: unvalidated content
$epub->addChapter('Chapter', $userContent);
```

### For Library Users

1. Keep PHPEpub updated to the latest version
2. Don't process files from untrusted sources without validation
3. Regularly review security notes
4. Configure your environment with PHP best practices

## Security Updates

### Notifications

- Security updates are published in GitHub Releases
- Users can subscribe to repository notifications
- Critical changes are communicated through multiple channels

### Applying Updates

```bash
# Update to latest version
composer update sebastiansantillan/phpepub

# Check installed version
composer show sebastiansantillan/phpepub
```

## Security History

There are currently no known security vulnerabilities in PHPEpub.

## Contact

For security questions:
- Email: security@phpebook.org
- For other topics: Use GitHub Issues

## Acknowledgments

We thank security researchers who report vulnerabilities responsibly. Security contributors will be recognized in our Security Hall of Fame (when applicable).

---

This security policy may be updated occasionally. Significant changes will be communicated through our official channels.

````

## Actualizaciones de Seguridad

### Notificaciones

- Las actualizaciones de seguridad se publican en GitHub Releases
- Los usuarios pueden suscribirse a notificaciones del repositorio
- Los cambios críticos se comunican a través de múltiples canales

### Aplicar Actualizaciones

```bash
# Actualizar a la última versión
composer update sebastiansantillan/phpepub

# Verificar la versión instalada
composer show sebastiansantillan/phpepub
```

## Historial de Seguridad

Actualmente no hay vulnerabilidades de seguridad conocidas en PHPEpub.

## Contacto

Para preguntas sobre seguridad:
- Email: security@phpebook.org
- Para otros temas: Usa GitHub Issues

## Reconocimientos

Agradecemos a los investigadores de seguridad que reportan vulnerabilidades de manera responsable. Los contribuyentes de seguridad serán reconocidos en nuestro Hall of Fame de Seguridad (cuando aplique).

---

Esta política de seguridad puede actualizarse ocasionalmente. Los cambios significativos se comunicarán a través de nuestros canales oficiales.
