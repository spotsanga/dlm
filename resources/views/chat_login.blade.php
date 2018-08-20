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
        <div class="container"><span class="navbar-brand">HereChat</span></div>
    </nav>
    <br/>
    <div id="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card border-primary">
                    <div class="card-header border-primary">Login</div>
                    <div class="card-body">
                        <form class="form-group" action="chat" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" required>
                            <br/>
                            <label for="pwd">Password</label>
                            <input class="form-control" id="pwd" name="password" type="password" required>
                            <br/>
                            <input class="btn btn-primary" type="submit" value="Signin">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>