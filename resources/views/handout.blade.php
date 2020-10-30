<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Skyreach Castle</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            body {
                text-align: center;
            }
            
            img {
                width: 75%;
            }
        </style>
    </head>
    <body>
        @isset($marks)
        <img src="{{ url('assets/handout/action.png') }}" />
        @endisset
        @isset($grid)
        <img src="{{ url('assets/handout/item.png') }}" />
        @endisset
        @isset($maps)
        <img src="{{ url('assets/handout/location.png') }}" />
        <img src="{{ url('assets/handout/upper_courtyard.png') }}" />
        <img src="{{ url('assets/handout/ice_tunnels.png') }}" />
        <img src="{{ url('assets/handout/lower_courtyard.png') }}" />
        @endisset
    </body>
</html>
