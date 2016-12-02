<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Lynk</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <script>
            window.Lynk = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                'url' => config('app.url'),
            ]); ?>
        </script>
    </head>
    <body>
        <div id="app" class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
