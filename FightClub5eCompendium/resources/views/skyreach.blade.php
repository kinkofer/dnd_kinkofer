<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Skyreach Castle</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", { cluster: 'us3' });

            var channel = pusher.subscribe('skyreach-navigation');
            channel.bind('select-rune', function(data) {
                didSelectRune(data['rune']);
            });
        </script>
        <script src="{{url('js/rune-selector.js')}}"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url('css/skyreach.css') }}">
    </head>
    <body>
        <div id="acceptedRunes">

        </div>
        <div id="runes">
        @isset($runes)
            @foreach ($runes as $rune)
                @php 
                    $url = url("/assets/rune/$rune.png");
                @endphp
                <div style="display: inline; position: relative">
                    <button class="rune" id="{{ $rune }}" onClick="selectRune(this)">
                        <img src="{{ $url }}"/>
                    </button>
                    @isset($admin)
                    <span style="position: absolute; left: 20%; top: -90px;">{{ $rune }}</span>
                    @endisset
                </div>
            @endforeach
        @endisset
        </div>
    </body>
</html>
