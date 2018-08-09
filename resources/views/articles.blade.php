<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DLM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="icon" href="images/icon.jpg">
</head>
<style>
    #myBar {
        width: 1%;
        height: 5px;
        background-color: green;
    }
</style>

<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container">
            <span class="navbar-brand">Daily Life Management</span>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="#">Articles</a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{$first_name}}&nbsp;{{$last_name}}
                            </a>
                    <ul class="dropdown-menu">
                        <li><a href=javascript:signout();>Sign-out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <input type="hidden" id="id" value="{{$id}}">
        <input type="hidden" id="_token" value="{{csrf_token()}}">
        <div>
            <br>
            <select id="source" class="form-control">
                <option value="the-hindu">The Hindu</option>
                <option value="the-times-of-india">The Times of India</option>
                <option value="the-new-york-times">The New York Times</option>
                <option value="news-24">News24</option>
                <option value="abc-news">ABC News</option>
                <option value="bcc-news">BCC News</option>
                <option value="cbc-news">CBC News</option>
                <option value="google-news-in">Google News India</option>
            </select>
            <br>
        </div>
        <div id="myBar">
        </div>
        <table id='content' class="table table-hover">
        </table>
    </div>
</body>

</html>
<script src="js/articles.js"></script>