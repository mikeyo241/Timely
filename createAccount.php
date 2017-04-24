<?php
/**
 * Created by PhpStorm.
 * User: mikey
 * Date: 4/24/2017
 * Time: 2:09 PM
 *//* 	Programmer: 		Michael A Gardner
 * 	Class:				CPT - 283-001
 *	Date:				4/24/2017
 *	Document: 			
 */




$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
$userNotify = "";


// ** Create Account System  **
if(isset($_POST['createAccSubmit'])){
  if($_SESSION['pass'] == md5($_POST['cfPass'])){
      createAccount()
    }else $userNotify = "The passwords must match!";

  reDir('createAccount.php');
}
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
    <div class="row">
        <div class="col-sm-6">
            <form>
                
                <h2 class="text-center">Create Account</h2>
                <div class="form-group">
                    <label for="email">Email Selected:</label>
                    <h6 id="email">$email</h6>
                </div>
                <div class="form-group">                   
                    <label for="cfPass">Confirm Password</label>
                    <input type="password" name="cfPass" class="form-control" id="cfPass">
                </div>
                <div class="form-group">
                    <label for="pwd">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName">
                </div>
                <div class="form-group">
                    <label for="pwd">Last Name</label>
                    <input type="text" name="fName" class="form-control" id="fName">
                </div>
                <div class="form-group">
                    <label id="sLabel" for="search">Delivery Address</label>
                    <input type="text" class="form-control" id="search">
                </div>
                <div class="form-group">
                    <label for="pwd">First Name</label>
                    <input type="text" name="fName" class="form-control" id="fName">
                </div>
        
                <button type="submit" name="createAccSubmit"    class="btn btn-default">Create Account</button>
            </form>
</div>
</div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places&key=AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0"></script> 
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0"></script> -->
  <script>
  
      var ac = new google.maps.places.Autocomplete(document.getElementById('search'));
      
      google.maps.event.addListener(ac, 'place_changed', function() {
          var place = ac.getPlace();
          console.log('Name: ' + place.name);
          console.log('Address: ' + place.formatted_address);
          var address = "" + place.formatted_address;

          
              
       

          drivingDistance(address);
      });
</script>




</body>
</html>
HTML;

