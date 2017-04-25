<?php
require('../lib/library.php');
session_start();


if(isset($_POST['storeName'])) {
  $_SESSION['strName'] = $_POST['storeName'];
  $_SESSION['strAddr'] = $_POST['storeAddr'];
  $_SESSION['strDist'] = $_POST['storeDistance'];
  $_SESSION['strTime'] = $_POST['storeTime'];
  $_SESSION['deliveryTime'] = $_POST['deliveryTime'];
  $_SESSION['DeliveryAddress'] = $_POST['DeliveryAddress'];
  echo "Store Name " . $_SESSION['strName'] . "<br>";
  echo "Store Address " . $_SESSION['strAddr']. "<br>";
  echo "Store Distance " . $_SESSION['strDist'] . "<br>";
  echo "Store Time " . $_SESSION['strTime'] . "<br>";
  echo "Delivery Time " . $_SESSION['deliveryTime']. "<br>" ;
  echo "Delivery Address " . $_SESSION['DeliveryAddress'] . "<br>";
  createOrder($_SESSION['DeliveryAddress'], $_SESSION['strAddr'],"megan@beautiful.com",$_SESSION['email'],$_SESSION['deliveryTime']);
  $_SESSION['orderNumber'] = getOrderNumber($_SESSION['email'],$_SESSION['strAddr']);
  echo "Order Number " . $_SESSION['orderNumber'];
  reDir('makeList.php');
}else reDir('order.php');
