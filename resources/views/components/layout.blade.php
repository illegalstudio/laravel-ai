<html lang="en">
<head>
    <title>Laravel AI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/laravel-ai/linky')->withEntryPoints([ 'resources/css/app.scss' ]) }}
    @livewireStyles
</head>
<body class="">

{{ $slot }}


{{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/illegal/laravel-ai')->withEntryPoints([ 'resources/js/app.js' ]) }}
@livewireScripts
</body>
</html>
