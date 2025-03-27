<header class="header" id="header">
    <div class="container">
        <a href="/" class="logo" aria-label="Seutt - Inicio">
            <img src="/images/logo.svg" alt="Seutt Logo" width="120" height="40">
            <span>Seutt</span>
        </a>

        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav" id="nav-menu">
            <ul class="nav-list">
                <li><a href="/#home" class="nav-link<?php echo ($request_url === 'home' || $request_url === '') ? ' active' : ''; ?>">Inicio</a></li>
                <li><a href="/#services" class="nav-link">Servicios</a></li>
                <li><a href="/about" class="nav-link<?php echo $request_url === 'about' ? ' active' : ''; ?>">Nosotros</a></li>
                <li><a href="/#contact" class="nav-link">Contacto</a></li>
            </ul>

            <div class="theme-toggle">
                <input type="checkbox" id="theme-switch" aria-label="Toggle dark mode">
                <label for="theme-switch">
                    <svg class="sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    <svg class="moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </label>
            </div>
        </nav>
    </div>
</header>