
<?php
session_start();
require ('lib/library.php');
//  **  Login System  **
if(isset($_POST['loginSubmit'])) {
  $_SESSION['email'] = $_POST['email'];
  $userNotify = checkLogin($_POST['email'],$_POST['pass']);
  if($userNotify == 'normalLogin'){
    reDir('subscriber/profile.php');
  }else if ($userNotify == 'driverLogin') {
    reDir('driver/profile.php');
  }
} else $userNotify = "";


  if(isset($_POST['createAccSubmit'])){
 // if(checkEMail($_POST['email'])){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['pass'] = md5($_POST['pass']);
    reDir('createAccount.php');
//  }else{
 //   $userNotify = "E-Mail is already in use";
//  }

} else $userNotify = "";



























echo <<< HTML

<!DOCTYPE html>
<html lang="en">
<head>
    <title>On-Demand Delivery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Make sure the HTML file doesn't get stored -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Timely
                <!-- <img src="assets/img/logoWhite.png" width="125" height="40" alt=""> -->
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="about.html">How it works</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="careers.html">Join Our Team</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><span class="glyphicon glyphicon-logg-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
<h1>$userNotify</h1>
    <div class="row">
        <div class="col-sm-3">
            <form action="$PHP_SELF" method="post">
                <h2 class="text-center">Sign In</h2>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="pass" class="form-control" id="pwd">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>
                <input type="submit" name="loginSubmit"     value="login"   class="btn btn-default">
                <input type="submit" name="createAccSubmit" value="Create Account"   class="btn btn-default">
            </form>


            <br>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-8">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
                <!-- Indicators -->
                <!--<ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>  -->

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item">
                        <img src="assets/img/isles.png" alt="Image">
                    </div>

                    <div class="item">
                        <img src="assets/img/officesuppliesorig.png" alt="Image">
                    </div>

                    <div class="item active">
                        <img src="assets/img/tools.png" alt="Image">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        </div>
    </div>
    <hr>
</div>




</body>
</html>



HTML;
