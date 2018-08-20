<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DLM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="icon" href="images/icon.jpg" />
</head>

<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container">
            <span class="navbar-brand">HereChat</span>
            <ul class="nav justify-content-end">
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{$first_name}}&nbsp;{{$last_name}}
                            </a>
                    <ul class="dropdown-menu">
                        <li><a href="chatsignout">Sign-out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm">
                <div class="card border-primary">
                    <div class="card-header border-primary">Inbox</div>
                    <div class="card-body border-primary" id="messages" style="overflow-x:auto;height:500px">
                    </div>
                    <div class="card-footer border-primary" style="padding:0;">
                        <form id="send" class="input-group" onsubmit="send();return false;">
                            <input type="hidden" id="_token" value="{{csrf_token()}}">
                            <input type="hidden" id="user_id" value="{{$id}}">
                            <input class="col-lg-11 col-sm-1" style="border-radius:0" id="message" required autocomplete="off" autofocus>
                            <input class="col-lg-1 col-sm-1 btn btn-primary" style="border-radius:0" type="submit" value=">">
                        </form>
                    </div>
                </div>
            </div>
            <div id="emojis" class="col-lg-3 col-sm" style="overflow-x:auto;">
            </div>
        </div>
    </div>
</body>

</html>
<script src="js/chat_home.js"></script>