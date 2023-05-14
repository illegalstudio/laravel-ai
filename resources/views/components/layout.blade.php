<html lang="en" class="h-full bg-white">
<head>
    <title>Laravel AI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/laravel-ai/linky')->withEntryPoints([ 'resources/css/app.scss' ]) }}

    @livewireStyles
</head>
<body class="h-full"
      x-data="{ isMobileMenuOpen: false }"
      @keydown.window.escape="isMobileMenuOpen = false"
>

    <x-laravel-ai::menu.menu />

    <div class="lg:pl-72">

        <x-laravel-ai::menu.topbar />

        <main class="">
            {{ $slot }}
        </main>
    </div>

{{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/illegal/laravel-ai')->withEntryPoints([ 'resources/js/app.js' ]) }}
@livewireScripts
</body>
</html>
