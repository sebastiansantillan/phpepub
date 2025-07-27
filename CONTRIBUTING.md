# Guía de Contribución

¡Gracias por tu interés en contribuir a PHPEpub! Esta guía te ayudará a empezar.

## Configuración del Entorno de Desarrollo

### Prerrequisitos

- PHP 7.4 o superior
- Composer
- Git

### Instalación

1. Fork el repositorio
2. Clona tu fork:
```bash
git clone https://github.com/sebastiansantillan/phpepub.git
cd phpepub
```

3. Instala las dependencias:
```bash
composer install
```

4. Ejecuta las pruebas para verificar que todo funciona:
```bash
composer test
```

## Flujo de Trabajo

### Branches

- `main`: Código estable y listo para producción
- `develop`: Código en desarrollo
- `feature/nombre-caracteristica`: Nuevas características
- `bugfix/descripcion-bug`: Correcciones de errores
- `hotfix/descripcion`: Correcciones urgentes para producción

### Proceso de Desarrollo

1. Crea una nueva rama desde `develop`:
```bash
git checkout develop
git pull origin develop
git checkout -b feature/mi-nueva-caracteristica
```

2. Desarrolla tu característica
3. Escribe pruebas para tu código
4. Ejecuta las pruebas y asegúrate de que pasen:
```bash
composer test
composer analyze
```

5. Commit tus cambios:
```bash
git add .
git commit -m "feat: agregar nueva característica"
```

6. Push a tu fork:
```bash
git push origin feature/mi-nueva-caracteristica
```

7. Crea un Pull Request hacia la rama `develop`

## Estándares de Código

### Estilo de Código

Seguimos PSR-12 para el estilo de código PHP:

- Indentación: 4 espacios
- Llaves de apertura en nueva línea para clases y métodos
- Llaves de apertura en la misma línea para estructuras de control
- Usar tipos estrictos: `declare(strict_types=1);`

### Documentación

- Todos los métodos públicos deben tener documentación PHPDoc
- Incluir tipos de parámetros y valores de retorno
- Describir el propósito del método
- Incluir ejemplos cuando sea apropiado

Ejemplo:
```php
/**
 * Establece el título del libro
 * 
 * @param string $title El título del libro
 * @return self Para permitir método encadenado
 * 
 * @throws EpubException Si el título está vacío
 * 
 * @example
 * $epub->setTitle('Mi Libro Increíble');
 */
public function setTitle(string $title): self
{
    // implementación
}
```

### Manejo de Errores

- Usa excepciones específicas (`EpubException`)
- Proporciona mensajes de error claros y útiles
- Valida parámetros de entrada
- Documenta las excepciones que pueden lanzarse

## Pruebas

### Escribir Pruebas

- Toda nueva funcionalidad debe incluir pruebas
- Las correcciones de errores deben incluir pruebas de regresión
- Apunta a una cobertura de código del 90%+

### Estructura de Pruebas

```php
<?php

namespace PHPEbook\Tests;

use PHPUnit\Framework\TestCase;

class MiClaseTest extends TestCase
{
    protected function setUp(): void
    {
        // Configuración antes de cada prueba
    }

    public function testMetodoBasico(): void
    {
        // Arrange (Preparar)
        $objeto = new MiClase();
        
        // Act (Actuar)
        $resultado = $objeto->metodo();
        
        // Assert (Verificar)
        $this->assertEquals('esperado', $resultado);
    }

    protected function tearDown(): void
    {
        // Limpieza después de cada prueba
    }
}
```

### Ejecutar Pruebas

```bash
# Todas las pruebas
composer test

# Pruebas específicas
vendor/bin/phpunit tests/EpubBuilderTest.php

# Con cobertura de código
vendor/bin/phpunit --coverage-html coverage
```

## Mensajes de Commit

Usa el formato Conventional Commits:

- `feat:` Nueva característica
- `fix:` Corrección de error
- `docs:` Cambios en documentación
- `style:` Cambios de formato (no afectan funcionalidad)
- `refactor:` Refactorización de código
- `test:` Agregar o modificar pruebas
- `chore:` Tareas de mantenimiento

Ejemplos:
```
feat: agregar soporte para imágenes SVG
fix: corregir generación de tabla de contenidos
docs: actualizar ejemplos en README
test: agregar pruebas para validación de metadatos
```

## Reportar Problemas

### Antes de Reportar

1. Busca en los issues existentes
2. Verifica que uses la versión más reciente
3. Intenta reproducir el problema

### Información a Incluir

- Versión de PHPEbook
- Versión de PHP
- Sistema operativo
- Código que reproduce el problema
- Mensaje de error completo
- Comportamiento esperado vs actual

### Plantilla de Issue

```markdown
## Descripción del Problema

Descripción clara del problema.

## Pasos para Reproducir

1. Paso 1
2. Paso 2
3. Ver error

## Comportamiento Esperado

Descripción de lo que debería pasar.

## Comportamiento Actual

Descripción de lo que pasa actualmente.

## Entorno

- PHPEbook: vX.X.X
- PHP: X.X.X
- SO: [Ubuntu 20.04 / Windows 10 / macOS Big Sur]

## Código de Ejemplo

```php
// Código que reproduce el problema
```

## Información Adicional

Cualquier información adicional relevante.
```

## Solicitar Características

### Antes de Solicitar

1. Verifica que no exista ya una solicitud similar
2. Considera si la característica encaja con los objetivos del proyecto
3. Piensa en casos de uso específicos

### Plantilla de Solicitud

```markdown
## Resumen de la Característica

Descripción breve de la característica propuesta.

## Motivación

¿Por qué esta característica sería útil?

## Solución Propuesta

Descripción detallada de cómo funcionaría.

## Alternativas Consideradas

Otras soluciones que has considerado.

## Casos de Uso

Ejemplos específicos de cómo se usaría.

## Código de Ejemplo

```php
// Ejemplo de cómo se usaría la nueva característica
```
```

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
