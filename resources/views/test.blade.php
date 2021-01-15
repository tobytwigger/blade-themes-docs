<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>


</head>
<body>
<div class="container">
    <form action="/test" method="POST">
        @csrf
        <div class="row">
            <div class="col-3">
                <x-theme-select
                    id="id"
                    name="id"
                    :items="$themes"></x-theme-select>
            </div>
            <div class="col-3">
                <x-theme-button variant="success">Choose Theme</x-theme-button>
            </div>
        </div>
    </form>

</div>

@include('theme::styles')
@include('theme::scripts')

</body>
</html>
