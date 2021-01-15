<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Splash screen</title>
</head>
<body>

<x-theme-layout-splash>

    <x-theme-card
            image-src="https://hatrabbits.com/wp-content/uploads/2017/01/random.jpg"
            image-alt="A random image"
            title="A card"
            subtitle="This is in the middle of the page, thanks to the layout">
        <x-slot name="body">
            Any component can be put here, and it can be combined with others
        </x-slot>
        <x-slot name="actions">
        </x-slot>

    </x-theme-card>
</x-theme-layout-splash>

@include('theme::styles')
@include('theme::scripts')

</body>
</html>
