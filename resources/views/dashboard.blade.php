<!DOCTYPE html>
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
    .showing-expense,
    .showing-note {
        height: 200px;
        overflow-y: scroll;
    }
</style>

<body>
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container">
            <span class="navbar-brand">Daily Life Management</span>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articles">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="train">Train</a>
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
        <div id="alert" align="center" style="height:30px;display:none">
        </div>
        <table class="table">
            <td>
                <button id="show-expense" class="btn btn-outline-success" style="width:100%"><i class="fas fa-plus"></i>&nbsp;Expense</button>
            </td>
            <td>
                <button id="show-note" class="btn btn-outline-success" style="width:100%"> <i class="fas fa-plus"></i>&nbsp;Note</button>
            </td>
        </table>
        <form id="expense" class="form form-inline" style="width:100%;display:none">
            <fieldset>
                <legend>Add Expense</legend>
                <div class="input-group" style="width:100%">
                    <select id="category" class="form-control" style="width:20%">
                    <option>Food</option>
                    <option>Travel</option>
                    <option>Bills</option>
                    <option>Recharge</option>
                </select>
                    <input id="money_spent" placeholder="Money spent" type="number" class="form-control" min="0" required style="width:20%">
                    <input id="spent_at_date" type="date" class="form-control" required style="width:20%">
                    <input id="spent_at_time" type="time" class="form-control" required style="width:20%">
                    <select id="spent_at_merediem" class="custom-select form-control" style="width:10%">
                    <option>AM</option>
                    <option>PM</option>
                </select>
                    <input type="submit" value="Add" class="btn btn-outline-success" style="width:10%">
                </div>
            </fieldset>
        </form>
        <form id="note" class="form form-inline my-2 my-lg-0" style="display:none">
            <fieldset>
                <legend>Add Note</legend>
                <input id="title" placeholder="Title" class="form-control mr-sm-2" required>
                <input id="description" placeholder="Description" class="form-control mr-sm-2" required>
                <input type="submit" value="Add" class="btn btn-outline-success my-2 my-sm-0">
            </fieldset>
        </form>
        <br>
        <div class="showing-expense">
            <table class="table table-hover" id="expenses">
            </table>
        </div>
        <hr>
        <div class="showing-note">
            <table class="table table-hover" id="notes">
            </table>
        </div>
    </div>
</body>
<script src="js/dashboard.js"></script>

</html>