#!/bin/bash

# Script de preparación para release v0.1.0-alpha
# Uso: ./prepare_release.sh

echo "🚀 Preparando PHPEpub v0.1.0-alpha para release..."
echo ""

# Verificar que estamos en el directorio correcto
if [ ! -f "composer.json" ]; then
    echo "❌ Error: No se encontró composer.json"
    echo "   Ejecuta este script desde la raíz del proyecto"
    exit 1
fi

# La versión se maneja con Git tags, no en composer.json
echo "✅ Preparando versión 0.1.0-alpha"
echo ""

# Validar estructura de archivos
echo "📁 Validando estructura de archivos..."

REQUIRED_FILES=(
    "src/EpubBuilder.php"
    "src/Exception/EpubException.php"
    "src/Generator/EpubGenerator.php"
    "src/Structure/Chapter.php"
    "src/Structure/Metadata.php"
    "src/Enum/ImageMimeType.php"
    "README.md"
    "CHANGELOG.md"
    "LICENSE"
    "composer.json"
)

MISSING_FILES=()
for file in "${REQUIRED_FILES[@]}"; do
    if [ ! -f "$file" ]; then
        MISSING_FILES+=("$file")
    fi
done

if [ ${#MISSING_FILES[@]} -ne 0 ]; then
    echo "❌ Archivos faltantes:"
    for file in "${MISSING_FILES[@]}"; do
        echo "   - $file"
    done
    exit 1
fi

echo "✅ Todos los archivos principales presentes"
echo ""

# Verificar sintaxis PHP
echo "🔍 Verificando sintaxis PHP..."

PHP_FILES=$(find src tests examples -name "*.php" 2>/dev/null || true)
SYNTAX_ERRORS=()

for file in $PHP_FILES; do
    if ! php -l "$file" > /dev/null 2>&1; then
        SYNTAX_ERRORS+=("$file")
    fi
done

if [ ${#SYNTAX_ERRORS[@]} -ne 0 ]; then
    echo "❌ Errores de sintaxis en:"
    for file in "${SYNTAX_ERRORS[@]}"; do
        echo "   - $file"
    done
    exit 1
fi

echo "✅ Sintaxis PHP válida en todos los archivos"
echo ""

# Verificar que Composer puede instalar dependencias
echo "📦 Verificando composer.json..."

if ! composer validate --no-check-all --strict > /dev/null 2>&1; then
    echo "❌ Error: composer.json no es válido"
    composer validate --no-check-all --strict
    exit 1
fi

echo "✅ composer.json válido"
echo ""

# Generar estadísticas del proyecto
echo "📊 Estadísticas del proyecto:"

# Contar archivos PHP
PHP_COUNT=$(find src -name "*.php" | wc -l)
TEST_COUNT=$(find tests -name "*.php" 2>/dev/null | wc -l || echo "0")
EXAMPLE_COUNT=$(find examples -name "*.php" 2>/dev/null | wc -l || echo "0")

echo "   - Archivos fuente: $PHP_COUNT"
echo "   - Archivos de test: $TEST_COUNT"
echo "   - Ejemplos: $EXAMPLE_COUNT"

# Contar líneas de código
TOTAL_LINES=$(find src -name "*.php" -exec wc -l {} \; | awk '{sum += $1} END {print sum}')
echo "   - Líneas de código (src/): $TOTAL_LINES"
echo ""

# Crear checklist para el release
echo "📋 Checklist para el release:"
echo ""
echo "Antes de crear el release, verifica:"
echo "   [ ] Tests pasan: composer test"
echo "   [ ] Análisis estático OK: composer analyze"
echo "   [ ] Documentación actualizada"
echo "   [ ] CHANGELOG.md actualizado"
echo "   [ ] Ejemplos funcionan correctamente"
echo "   [ ] README.md tiene toda la información necesaria"
echo ""

# Comandos sugeridos para testing
echo "🧪 Comandos de verificación recomendados:"
echo ""
echo "   # Instalar dependencias"
echo "   composer install"
echo ""
echo "   # Ejecutar tests (si están configurados)"
echo "   composer test 2>/dev/null || echo 'Tests no configurados aún'"
echo ""
echo "   # Análisis estático"
echo "   composer analyze 2>/dev/null || echo 'PHPStan no configurado aún'"
echo ""
echo "   # Probar ejemplos"
echo "   php examples/basic_example.php"
echo "   php examples/php83_example.php"
echo ""

# Información del tag Git
echo "🏷️  Para crear el release:"
echo ""
echo "   git add ."
echo "   git commit -m 'feat: release v0.1.0-alpha'"
echo "   git tag -a v0.1.0-alpha -m 'PHPEpub v0.1.0-alpha - Primera versión alpha'"
echo "   git push origin main --tags"
echo ""

echo "✅ PHPEpub v0.1.0-alpha listo para release!"
echo ""
echo "📝 Notas importantes:"
echo "   - Esta es una versión ALPHA experimental"
echo "   - No usar en producción"
echo "   - API puede cambiar en futuras versiones"
echo "   - Solicitar feedback de la comunidad"
echo ""
echo "🎉 ¡Éxito!"
