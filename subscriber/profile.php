<?php
session_start();
require ('../lib/library.php');


//  ** Check if the user is logged In!  **
if(! isset($_SESSION['isLogged'])){
  session_destroy();
  reDir('../index.php');
}

//  ** Pull Session Variables  **
$fName = $_SESSION['fName'];
$lName = $_SESSION['lName'];
$email = $_SESSION['email'];
$addr = $_SESSION['addr'];
$phone = $_SESSION['phone'];


if (!empty($_POST['logOutSubmit'])) {
  session_destroy();
  reDir('../index.php');
}






echo <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
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
            <a class="navbar-brand" href="profile.php">Timely
                <!-- <img src="assets/img/logoWhite.png" width="125" height="40" alt=""> -->
            </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="profile.php">Profile</a></li>
                <li><a href="order.php">Start an order</a></li>
                <li><a href="accountSettings.php">Change Account Information</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="profile.php"><span class="glyphicon glyphicon-user"></span> $fName $lName
              </a>
              <ul class="dropdown-menu text-center">
                
                <li class="text-center">
            <form id="signOutForm" action="$PHP_SELF" method="post">
                <button type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-log-out"></span> Log out
                </button>
            </form>
          </li>
        </ul>
      </li>
     
    </ul>
        </div>
    </div>
</nav>




HTML;


