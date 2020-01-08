<!doctype html>
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
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <h2 style="text-align: right;margin-right: 50px;"><button >退出</button></h2>

    </form>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <!-- <div class="title m-b-md">
                    Laravel
                </div> -->

                <div class="row">
                
                    <div style="border: 1px solid black;">
                        密钥：{{$data['user']->google2fa_secret}}
                    </div>

                    <div style="border: 1px solid black;">
                        <img src="{{$data['google2fa_url']}}">
                    </div>
                    <div>
                        请输入动态密码:<input type="text" name="google" id="google" onkeyup="request_url()">
                    </div>

                        @if (session('error'))
                            <div style="color: red;">
                                {{ session('error') }}
                            </div>
                        @endif
                </div>
                
            </div>
        </div>

    <script>
        function request_url()
        {
            var input = document.getElementById('google').value;
            if (input.length == 6){
                window.location.href="{{route('google.2fa')}}?one_time_password="+input
            }

        }
    </script>



    </body>
</html>
