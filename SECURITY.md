# Security Policy

## Supported Versions

Las siguientes versiones de PHPEpub reciben actualmente actualizaciones de seguridad:

| Versión | Soportada          |
| ------- | ------------------ |
| 1.x.x   | :white_check_mark: |
| < 1.0   | :x:                |

## Reporting a Vulnerability

Si descubres una vulnerabilidad de seguridad, por favor NO crees un issue público. En su lugar:

### Cómo Reportar

1. **Email**: Envía un email a security@phpebook.org con los detalles
2. **Información a incluir**:
   - Descripción detallada de la vulnerabilidad
   - Pasos para reproducir el problema
   - Versiones afectadas
   - Posible impacto
   - Sugerencias para la corrección (si las tienes)

### Proceso de Respuesta

1. **Confirmación** (24-48 horas): Confirmaremos la recepción de tu reporte
2. **Evaluación inicial** (3-5 días): Evaluaremos la vulnerabilidad y su impacto
3. **Desarrollo de parche** (1-2 semanas): Desarrollaremos y probaremos una corrección
4. **Divulgación coordinada**: Trabajaremos contigo para una divulgación responsable

### Nuestros Compromisos

- Responderemos a los reportes de seguridad dentro de 48 horas
- Mantendremos la confidencialidad hasta que se publique una corrección
- Te mantendremos informado sobre el progreso
- Te daremos crédito por el descubrimiento (si lo deseas)

### Qué NO es una Vulnerabilidad de Seguridad

- Problemas que requieren acceso físico al sistema
- Problemas en versiones no soportadas
- Vulnerabilidades en dependencias de terceros (reporta directamente a ellos)
- Problemas de usabilidad que no tienen implicaciones de seguridad

## Buenas Prácticas de Seguridad

### Para Desarrolladores

Al usar PHPEpub:

1. **Validación de entrada**: Siempre valida el contenido HTML antes de agregarlo a capítulos
2. **Sanitización**: Usa `htmlspecialchars()` para contenido no confiable
3. **Archivos de origen**: Verifica que las imágenes y CSS provengan de fuentes confiables
4. **Permisos**: Asegúrate de que los archivos EPUB se generen con permisos apropiados

### Ejemplo Seguro

```php
// ✅ Seguro: contenido sanitizado
$contenido = htmlspecialchars($contenidoDelUsuario);
$epub->addChapter('Capítulo', "<h1>{$contenido}</h1>");

// ❌ Inseguro: contenido sin validar
$epub->addChapter('Capítulo', $contenidoDelUsuario);
```

### Para Usuarios de la Librería

1. Mantén PHPEpub actualizado a la última versión
2. No proceses archivos de fuentes no confiables sin validación
3. Revisa regularmente las notas de seguridad
4. Configura tu entorno con las mejores prácticas de PHP

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
