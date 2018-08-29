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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <link rel="icon" href="images/icon.jpg">
</head>

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
        <ul class="nav nav-tabs row text-center" id="myTab" role="tablist">
            <li class="nav-item col-lg-4 col-md-4 col-sm-12">
                <a class="nav-link active" id="expense-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="true">Expenses</a>
            </li>
            <li class="nav-item col-lg-4 col-md-4 col-sm-12">
                <a class="nav-link" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" aria-selected="false">Todo</a>
            </li>
            <li class="nav-item col-lg-4 col-md-4 col-sm-12">
                <a class="nav-link" id="expense_graph-tab" data-toggle="tab" href="#expense_graph" role="tab" aria-controls="expense_graph"
                    aria-selected="false">Expense Graph</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                <br>
                <form id="expense" class="form">
                    <div class="input-group row">
                        <select id="category" class="form-control col-lg-2 col-md-2 col-sm-6" style="height:40px;">
                                    <option>Food</option>
                                    <option>Travel</option>
                                    <option>Bills</option>
                                    <option>Recharge</option>
                                </select>
                        <input id="money_spent" placeholder="Money spent" type="number" class="form-control col-lg-2 col-md-2 col-sm-6" min="0" required>
                        <input id="spent_at_date" type="date" class="form-control col-lg-2 col-md-2 col-sm-5" required>
                        <input id="spent_at_time" type="time" class="form-control col-lg-2 col-md-2 col-sm-5" required>
                        <select id="spent_at_merediem" class="form-control col-lg-2 col-md-2 col-sm-2" style="height:40px;">
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                        <div class="input-group-append">
                            <input type="submit" value="Add" class="btn btn-outline-primary col">
                        </div>
                    </div>
                </form>
                <br>
                <div class="row" id="expenses">
                </div>
            </div>
            <div class="tab-pane fade" id="todo" role="tabpanel" aria-labelledby="todo-tab">
                <br>
                <form id="note" class="form">
                    <div class="input-group row">
                        <input id="title" placeholder="Title" class="form-control col" required>
                        <input id="description" placeholder="Description" class="form-control col" required>
                        <div class="input-group-append">
                            <input type="submit" value="Add" class="btn btn-outline-primary col">
                        </div>
                    </div>
                </form>
                <br>
                <div class="row" id="notes">
                </div>
            </div>
            <div class="tab-pane fade" id="expense_graph" role="tabpanel" aria-labelledby="expense_graph-tab">
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div id="piechart"></div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <canvas id="graph"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/dashboard.js"></script>

</html>