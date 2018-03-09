<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/Style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
         
        </style>
    </head>
    <body>
        <div class="container">
            <h3>Chat web app</h3>  
        
            <div class="col-lg-8" id="chats">
                @foreach($rooms as $room)
                @if($isSignin == true)
                <div class="oneChat col-lg-12">
                    <div class="chatName">
                        <p><a href="/chat/{{$room->Id}}">{{$room->Name}} ( {{$room->IsPublic}} )</a></p>
                    </div>
                </div>
                @endif
                @if($isSignin == false)
                @if($room->IsPublic == 'public')
                <div class="oneChat col-lg-12">
                    <div class="chatName">
                        <p><a href="/chat/{{$room->Id}}">{{$room->Name}} ( {{$room->IsPublic}} )</a></p>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
            </div>

            <div class="col-lg-4">
                    
            @if(empty($isSignin))
                    <div class="SignIn">
                        <p>Sign IN</p>

                        <form action="/signIn" method="post" class="SignInForm">
                            {{ csrf_field() }}
                        <label>Name</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="name" />
                            <br><br>
                        <label>Password</label>&nbsp&nbsp&nbsp<input type="password" name="psw"/>
                        <br><br>
                        <input type="submit" class="btn btn-info" name="sub" value=" --- Մուտք --- "/>
                        </form>
                    </div>
            @else
                    <div class="SignIn">
                        <p>Create chat room</p>
                        <form action="/addroom" method="post" class="SignInForm">
                            {{ csrf_field() }}
                        <label>Name</label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="name" />
                            <br><br>
            <label>Public</label>&nbsp&nbsp<input type="radio" value="public" name="publicOrPrivate">
            <label> or Private</label>&nbsp&nbsp<input type="radio" value="private" name="publicOrPrivate"><br><br>
                        <input type="submit" class="btn btn-info" name="sub" value=" --- Create chat room --- ">
                        </form>
                    </div>
            @endif
                    
            </div>
           
        </div>
        <script type="text/javascript" src="js/js.js"></script>
        <!--div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div-->
    </body>
</html>
