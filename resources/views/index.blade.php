<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700" />
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />

        <script>window.Lynk = {!! json_encode(['csrfToken' => csrf_token()]) !!};</script>
    </head>
    <body>
        <div class="container">
            <div id="root" v-cloak>
                <create-link></create-link>
            </div>
        </div>

        <script defer src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
