<html>

<head>

    <!-- Latest compiled and minified BootstrapCSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!--   Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700" rel="stylesheet">

    <title>Kargo
    </title>
    <style>
        html {
            width: 100%;
            height: 100%;
            margin: 0 auto;
        }

        .left {
            background-image: url({{ asset('images/1555399045_uzb1.jpg') }});
            height: 700px;
            background-repeat: no-repeat;
            margin: 0 auto;
        }

        .col-md-6 {
            font-family: 'Raleway', sans-serif;
        }

        p,
        h1 {
            letter-spacing: .08em;
            font-weight: 300;
            line-height: 2em;
        }

        button.btn {
            border: 2px solid #ffffff;
            background-color: #303636;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: 500;
            color: #ffffff;
            letter-spacing: .1em;
            padding: 10px 20px 10px 20px;
            margin-top: 20px;
        }

        button.btn:hover {
            font-weight: 800;
            background-color: #cccccc;
            color: #000000;
        }

        .content-header,
        div p {
            margin: 50px;
            margin-top: 50px;
        }

        .right h1 {
            letter-spacing: .1em;
            font-weight: 100;
            font-size: 100px;
        }

        p a {
            color: #f4c5dc;
        }

        footer p {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: .2em;
            margin-bottom: 0px;
            margin-top: 150px;
        }

    </style>
</head>

<body>
    <div class="col left col-md-6"><img class="cover-img" src="">
    </div>
    <div class="col right col-md-6">
       <div style="display: flex; justify-content: flex-end">
        @auth
        <a href="{{url('/dashboard')}}">Admin Panel</a>
        @else
        <a href="{{route('login')}}">Kirish</a>
        @endauth
       </div>
        <div class="content-header">
            <h3 style="margin-top: 80px">Kargo Name</h3>
        </div>
        <div>
            <p>
                Kompaniyamiz o'z mijozlariga moslashuvchan tarif siyosatini, ishonchliligini, barcha toifadagi
                tovarlarni etkazib berishni (taqiqlanganlardan tashqari) yuqori sifatli va qisqa vaqt ichida taklif
                etadi.
            </p>
            <form action="{{route('result')}}" style="margin-left: 46px;">
                <input type="text" name="number" class="form-control" style="border-radius: 10px;" placeholder="Kargo raqami">
                <button class="btn">Qidirish</button>
            </form>
            

            <footer>
                <p><a href="/">Kargo</a> Copyright {{date('Y',time())}}</p>
            </footer>
        </div>
    </div>
    <!--  Font Awesome  -->
    <script src="https://use.fontawesome.com/83fc84333f.js">
    </script>
</body>

</html>


{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}
