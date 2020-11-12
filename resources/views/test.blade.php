<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>


</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6">
            <x-su-select :items="$themes"></x-su-select>
        </div>
        <div class="col-6">
            <x-su-button>Check Theme</x-su-button>
        </div>
    </div>
</div>

@include('theme::assets')

</body>
</html>
