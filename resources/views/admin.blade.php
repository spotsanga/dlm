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

    .bar {
        width: 100%;
        height: 1px;
        background-color: green;
    }
</style>

<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid"><span class="navbar-brand">Daily Life Management</span></div>
    </nav>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <form class="form-group" onsubmit="fetch();return false;">
                    <input type="hidden" id="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="input-group col-11">
                            <select id="operation" class="form-control col-2 text-uppercase">
                                <option value="select">Select</option>
                                <option value="update">Update</option>
                                <option value="insert">Insert</option>
                                <option value="delete">Delete</option>
                            </select>
                            <input class="form-control col-10 text-uppercase" id="query" placeholder="Example: select * from categories" required>
                        </div>
                        <button class="btn btn-outline-success col-1" type="submit"><font><i class="fas fa-angle-right"></i></font></button>
                    </div>
                </form>
                <div id="myBar"></div>
                <div class="bar"></div>
                <div style="overflow-x: auto;">
                    <table id='content' class="table table-hover">
                    </table>
                </div>
            </div>
            <div class="col-3">
                <ul class="list-group text-uppercase" id="tables">
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
<script src="js/admin.js"></script>