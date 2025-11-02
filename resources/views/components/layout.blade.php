@props(['title' => ''])
    <!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ? $title.' | ' : '' }}Pokémon Cards</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
@include('layouts.navigation')

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{ $slot }}
</main>
</body>
</html>
