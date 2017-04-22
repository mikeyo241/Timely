<?php





echo <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <title>On-Demand Delivery</title>
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
                <li><a href="profile.php">Profile</a></li>
                <li class="active"><a href="order.php">Create an Order</a></li>
                <li><a href="account.php">Account Settings</a></li>               
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><span class="glyphicon glyphicon-logg-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row">
  <div class="col-sm-8">
    <div class="well well-white">
      <h2 class="text-center">Order</h2>
      <form>
        <div class="form-group">
          <label id="sLabel" for="search">Select A Store:</label>
          <input type="text" class="form-control" id="search">
          <input type="hidden" name="store" id="store" />
          <input type="submit" name="storeSubmit" class="btn btn-default" value="Continue">
        </div>
          
    
      </form>
    
        
        
  <!-- Google MAPS API: AIzaSyCWwnLz96h6TEZhgodUmPdyUNfAk1EkUA0  -->
 
  </div>
</div>
  <div class="col-sm-4">
    <div class="well well-white">
        <h2 class="text-center" >Shopping Cart</h2>
        <h3 class="text-center" id="Store"></h3>
        <h6 class="text-center" id="strAddr"></h6>
        
        
        
        
  
  
  
  
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
          document.getElementById('sLabel').innerHTML = "Change Store:";
          document.getElementById('Store').innerHTML = place.name;
          document.getElementById('strAddr').innerHTML = place.formatted_address;
              
       

          drivingDistance(address);
      });
      
      function drivingDistance(destination) {
          var origin = "1009 North Fishtrap Road, Easley, SC 29640";
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
      }
    }
  }
      }}
      
      document.getElementById('findProduct').onkeyup = itemSearch();
      function itemSearch(){
        var xhr = createCORSRequest('GET', 'https://api.indix.com/v2/summary/products?countryCode=US&q=water&app_key=TAXm7npAiNaYF5PwOfI1FpB88Lm2di5Y')
         xhr.send();
    }
       
      
</script>
</body>

HTML;
