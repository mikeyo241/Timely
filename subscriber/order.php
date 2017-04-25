<?php

session_start();
require ('../lib/library.php');


//  ** Check if the user is logged In!  **
//if(! isset($_SESSION['isLogged'])){
//  session_destroy();
//  reDir('../index.php');
//}

//  ** Pull Session Variables  **
$fName = $_SESSION['fName'];
$lName = $_SESSION['lName'];
$email = $_SESSION['email'];
$addr = $_SESSION['addr'];
$phone = $_SESSION['phone'];


if (isset($_POST['logOutSubmit'])) {
  session_destroy();
  reDir('../index.php');
}




echo <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create An Order!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-family: 'Satisfy', cursive;
            font-size: 40px;
        }
        #map {
        height: 100%;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    
    
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
                <li><a href="profile.php">Profile</a></li>
                <li class="active"><a href="order.php">Create an Order</a></li>
                <li><a href="account.php">Account Settings</a></li>               
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
          </li></ul></li></ul>
        </div>
    </div>
</nav>

<div class="row">
<div class="col-sm-2"></div>
  <div class="col-sm-8 centered">
    <div class="well well-white">
          <form method="post" action="setStore.php">
    
          <h2 class="text-center" id="timeHeading">Pick a time for Delivery</h2>
          <input type="datetime-local" class="form-control" name="deliveryTime" required>
          
          <h2 class="text-center" id="heading">Delivery Address</h2>
          <label id="sLabel2" for="search2">Address that the will receive the Order</label>
          <input type="text" class="form-control" id="search2" value="$addr" required>
          
      <h2 class="text-center" id="heading">Select a store</h2>
      <h3 class="text-center" id="store"></h3>
      <h6 class="text-center" id="strAddr"></h6>
      

        <div class="form-group" >
          <label id="sLabel" for="search"></label>
          <input type="text" class="form-control" id="search">
          <input type="hidden" name="storeName" id="storeName" />
          <input type="hidden" name="DeliveryAddress" id="deliver123"/>
          <input type="hidden" name="storeAddr" id="storeAddr" />
          <input type="hidden" name="deliveryAddr" id="deliveryAddr"/>
          <input type="hidden" name="storeDistance" id="storeDistance" />
          <input type="hidden" name="storeTime" id="storeTime" />
        
        </div>
          <input type="submit" name="storeSubmit" class="btn btn-default" value="Continue">
    
    
          
      </form>
    

  <!-- Google MAPS API: AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0  -->
 
  </div>
</div>

        
        
        
        
  
  
  
  
  </div>
</div>
 
</div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places&key=AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0"></script> 
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0"></script> -->
  <script>
  
      var ac = new google.maps.places.Autocomplete(document.getElementById('search'));
      
      google.maps.event.addListener(ac, 'place_changed', function() {
          var place = ac.getPlace();
          console.log('Name: ' + place.name);
          console.log('Address: ' + place.formatted_address);
          var address = "" + place.formatted_address;
          document.getElementById('sLabel').innerHTML = "To Change your store just type in a new one!";
          document.getElementById('store').innerHTML = place.name;
          document.getElementById('strAddr').innerHTML = place.formatted_address;
          document.getElementById('storeName').value = place.name;
          document.getElementById('storeAddr').value = place.formatted_address;
          
          document.getElementById('heading').style.display = "none";
          document.getElementById('search').value = "";
          
              
       

          drivingDistance(address);
      });
      var ac2 = new google.maps.places.Autocomplete(document.getElementById('search2'));
      
      google.maps.event.addListener(ac2, 'place_changed', function() {
          var place = ac2.getPlace();
      });
      
      
      function drivingDistance(destination) {
          var origin = document.getElementById('search2').value;
          var distance = new google.maps.DistanceMatrixService();
          distance.getDistanceMatrix(
              {
              origins: [origin],
              destinations: [destination],
              travelMode: 'DRIVING',
              unitSystem: google.maps.UnitSystem.IMPERIAL,
              },callback);
          function callback(response, status) {
            if (status == 'OK') {
              var origins = response.originAddresses;
              var destinations = response.destinationAddresses;

              for (var i = 0; i < origins.length; i++) {
                var results = response.rows[i].elements;
                for (var j = 0; j < results.length; j++) {
                  var element = results[j];
                  var distance = element.distance.text;
                  var duration = element.duration.text;
                  var from = origins[i];
                  var to = destinations[j];
        console.log('Distance: ' + distance);
        console.log('Duration: ' + duration);
        console.log('From: ' + from);
        console.log('To: ' + to);
        document.getElementById('storeDistance').value = distance;
        document.getElementById('storeTime').value = duration;
        document.getElementById('deliver123').value = from;
      }
    }
  }
      }}

 
      
</script>
</body>

HTML;
