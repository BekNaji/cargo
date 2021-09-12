<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .c-border {
            border: 3px solid rgba(0, 0, 0, 0.849);
        }

        .table-c-border {
            border: 3px solid rgba(0, 0, 0, 0.849);
        }

        .table-c-border tr td {
            border: 3px solid rgba(0, 0, 0, 0.849);
        }

        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: white;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 700;
            font-size: 25px;
        }

        .print-c-table tr td {
            padding: 5px 10px;
        }

    
        .district-bg {
            position: absolute !important;
            font-size: 200px;
            color: #00000042;
            top: 50%;
            left: 20%;
        }


    </style>
</head>

<body>
    <div class="container-fluid" id="app">
        <div class="row pt-3 pb-3">
            @yield('contetn')
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
