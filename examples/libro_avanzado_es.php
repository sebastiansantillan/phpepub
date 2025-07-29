<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPEpub\EpubBuilder;

try {
    // Crear una nueva instancia del constructor de EPUB
    $epub = new EpubBuilder();

    // Configurar metadatos completos
    $epub->setTitle('Guía Completa de Desarrollo Web Moderno')
         ->setAuthor('María Elena Rodríguez')
         ->setLanguage('es')
         ->setDescription('Una guía exhaustiva sobre las últimas tendencias y tecnologías en desarrollo web, desde HTML5 hasta frameworks modernos de JavaScript.')
         ->setIsbn('978-84-1234-567-8')
         ->addSubject('Desarrollo Web')
         ->addSubject('JavaScript')
         ->addSubject('HTML5')
         ->addSubject('CSS3')
         ->addSubject('Programación')
         ->addSubject('Frontend')
         ->addSubject('Tutorial');

    // Configurar metadatos adicionales
    $metadata = $epub->getMetadata();
    $metadata->setPublisher('Editorial TechnoLibros')
             ->setPublicationDate('2025-07-28T00:00:00Z');

    // Si tienes una imagen de portada personalizada
    // $epub->setCover(__DIR__ . '/assets/portada-desarrollo-web.jpg');

    // Agregar hoja de estilos personalizada para el libro
    // $epub->addStylesheet(__DIR__ . '/assets/estilos-libro.css', 'estilos-principales');

    // Capítulo 1: Introducción con contenido rico
    $epub->addChapter(
        'Introducción al Desarrollo Web Moderno',
        '<div class="capitulo-introduccion">
            <h1>Introducción al Desarrollo Web Moderno</h1>
            
            <div class="resumen-capitulo">
                <h2>🎯 Objetivos del Capítulo</h2>
                <ul>
                    <li>Comprender la evolución del desarrollo web</li>
                    <li>Identificar las tecnologías fundamentales</li>
                    <li>Establecer las bases para el aprendizaje avanzado</li>
                </ul>
            </div>

            <h2>El Panorama Actual</h2>
            <p>El desarrollo web ha evolucionado dramáticamente en los últimos años. Lo que comenzó como páginas estáticas simples se ha transformado en aplicaciones web complejas que rivalizan con software de escritorio tradicional.</p>

            <blockquote class="cita-importante">
                <p>"El futuro del desarrollo web está en la creación de experiencias inmersivas y accesibles que conecten a las personas de manera significativa."</p>
                <cite>— Tim Berners-Lee, Inventor de la World Wide Web</cite>
            </blockquote>

            <h2>Tecnologías Fundamentales</h2>
            <div class="tecnologias-grid">
                <div class="tecnologia">
                    <h3>🏗️ HTML5</h3>
                    <p>La estructura semántica moderna que define el contenido web.</p>
                </div>
                <div class="tecnologia">
                    <h3>🎨 CSS3</h3>
                    <p>Estilos avanzados con animaciones, grids y flexbox.</p>
                </div>
                <div class="tecnologia">
                    <h3>⚡ JavaScript ES6+</h3>
                    <p>Programación moderna del lado del cliente y servidor.</p>
                </div>
            </div>
        </div>',
        'introduccion.xhtml'
    );

    // Capítulo 2: HTML5 con ejemplos prácticos
    $epub->addChapter(
        'HTML5: Estructura Semántica Avanzada',
        '<div class="capitulo-html5">
            <h1>HTML5: Estructura Semántica Avanzada</h1>

            <h2>Elementos Semánticos Modernos</h2>
            <p>HTML5 introdujo elementos semánticos que mejoran la accesibilidad y el SEO:</p>

            <table class="tabla-elementos">
                <thead>
                    <tr>
                        <th>Elemento</th>
                        <th>Propósito</th>
                        <th>Ejemplo de Uso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>&lt;header&gt;</code></td>
                        <td>Encabezado de sección</td>
                        <td>Título principal y navegación</td>
                    </tr>
                    <tr>
                        <td><code>&lt;nav&gt;</code></td>
                        <td>Enlaces de navegación</td>
                        <td>Menú principal del sitio</td>
                    </tr>
                    <tr>
                        <td><code>&lt;main&gt;</code></td>
                        <td>Contenido principal</td>
                        <td>Área central de contenido</td>
                    </tr>
                    <tr>
                        <td><code>&lt;article&gt;</code></td>
                        <td>Contenido independiente</td>
                        <td>Post de blog o noticia</td>
                    </tr>
                    <tr>
                        <td><code>&lt;aside&gt;</code></td>
                        <td>Contenido relacionado</td>
                        <td>Barra lateral con enlaces</td>
                    </tr>
                    <tr>
                        <td><code>&lt;footer&gt;</code></td>
                        <td>Pie de sección</td>
                        <td>Información de contacto</td>
                    </tr>
                </tbody>
            </table>

            <h2>APIs Modernas de HTML5</h2>
            <div class="apis-modernas">
                <h3>🌍 Geolocalización</h3>
                <pre><code>navigator.geolocation.getCurrentPosition(
    position =&gt; {
        console.log("Latitud:", position.coords.latitude);
        console.log("Longitud:", position.coords.longitude);
    }
);</code></pre>

                <h3>💾 Local Storage</h3>
                <pre><code>// Guardar datos
localStorage.setItem("usuario", "María");

// Recuperar datos
const usuario = localStorage.getItem("usuario");</code></pre>

                <h3>🎥 Canvas para Gráficos</h3>
                <pre><code>const canvas = document.getElementById("miCanvas");
const ctx = canvas.getContext("2d");
ctx.fillStyle = "#FF6B6B";
ctx.fillRect(10, 10, 100, 100);</code></pre>
            </div>

            <div class="ejercicio-practico">
                <h2>💡 Ejercicio Práctico</h2>
                <p><strong>Objetivo:</strong> Crear una página de portfolio personal utilizando elementos semánticos de HTML5.</p>
                <ol>
                    <li>Usar <code>&lt;header&gt;</code> para el nombre y título profesional</li>
                    <li>Implementar <code>&lt;nav&gt;</code> para navegación entre secciones</li>
                    <li>Utilizar <code>&lt;main&gt;</code> para el contenido principal</li>
                    <li>Crear <code>&lt;article&gt;</code> para cada proyecto</li>
                    <li>Agregar <code>&lt;aside&gt;</code> para habilidades técnicas</li>
                    <li>Finalizar con <code>&lt;footer&gt;</code> para información de contacto</li>
                </ol>
            </div>
        </div>'
    );

    // Capítulo 3: CSS3 avanzado
    $epub->addChapter(
        'CSS3: Diseño y Animaciones Modernas',
        '<div class="capitulo-css3">
            <h1>CSS3: Diseño y Animaciones Modernas</h1>

            <h2>Flexbox: Layout Flexible</h2>
            <p>Flexbox revolucionó la forma en que creamos layouts responsivos:</p>

            <div class="ejemplo-codigo">
                <h3>Contenedor Flex Básico</h3>
                <pre><code>.contenedor {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.elemento {
    flex: 1;
    padding: 15px;
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}</code></pre>
            </div>

            <h2>CSS Grid: Layouts Bidimensionales</h2>
            <div class="grid-ejemplo">
                <h3>Grid Layout Avanzado</h3>
                <pre><code>.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 20px;
    padding: 20px;
}

.grid-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}</code></pre>
            </div>

            <h2>Animaciones CSS Avanzadas</h2>
            <div class="animaciones-section">
                <h3>🎬 Keyframes y Transiciones</h3>
                <pre><code>@keyframes slideInFromLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.elemento-animado {
    animation: slideInFromLeft 0.6s ease-out;
    transition: transform 0.3s ease;
}

.elemento-animado:hover {
    transform: scale(1.05) rotate(2deg);
}</code></pre>

                <h3>🌈 Variables CSS Personalizadas</h3>
                <pre><code>:root {
    --color-primario: #3498db;
    --color-secundario: #e74c3c;
    --espaciado-base: 16px;
    --fuente-principal: "Roboto", sans-serif;
}

.boton {
    background-color: var(--color-primario);
    color: white;
    padding: var(--espaciado-base);
    font-family: var(--fuente-principal);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.boton:hover {
    background-color: var(--color-secundario);
}</code></pre>
            </div>

            <div class="mejores-practicas">
                <h2>✅ Mejores Prácticas CSS</h2>
                <ul>
                    <li><strong>Mobile First:</strong> Diseña para móviles primero, luego escala hacia arriba</li>
                    <li><strong>BEM Methodology:</strong> Usa Block__Element--Modifier para nombres de clases claros</li>
                    <li><strong>Performance:</strong> Minimiza el uso de selectores complejos</li>
                    <li><strong>Accesibilidad:</strong> Asegura contraste adecuado y navegación por teclado</li>
                    <li><strong>Consistencia:</strong> Mantén un sistema de diseño coherente</li>
                </ul>
            </div>
        </div>'
    );

    // Capítulo 4: JavaScript moderno
    $epub->addChapter(
        'JavaScript ES6+: Programación Moderna',
        '<div class="capitulo-javascript">
            <h1>JavaScript ES6+: Programación Moderna</h1>

            <h2>Sintaxis Moderna</h2>
            <div class="sintaxis-moderna">
                <h3>🏹 Arrow Functions</h3>
                <pre><code>// Función tradicional
function sumar(a, b) {
    return a + b;
}

// Arrow function
const sumar = (a, b) =&gt; a + b;

// Con más lógica
const procesarUsuarios = usuarios =&gt; {
    return usuarios
        .filter(user =&gt; user.activo)
        .map(user =&gt; ({
            ...user,
            nombreCompleto: `${user.nombre} ${user.apellido}`
        }));
};</code></pre>

                <h3>📦 Destructuring</h3>
                <pre><code>// Destructuring de objetos
const usuario = {
    nombre: "Ana",
    edad: 28,
    profesion: "Desarrolladora",
    ciudad: "Barcelona"
};

const { nombre, edad, profesion: trabajo } = usuario;

// Destructuring de arrays
const colores = ["rojo", "verde", "azul"];
const [primario, secundario, ...otros] = colores;

// En parámetros de función
const presentarUsuario = ({ nombre, edad, profesion }) =&gt; {
    return `${nombre} tiene ${edad} años y es ${profesion}`;
};</code></pre>

                <h3>📋 Template Literals</h3>
                <pre><code>const nombre = "Carlos";
const edad = 32;

// Template literal básico
const mensaje = `Hola ${nombre}, tienes ${edad} años`;

// Template literal multilinea
const email = `
    Estimado/a ${nombre},
    
    Nos complace informarte que tu aplicación ha sido
    procesada exitosamente.
    
    Saludos cordiales,
    El equipo de desarrollo
`;

// Con expresiones
const precio = 99.99;
const descuento = 0.15;
const mensajePrecio = `
    Precio original: $${precio}
    Descuento: ${(descuento * 100)}%
    Precio final: $${(precio * (1 - descuento)).toFixed(2)}
`;</code></pre>
            </div>

            <h2>Programación Asíncrona</h2>
            <div class="async-programming">
                <h3>🔄 Promises y Async/Await</h3>
                <pre><code>// Promise básica
const obtenerDatos = () =&gt; {
    return new Promise((resolve, reject) =&gt; {
        setTimeout(() =&gt; {
            const exito = Math.random() &gt; 0.3;
            if (exito) {
                resolve({ datos: "Información importante" });
            } else {
                reject(new Error("Error al obtener datos"));
            }
        }, 2000);
    });
};

// Usando async/await
const procesarDatos = async () =&gt; {
    try {
        console.log("Cargando datos...");
        const resultado = await obtenerDatos();
        console.log("Datos recibidos:", resultado.datos);
        return resultado;
    } catch (error) {
        console.error("Error:", error.message);
        throw error;
    }
};

// Múltiples operaciones asíncronas
const obtenerDatosCompletos = async () =&gt; {
    try {
        const [usuarios, productos, configuracion] = await Promise.all([
            fetch("/api/usuarios").then(r =&gt; r.json()),
            fetch("/api/productos").then(r =&gt; r.json()),
            fetch("/api/config").then(r =&gt; r.json())
        ]);
        
        return { usuarios, productos, configuracion };
    } catch (error) {
        console.error("Error obteniendo datos:", error);
    }
};</code></pre>
            </div>

            <h2>Módulos ES6</h2>
            <div class="modulos-es6">
                <h3>📤 Export/Import</h3>
                <pre><code>// utils.js - Exportaciones nombradas
export const formatearFecha = (fecha) =&gt; {
    return fecha.toLocaleDateString("es-ES");
};

export const validarEmail = (email) =&gt; {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
};

// Exportación por defecto
export default class Usuario {
    constructor(nombre, email) {
        this.nombre = nombre;
        this.email = email;
    }
    
    saludar() {
        return `Hola, soy ${this.nombre}`;
    }
}

// main.js - Importaciones
import Usuario, { formatearFecha, validarEmail } from "./utils.js";

const usuario = new Usuario("María", "maria@example.com");
console.log(usuario.saludar());

if (validarEmail(usuario.email)) {
    console.log("Email válido");
}</code></pre>
            </div>

            <div class="proyecto-final">
                <h2>🚀 Proyecto Final: Aplicación de Tareas</h2>
                <p><strong>Construye una aplicación completa de gestión de tareas usando todas las tecnologías aprendidas:</strong></p>
                
                <h3>Características Requeridas:</h3>
                <ul>
                    <li>✅ Agregar, editar y eliminar tareas</li>
                    <li>🏷️ Categorizar tareas por prioridad</li>
                    <li>🔍 Filtrar y buscar tareas</li>
                    <li>💾 Persistencia con localStorage</li>
                    <li>📱 Diseño responsive</li>
                    <li>🎨 Animaciones CSS</li>
                    <li>⚡ Carga asíncrona de datos</li>
                </ul>

                <h3>Tecnologías a Utilizar:</h3>
                <ul>
                    <li><strong>HTML5:</strong> Estructura semántica</li>
                    <li><strong>CSS3:</strong> Flexbox/Grid + animaciones</li>
                    <li><strong>JavaScript ES6+:</strong> Clases, módulos, async/await</li>
                </ul>
            </div>
        </div>'
    );

    // Capítulo de conclusión con recursos adicionales
    $epub->addChapter(
        'Conclusiones y Próximos Pasos',
        '<div class="capitulo-conclusion">
            <h1>Conclusiones y Próximos Pasos</h1>

            <div class="resumen-aprendizaje">
                <h2>🎓 Lo Que Has Aprendido</h2>
                <p>A lo largo de esta guía, has explorado:</p>
                <ul>
                    <li><strong>HTML5 Semántico:</strong> Estructura moderna y accesible</li>
                    <li><strong>CSS3 Avanzado:</strong> Layouts flexibles y animaciones</li>
                    <li><strong>JavaScript Moderno:</strong> ES6+ y programación asíncrona</li>
                    <li><strong>Mejores Prácticas:</strong> Código mantenible y eficiente</li>
                </ul>
            </div>

            <div class="proximos-pasos">
                <h2>🚀 Siguientes Tecnologías a Explorar</h2>
                
                <h3>Frontend Frameworks</h3>
                <ul>
                    <li><strong>React:</strong> Biblioteca para interfaces de usuario</li>
                    <li><strong>Vue.js:</strong> Framework progresivo</li>
                    <li><strong>Angular:</strong> Plataforma completa de desarrollo</li>
                </ul>

                <h3>Backend Technologies</h3>
                <ul>
                    <li><strong>Node.js:</strong> JavaScript del lado del servidor</li>
                    <li><strong>Express.js:</strong> Framework web minimalista</li>
                    <li><strong>MongoDB:</strong> Base de datos NoSQL</li>
                </ul>

                <h3>Herramientas de Desarrollo</h3>
                <ul>
                    <li><strong>Webpack:</strong> Bundler de módulos</li>
                    <li><strong>TypeScript:</strong> JavaScript tipado</li>
                    <li><strong>Jest:</strong> Framework de testing</li>
                </ul>
            </div>

            <div class="recursos-adicionales">
                <h2>📚 Recursos Recomendados</h2>
                
                <h3>Documentación Oficial</h3>
                <ul>
                    <li>MDN Web Docs - Referencia completa de tecnologías web</li>
                    <li>W3C Standards - Especificaciones oficiales</li>
                    <li>WHATWG - Living Standards para HTML</li>
                </ul>

                <h3>Comunidades y Práctica</h3>
                <ul>
                    <li>GitHub - Código abierto y colaboración</li>
                    <li>Stack Overflow - Resolución de dudas</li>
                    <li>CodePen - Experimentos y prototipos</li>
                    <li>freeCodeCamp - Ejercicios prácticos</li>
                </ul>
            </div>

            <div class="mensaje-final">
                <h2>💬 Mensaje Final</h2>
                <blockquote>
                    <p>El desarrollo web es un campo en constante evolución. La clave del éxito no está en conocer todas las tecnologías, sino en mantener la curiosidad, practicar constantemente y nunca dejar de aprender.</p>
                    
                    <p>Recuerda: cada línea de código que escribes es una oportunidad para mejorar y crear algo significativo. ¡El mundo digital está esperando tus ideas!</p>
                </blockquote>
                
                <div class="autor-info">
                    <p><strong>¡Felicidades por completar esta guía!</strong></p>
                    <p>Ahora tienes las bases sólidas para construir aplicaciones web modernas y eficientes.</p>
                </div>
            </div>
        </div>'
    );

    // Generar el archivo EPUB
    $filename = 'guia-desarrollo-web-moderno.epub';
    
    echo "📚 Generando libro: {$filename}\n";
    echo "⏳ Procesando contenido...\n\n";
    
    if ($epub->save($filename)) {
        echo "✅ ¡Libro generado exitosamente!\n\n";
        
        // Mostrar información del libro generado
        $metadata = $epub->getMetadata();
        echo "📖 Información del libro:\n";
        echo "   📝 Título: " . $metadata->getTitle() . "\n";
        echo "   👤 Autor: " . $metadata->getAuthor() . "\n";
        echo "   🌍 Idioma: " . $metadata->getLanguage() . "\n";
        echo "   📊 Capítulos: " . count($epub->getChapters()) . "\n";
        echo "   📅 Fecha: " . date('d/m/Y H:i:s') . "\n";
        echo "   📦 Archivo: {$filename}\n\n";
        
        echo "🎯 Características del libro:\n";
        echo "   ✨ Contenido completamente en español\n";
        echo "   📱 Ejemplos prácticos de código\n";
        echo "   🎨 Tablas y elementos formatados\n";
        echo "   💡 Ejercicios y proyectos prácticos\n";
        echo "   🔗 Referencias y recursos adicionales\n\n";
        
        echo "📖 Puedes abrir este archivo con:\n";
        echo "   • Cualquier lector de EPUB (Calibre, Adobe Digital Editions)\n";
        echo "   • Aplicaciones móviles (Google Play Books, Apple Books)\n";
        echo "   • Navegadores web con extensiones EPUB\n\n";
        
        echo "🎉 ¡Disfruta leyendo tu guía de desarrollo web!\n";
        
    } else {
        echo "❌ Error al generar el libro\n";
        echo "   Verifica que tengas permisos de escritura en el directorio\n";
    }

} catch (Exception $e) {
    echo "❌ Error durante la generación: " . $e->getMessage() . "\n";
    echo "   Línea: " . $e->getLine() . "\n";
    echo "   Archivo: " . $e->getFile() . "\n";
}
