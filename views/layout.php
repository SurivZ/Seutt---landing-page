<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Seutt - Soluciones innovadoras para tu negocio">
    <meta name="keywords" content="seutt, servicios, empresa, soluciones">
    <meta name="author" content="Seutt">
    <meta property="og:title" content="Seutt - Soluciones Innovadoras">
    <meta property="og:description" content="Descubre lo que Seutt puede hacer por tu negocio">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.seutt.com">
    <meta property="og:image" content="https://www.seutt.com/images/logo.png">

    <title>Seutt - <?php
                    $page_titles = [
                        'home' => 'Inicio',
                        'about' => 'Nosotros',
                        'not-found' => 'Página no encontrada'
                    ];
                    echo $page_titles[$request_url] ?? 'Inicio';
                    ?></title>

    <!-- Preload fonts -->
    <link rel="preload" href="/fonts/Inter.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/OpenSans.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/Montserrat.woff2" as="font" type="font/woff2" crossorigin>

    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/styles/fonts.css">
    <link rel="stylesheet" href="/styles/themes/dark.css" id="theme-style">
    <link rel="stylesheet" href="/styles/utilities.css">
    <link rel="stylesheet" href="/styles/main.css">

    <!-- Favicon -->
    <link rel="icon" href="/images/favicon.ico" sizes="any">
    <link rel="icon" href="/images/logo.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/images/logo.png">
</head>

<body>
    <?php include_once 'partials/header.php'; ?>

    <main>
        <?php
        require $view_path;
        ?>
    </main>

    <?php include_once 'partials/footer.php'; ?>

    <!-- Back to top button -->
    <a href="#top" class="back-to-top" aria-label="Volver al inicio" hidden>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 15l-6-6-6 6" />
        </svg>
    </a>

    <!-- JavaScript -->
    <script src="/scripts/main.js" defer></script>
</body>

</html>