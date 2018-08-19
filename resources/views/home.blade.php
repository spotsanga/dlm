<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DLM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="icon" href="images/icon.jpg">
</head>

<body>
    <div class="bg-light">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <span class="navbar-brand">Daily Life Management</span>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                </ul>
                <form class="form-inline my-2 my-lg-0" id="signin">
                    <input type="hidden" id="_token" value="{{csrf_token()}}">
                    <input class="form-control mr-sm-2" type="email" id="in-email" placeholder="Email" required>
                    <input class="form-control mr-sm-2" type="password" id="in-password" placeholder="Password" required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign-in</button>
                </form>
            </div>
        </nav>
        <div class="container">
            <div id="alert" align="center" style="height:30px;display:none;border-radius:1px;">
            </div>
            <table style="margin-left:1%;width:99%">
                <tr>
                    <td style="width:45%">
                        <form id="signup">
                            <h1>Sign-up</h1>
                            <div class="form-group form-row">
                                <input type="text" placeholder="First name" class="form-control col" id="first_name" autocomplete="off" required>                                &nbsp;
                                <input type="text" placeholder="Last name" class="form-control col" id="last_name" autocomplete="off" required>
                            </div>
                            <div class="form-group form-row">
                                <input type="email" placeholder="Email address" class="form-control" id="up-email" autocomplete="off" required>
                            </div>
                            <div class="form-group form-row">
                                <input type="password" placeholder="Password" class="form-control" id="up-password" autocomplete="off" required>
                            </div>
                            <div class="form-row">
                                <label for="dob">Birthday</label>
                                <input type="date" class="form-group form-control" id="dob" autocomplete="off" required>
                            </div>
                            <div class="form-group form-row">
                                <input type="tel" placeholder="Mobile no" class="col form-control" id="mobile_no" autocomplete="off" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign-up</button>
                        </form>
                    </td>
                    <td style="width:10%">
                    </td>
                    <td style="width:44%">
                        <img src="images/geenlife_logo_retinaGREEN.png" style="">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/home.js"></script>

</html>