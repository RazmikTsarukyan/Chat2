<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/Style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
           .message{
                width: 100%;
           }
           .friendName{
                float: left;
                background-color: yellow;
                padding:10px;
                border-radius: 50%;
           }
           .friendMessage{
                float:left;
                padding:10px;
           }
           .myName{
                float: left;
                background-color: blue;
                padding:10px;
                border-radius: 50%;
           }
           .myMessage{
                float: left;
                padding: 10px;
           }
        </style>
    </head>
    <body>
        <div class="container">
            <h3>Chat Room</h3> <p><a href="/">sign out</a></p> 
        <div class="row" id="chat"  chatId="{{$myid}}">
            @foreach($RoomMessages as $item)
            <div class="message col-lg-12">
                <div class="friendName">
                    <b>{{$item->Name}}</b>
                </div>
                <div class="friendMessage">
                    <p>{{$item->Message}}</p>
                </div>
            </div>
            @endforeach
        </div>
            <ul class="chat" id="myList" style="text-decoration: none;">
            </ul>
            <form >
                {{ csrf_field() }}
                <input id="name" type="text" name="author" placeholder=" --- Name ---"><br><br>
                <textarea name="textarea" placeholder=" --- Message ---" style="width: 100%; height: 50px;"></textarea><br><br>
                <input type="submit" name="send" value=" --- Send --- ">
            </form>
        </div>
        <script type="text/javascript" src="js/js.js"></script>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>

        var socket = io(':6001');

        function appendMessage(data)
        {
               
        document.getElementById('chat').innerHTML += '<div class="message col-lg-12"><div class="friendName"><b>'+data.author+'</b></div><div class="friendMessage"><p>'+ data.message +'</p></div></div>';        
        }
            
        $('form').on('submit', function(){
                var name = document.getElementById("name").value;
                var text = $('textarea').val();
                var chatid = document.getElementById("chat").getAttribute("chatId");
                var myObject = {
                    message: text,
                    author: name
                } 
                var currentLocation = "" + window.location;
                var array = currentLocation.split('/');
                var lastsegment = array[array.length-1];
                if(lastsegment == chatid)
                {
                    socket.send(myObject);
                }

                appendMessage(myObject);

                $.ajax({
                    type:'POST',
                    url:'/addMessage',
                    data: {message: text, author: name, id : chatid},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                            $('textarea').val('');
                            document.getElementById("name").value = '';
                        }
                    });
                
                return false;
            });
  

           
                var chatid = document.getElementById("chat").getAttribute("chatId");
                var currentLocation = "" + window.location;
                var array = currentLocation.split('/');
                var lastsegment = array[array.length-1];

                if(lastsegment == chatid)
                {
                     socket.on('message', function(data){
                        appendMessage(data);
                    });
                }
           
            
            /*socket.on('message', function(data){
               // console.log("FromM M server:", data); 
               console.log(data); 
            }).on('author', function(data){
                //console.info(data);
                console.log(data);
            });*/

        </script>
    </body>
</html>
