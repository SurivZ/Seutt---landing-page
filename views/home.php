<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Lorem ipsum dolor sit amet</h1>
            <p class="hero-text">Consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="/#contact" class="btn btn-primary">Contacto</a>
        </div>
        <div class="hero-image">
            <img src="/images/hero-image.svg" alt="Hero image" width="600" height="400" loading="eager">
        </div>
    </div>
</section>

<section class="services" id="services">
    <div class="container">
        <h2 class="section-title">Nuestros Servicios</h2>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-img">
                    <img src="/images/service1.svg" alt="Service 1" width="400" height="300" loading="lazy">
                </div>
                <h3 class="service-title">Servicio 1</h3>
                <p class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.</p>
            </div>

            <div class="service-card">
                <div class="service-img">
                    <img src="/images/service2.svg" alt="Service 2" width="400" height="300" loading="lazy">
                </div>
                <h3 class="service-title">Servicio 2</h3>
                <p class="service-desc">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
            </div>

            <div class="service-card">
                <div class="service-img">
                    <img src="/images/service3.webp" alt="Service 3" width="400" height="300" loading="lazy">
                </div>
                <h3 class="service-title">Servicio 3</h3>
                <p class="service-desc">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
    </div>
</section>

<section class="contact" id="contact">
    <div class="container">
        <h2 class="section-title">Contacto</h2>

        <div class="contact-grid">
            <div class="contact-info">
                <h3 class="contact-subtitle">Información de contacto</h3>

                <div class="contact-item">
                    <i class="icon icon-phone"></i>
                    <div>
                        <h4>Teléfono</h4>
                        <p>+123 456 7890</p>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="icon icon-email"></i>
                    <div>
                        <h4>Email</h4>
                        <p>info@seutt.com</p>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="icon icon-location"></i>
                    <div>
                        <h4>Dirección</h4>
                        <p>123 Calle Principal, Ciudad</p>
                    </div>
                </div>

                <div class="contact-social">
                    <h4>Síguenos</h4>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form id="contactForm" method="POST" action="/">
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>

                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-error"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" autocomplete="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" autocomplete="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="tel" id="phone" name="phone" autocomplete="tel">
                    </div>

                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" rows="5" style="resize: none;" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>