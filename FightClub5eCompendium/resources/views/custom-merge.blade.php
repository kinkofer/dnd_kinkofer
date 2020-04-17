<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Template</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>Merge Compendiums</h1>

                <div>
                    <p>Merge your own compendiums together.</p>
                    <p style="text-align: left;">
                        Instructions:
                        <ol style="text-align: left;">
                            <li>Press the Choose Files button</li>
                            <li>Select all your compendium .xml files</li>
                            <li>Press the Merge button</li>
                        </ol>
                    </p>
                </div>

                <div>
                    <form method="POST" action="/merge" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <input type="file" name="sources[]" multiple="multiple" />

                        <input type="submit" value="Merge" />
                    </form>
                </div>


                <div id="customCompendiumDiv" style="display: {{ isset($customCompendium) ? 'block' : 'none' }};">
                    <p>
                        Your Compendium has been created.<br />
                        <a href="{{ $customCompendium ?? 'javascript:void(0)' }}"{{ isset($customCompendium) ? ' download' : '' }}>Click here to download.</a>
                    </p>
                    <p>
                        These sources have been merged:
                        <ul>
                        @isset($sources)
                            @foreach ($sources as $source)
                                <li>{{ $source }}</li>
                            @endforeach
                        @endisset
                        </ul>
                    <p>
                </div>


                <div id="mergeErrorDiv" style="display: {{ isset($mergeError) ? 'block' : 'none' }};">
                    <p>
                        An error was encountered:<br />
                        @isset($mergeError)
                            {{ $mergeError }}
                        @endisset
                    <p>
                </div>


                <div style="margin-bottom: 50px;"></div>
            </div>
        </div>
    </body>
</html>
