<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title base (Inertia sobrescreve) -->
    <title inertia>Notiflow | Monitoramento de Domínios e Páginas</title>

    <!-- SEO base -->
    <meta name="description"
          content="Notiflow é um sistema para monitoramento de domínios e páginas, com alertas automáticos sobre vencimentos e indisponibilidade." />

    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:site_name" content="Notiflow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Notiflow | Monitoramento de Domínios e Páginas">
    <meta property="og:description"
          content="Receba alertas automáticos sobre vencimento de domínios e páginas fora do ar.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-notiflow.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Notiflow">
    <meta name="twitter:description"
          content="Monitore domínios e páginas com alertas automáticos.">
    <meta name="twitter:image" content="{{ asset('images/og-notiflow.png') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased bg-gray-50">
    @inertia
</body>
</html>
