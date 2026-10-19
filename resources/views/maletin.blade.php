<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misael Adalid - Desarrollador & Profesor | Maletín Digital</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1e40af;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
            --border: #e5e7eb;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: #374151;
            background: #ffffff;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* HERO SECTION */
        .hero {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 auto 2rem;
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .hero h1 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .hero .subtitle {
            font-size: 1.3rem;
            color: var(--secondary);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .hero .location {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ABOUT SECTION */
        .section {
            padding: 4rem 0;
            border-bottom: 1px solid var(--border);
        }

        .section:last-child {
            border-bottom: none;
        }

        .section h2 {
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }

        .section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            margin-top: 3rem;
        }

        .about-text p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            line-height: 1.8;
            color: #4b5563;
        }

        .about-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.05), rgba(14, 165, 233, 0.05));
            padding: 2rem;
            border-radius: 1rem;
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.1);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* SKILLS */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .skill-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 2rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: default;
        }

        .skill-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.3);
        }

        /* PROJECTS SECTION */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .project-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--secondary);
        }

        .project-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .project-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .project-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .project-category {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .project-body {
            padding: 1.5rem;
        }

        .project-description {
            color: #6b7280;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tech-tag {
            background: #f0f9ff;
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .project-link {
            display: inline-block;
            color: var(--secondary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .project-link:hover {
            color: var(--primary);
            gap: 0.5rem;
        }

        /* ROLES SECTION */
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .role-card {
            background: linear-gradient(135deg, rgba(30, 64, 175, 0.05), rgba(14, 165, 233, 0.05));
            padding: 2rem;
            border-radius: 1rem;
            border-left: 4px solid var(--primary);
        }

        .role-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .role-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .role-subtitle {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .role-description {
            color: #6b7280;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* CTA SECTION */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem;
            border-radius: 1rem;
            text-align: center;
            margin: 3rem 0;
        }

        .cta-section h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .cta-section p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            opacity: 0.95;
        }

        .btn-white {
            background: white;
            color: var(--primary);
            padding: 0.8rem 2rem;
            font-weight: 700;
        }

        /* FOOTER */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            margin-bottom: 1rem;
        }

        .footer-section a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            margin-bottom: 0.5rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            text-align: center;
            color: #9ca3af;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .about-grid, .footer-content {
                grid-template-columns: 1fr;
            }

            .nav-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .section h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="header-content">
            <div class="logo">🚀 Maletín Digital</div>
            <div class="nav-buttons">
                <a href="{{ route('comercio.index') }}" class="btn btn-secondary">Ir al Negocio</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Ingresar como Admin</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <div class="avatar">M</div>
            <h1>Misael Adalid Carvajal</h1>
            <p class="subtitle">Profesor de Informática & Desarrollador de Software</p>
            <p class="location">📍 El Alto, Bolivia</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container">
        <!-- ABOUT SECTION -->
        <section class="section">
            <h2>Sobre Mí</h2>
            <div class="about-grid">
                <div class="about-text">
                    <p>Soy estudiante de la <strong>Carrera de Sistemas Informáticos</strong> en el Instituto Tecnológico "Bolivia Mar" (ITBM) y profesor de Computación en el mismo instituto, impartiendo clases a estudiantes de primaria (grados 3–6).</p>
                    
                    <p>Combino la enseñanza con el desarrollo de soluciones tecnológicas prácticas. Mi enfoque es crear herramientas que resuelvan problemas reales, desde sistemas de gestión de inventarios hasta plataformas de comercio electrónico.</p>
                    
                    <p>Especializado en arquitectura MVC, seguridad web (OWASP Top 10), metodologías ágiles y desarrollo bajo restricciones técnicas. Apasionado por la educación informática de calidad en contextos con recursos limitados.</p>
                </div>
                
                <div class="about-stats">
                    <div class="stat-card">
                        <div class="stat-number">4+</div>
                        <div class="stat-label">Años Enseñando</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Estudiantes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Proyectos Principales</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">7</div>
                        <div class="stat-label">Stack Tecnológicos</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ROLES SECTION -->
        <section class="section">
            <h2>Mi Rol</h2>
            <div class="roles-grid">
                <div class="role-card">
                    <div class="role-icon">👨‍🏫</div>
                    <div class="role-title">Profesor de Informática</div>
                    <div class="role-subtitle">Instituto Tecnológico "Bolivia Mar"</div>
                    <div class="role-description">Imparto clases de Computación/Técnica Tecnológica a grados 3–6 bajo el currículo del Ministerio de Educación (R.M. 1040/2022). Desarrollo materiales educativos y exámenes prácticos adaptados a cada nivel.</div>
                </div>
                
                <div class="role-card">
                    <div class="role-icon">💻</div>
                    <div class="role-title">Desarrollador de Software</div>
                    <div class="role-subtitle">Full Stack (Backend + Frontend)</div>
                    <div class="role-description">Desarrollo aplicaciones web con arquitectura MVC, enfoque en seguridad (OWASP Top 10), diseño escalable y experiencia de usuario. Especializado en Laravel + PHP + React.</div>
                </div>
                
                <div class="role-card">
                    <div class="role-icon">🔬</div>
                    <div class="role-title">Investigador Técnico</div>
                    <div class="role-subtitle">Seguridad & Sistemas</div>
                    <div class="role-description">Investigación académica en ransomware, backups inmutables y sistemas de gestión de activos tecnológicos (ITAM). Aplicación de metodologías científicas en soluciones tecnológicas.</div>
                </div>
            </div>
        </section>

        <!-- SKILLS SECTION -->
        <section class="section">
            <h2>Conocimientos Técnicos</h2>
            <div class="skills-grid">
                <div class="skill-badge">Laravel</div>
                <div class="skill-badge">PHP</div>
                <div class="skill-badge">React.js</div>
                <div class="skill-badge">Flutter</div>
                <div class="skill-badge">MySQL</div>
                <div class="skill-badge">PostgreSQL</div>
                <div class="skill-badge">Node.js</div>
                <div class="skill-badge">HTML/CSS</div>
                <div class="skill-badge">Git</div>
                <div class="skill-badge">Docker</div>
                <div class="skill-badge">XAMPP</div>
                <div class="skill-badge">Supabase</div>
            </div>
        </section>

        <!-- PROJECTS SECTION -->
        <section class="section">
            <h2>Proyectos Destacados</h2>
            <div class="projects-grid">
                <!-- SIGLAB-QR -->
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-icon">📊</div>
                        <div class="project-title">SIGLAB-QR</div>
                        <div class="project-category">Proyecto de Grado</div>
                    </div>
                    <div class="project-body">
                        <p class="project-description">
                            Sistema web y móvil de gestión de inventarios de activos tecnológicos basado en códigos QR. Implementación de PWA con autenticación RBAC, auditoría geográfica y reportes en tiempo real.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-tag">Flutter</span>
                            <span class="tech-tag">React.js</span>
                            <span class="tech-tag">PostgreSQL</span>
                            <span class="tech-tag">Supabase</span>
                            <span class="tech-tag">PWA</span>
                        </div>
                        <p style="font-size: 0.9rem; color: #9ca3af;">📌 Metodología: Investigación Aplicada + XP | Calidad: ISO/IEC 25010 | Seguridad: OWASP Top 10</p>
                    </div>
                </div>

                <!-- MALETÍN DIGITAL -->
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-icon">🛍️</div>
                        <div class="project-title">Maletín Digital</div>
                        <div class="project-category">E-commerce</div>
                    </div>
                    <div class="project-body">
                        <p class="project-description">
                            Plataforma de comercio electrónico integrada con portafolio profesional. Sistema de gestión de productos, carrito de compras, roles de usuario (Admin/Técnico/Invitado) y seguridad enterprise-grade.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-tag">Laravel</span>
                            <span class="tech-tag">PHP</span>
                            <span class="tech-tag">MySQL</span>
                            <span class="tech-tag">Blade</span>
                            <span class="tech-tag">XAMPP</span>
                        </div>
                        <a href="{{ route('comercio.index') }}" class="project-link">Ver comercio →</a>
                    </div>
                </div>

                <!-- INVESTIGACIÓN RANSOMWARE -->
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-icon">🔐</div>
                        <div class="project-title">Investigación Ransomware</div>
                        <div class="project-category">Seguridad</div>
                    </div>
                    <div class="project-body">
                        <p class="project-description">
                            Investigación académica sobre ransomware y estrategias de backup inmutable. Análisis de vectores de ataque, respuesta a incidentes y arquitecturas resilientes de backup.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-tag">Seguridad</span>
                            <span class="tech-tag">Backup</span>
                            <span class="tech-tag">Linux</span>
                            <span class="tech-tag">Investigación</span>
                        </div>
                    </div>
                </div>

                <!-- CURRÍCULO EDUCATIVO -->
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-icon">📚</div>
                        <div class="project-title">Currículo Educativo</div>
                        <div class="project-category">Docencia</div>
                    </div>
                    <div class="project-body">
                        <p class="project-description">
                            Desarrollo de materiales educativos para grados 3–6 bajo el currículo del Ministerio de Educación. Incluye guías PowerPoint, exámenes prácticos en Excel y actividades interactivas.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-tag">Excel 2013</span>
                            <span class="tech-tag">PowerPoint</span>
                            <span class="tech-tag">Word</span>
                            <span class="tech-tag">Diseño Pedagógico</span>
                        </div>
                    </div>
                </div>

                <!-- STACK TÉCNICO -->
                <div class="project-card">
                    <div class="project-header">
                        <div class="project-icon">⚙️</div>
                        <div class="project-title">Dominio Full Stack</div>
                        <div class="project-category">Expertise</div>
                    </div>
                    <div class="project-body">
                        <p class="project-description">
                            Experiencia comprobada en desarrollo full stack con arquitectura MVC, autenticación segura, validación de entrada/salida, rate limiting y cumplimiento de OWASP Top 10.
                        </p>
                        <div class="tech-stack">
                            <span class="tech-tag">MVC</span>
                            <span class="tech-tag">OWASP</span>
                            <span class="tech-tag">CORS</span>
                            <span class="tech-tag">Seguridad</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA SECTION -->
        <section class="cta-section">
            <h3>¿Listo para explorar?</h3>
            <p>Visita el comercio integrado y descubre un portafolio profesional en acción</p>
            <a href="{{ route('comercio.index') }}" class="btn btn-white">Ir al Comercio Integrado →</a>
        </section>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <a href="mailto:misael@example.com">✉️ Email</a>
                    <a href="#">📱 WhatsApp</a>
                    <a href="#">📞 Teléfono</a>
                </div>
                <div class="footer-section">
                    <h4>Enlaces</h4>
                    <a href="https://github.com">GitHub</a>
                    <a href="https://linkedin.com">LinkedIn</a>
                    <a href="#">Portafolio</a>
                </div>
                <div class="footer-section">
                    <h4>Proyectos</h4>
                    <a href="#">SIGLAB-QR</a>
                    <a href="#">Maletín Digital</a>
                    <a href="#">Investigación</a>
                </div>
                <div class="footer-section">
                    <h4>Ubicación</h4>
                    <p>El Alto, La Paz<br>Bolivia 🇧🇴</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 Misael Adalid Carvajal. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>