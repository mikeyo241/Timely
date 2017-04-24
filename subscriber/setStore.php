<?php
require('../lib/library.php');
session_start();


if(isset($_POST['storeName'])) {
  $_SESSION['strName'] = $_POST['storeName'];
  $_SESSION['strAddr'] = $_POST['storeAddr'];
  $_SESSION['strDist'] = $_POST['storeDistance'];
  $_SESSION['strTime'] = $_POST['storeTime'];
  reDir('makeList.php');
}else reDir('order.php');
