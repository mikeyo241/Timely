<?php
require('../semantics3-php/lib/Semantics3.php');
require('../lib/library.php');
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_SESSION['strName'])) {
  $strName = $_SESSION['strName'];
  $strAddr = $_SESSION['strAddr'];
  $strDist = $_SESSION['strDist'];
  $strTime = $_SESSION['strTime'];
}else reDir('order.php');


$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF']);



if(isset($_POST['searchSubmit'])) {
  $qry = cleanIt($_POST['search']);
  $searchResult = searchItems($qry);
  $results = json_decode($searchResult, true);
 //$resultTotal = $results['results_count'];
echo $results["results"][0]["name"];
  echo $results["results"][0]["price"];
  $img =  $results["results"][0]["images"][0];

}else {
  $resultTotal = " ";
  $searchResult = "error";
  $results = "";
  $img = "error";
}


if(isset($_POST['createItem'])) {
  $itemName = $_POST['itemName'];
  $brand = $_POST['brand'];
  $itemDesc = $_POST['itemDesc'];
  $itemCost = $_POST['itemCost'];
  $item = "<tr> <td> " . $itemName . " </td><td> " . $itemCost . "</td></tr>";
  $_SESSION['cart'][] = $item;

}




if (isset($_POST['logOutSubmit'])) {
  session_destroy();
  reDir('order.php');
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

<!-- The Navigation Bar at the Top of the page -->
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
      
            <!-- Create a Custom Item Form -->
        <form method="post" action="$PHP_SELF">
        <div class="form-group">
          <label id="sLabel" for="search">Create A Custom Item:</label>
          <input type="text"    class="form-control" id="itemName"  name="itemName"  placeholder="Item Name"  required>
          <input type="text"    class="form-control" id="brand"     name="brand"     placeholder="Brand"      required>
          <textarea rows="2"    class="form-control" id="itemDesc"  name="itemDesc"  placeholder="Item Description"></textarea>
          <input type="number"  class="form-control" id="itemCost"  name="itemCost"  placeholder="Estimated Cost" required> 
          <input type="submit" name="createItem" class="btn btn-default" value="Add Custom Item">
        </div>             
      </form>
      
      
      <!-- Search for an Item form -->
      <form method="post" action="$PHP_SELF">
        <div class="form-group">
          <label id="sLabel" for="search">Beta Search for an item to add to your cart!</label>
          <input type="text"    name="search"       class="form-control" id="search">
          <input type="submit"  name="searchSubmit"  class="btn btn-default" value="Search">
        </div>             
HTML;
if (isset($_POST['searchSubmit'])) {
  $resultNumber = 0;
//  for($row = 0; $row <= 4; $row++){
//    echo '<div class="row">';
  for ($column = 0; $column <= 9; $column++) {
    $img = $results["results"][$resultNumber]["images"][0];
    $itemName = $results["results"][$resultNumber]["name"];
    $itemBrand = $results["results"][$resultNumber]["brand"];
    $itemPrice = $results["results"][$resultNumber]["price"];
    echo <<< HTML
        <div class="col-sm-3">
          <div class="well well-red">
            <img src="$img" class="img-thumbnail" width="100" height="100">
            <h4 class="text-centered">$itemName</h4>
            <h4 class="text-centered">$itemBrand</h4>
            <h4 class="text-centered">$itemPrice</h4>
          </div>        
        </div>
HTML;
    $resultNumber++;
    //}
  }
}

echo <<< HTML
       


      
     
    </div>
  </div>
  
  <!-- The Users Shopping Cart -->
  <div class="col-sm-3">
    <div class="well well-white">
      <h5 id="Store" class=""text-centerw">Delivering from: <b>$strName</b><br> $strAddr </h5>
              <form id="signOutForm" action="$PHP_SELF" method="post">
            <input type="submit" value="Cancel Order" id="logOutSubmit" name="logOutSubmit">
        </form>
      <h2 class="text-center" >Shopping Cart</h2>
     
      <table class="table">
        <thead>
          <tr><th>Item</th> <th>Cost</th></tr>
</thead>

HTML;
if(isset($_SESSION['cart'])) {
  foreach($_SESSION['cart'] as $key=>$value)
  {
    // and print out the values
    echo $value;
  }

}
echo <<< HTML
    </tabel>

    </div>
  </div>
</div>


HTML;

//var_dump(json_decode($searchResult, true));
