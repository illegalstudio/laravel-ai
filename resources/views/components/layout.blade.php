<html lang="en">
<head>
    <title>Laravel AI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/laravel-ai/linky')->withEntryPoints([ 'resources/css/app.scss' ]) }}
    @livewireStyles
</head>
<body class="">

<div class="bg-indigo-500 w-52 fixed h-full hidden lg:block">
    LEFT
</div>

<div class="lg:ml-52">
    <div class="mx-auto max-w-7xl px-5 mb-24 sm:px-6 lg:px-8">
        {{ $slot }}
        <div class="fixed bottom-0 h-20 w-full bg-white">Footer</div>
    </div>
</div>

{{ Vite::useHotFile(base_path() . '/vendor/illegal/laravel-ai/public/hot')->useBuildDirectory('vendor/illegal/laravel-ai')->withEntryPoints([ 'resources/js/app.js' ]) }}
@livewireScripts
</body>
</html>
