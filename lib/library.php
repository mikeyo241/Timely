<?php
$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF']);





function searchItems($qry)
{
# Set up a client to talk to the Semantics3 API using your Semantics3 API Credentials
  $key = 'SEM34EC3B420DF27002D6B5785CF9BE3B16D';
  $secret = 'ZDlhY2Q2MTE0NDE4NDc4NzZmM2U3NTU5YjkxYTNiZWQ';
  $requestor = new Semantics3_Products($key, $secret);
# Build the request
  $requestor->products_field("name", "$qry");
# Run the request
  $results = $requestor->get_products();
# View the results of the request
  return $results;
}

/*   Author :           Nathaniel Merck
 *   Function:          connectDB
 *   Last modified:     4-24-17
 *   Description:       connects to database
 */

function connectDB(){
    $con = mysqli_connect("localhost", "CIT", "CPT283", "Michael");

    if (!$con){
        die("failed to connect to database  D;  <br>" . mysqli_connect_error() );
    }
    return $con;
}



/**  Function:      cleanIT
 * Last Modified:   2 November 2016
 * @param     Binarydata - Will be trim(),stripslashes(), and htmlspacialchar() so that nothing bad remains in the variable.
 * @return          string - That has been cleaned as described.
 * Description:		This function is used to test the input and stop possible security threats.
 */
function cleanIt($data) {
  $data = trim($data);					// Strip any extra white space. ex. http://php.net/manual/en/function.trim.php
  $data = stripslashes($data);			// Strip any slashes in the input.  ex. http://php.net/manual/en/function.stripslashes.php
  $data = htmlspecialchars($data);		// This changes Special characters to non html special characters.  ex. http://php.net/manual/en/function.htmlspecialchars.php
  return $data;
}
/** Function:       fixSql
 * Last Modified:   26 November 2016
 * @param           $data -  The data tha needs to be filtered.
 * @return          string - Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.
 * Description:     Used to clean any form input that will go into the database.
 */
function fixSql($data) {
  $data = cleanIt($data);
  $link = dbConnect();
  $data = mysqli_real_escape_string($link, $data);/*  Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.   */
  $link->close();
  return $data;
}

/** Function:       dbConnect
 * Last Modified:   23 February 2017
 * @param string    $hostname - host name of the server.
 * @param string    $db_user - the database user name.
 * @param string    $db_pword - the database password.
 * @param string    $db_database - the database to use.
 * @return          mysqli - is the mysqli link to the server make sure to close the connection when done!
 * Description:     This is used to connect to the database unless spcified uses default values.
 */
function dbConnect($hostname = 'localhost',$db_user='timely',$db_pword='tyrjh%idl*kasdfasdfE',$db_database='timely')
{
  $link = mysqli_connect($hostname, $db_user, $db_pword, $db_database) or die ("failed to connect");
  return $link;
}


function reDir($location) {
  header("Location: $location");
}


function createAccount($email, $pass, $fName, $lName, $phone, $Address, $accType, $driver){
  fixSql($email); fixSql($pass); fixSql($fName); fixSql($lName); fixSql($Address); fixSql($accType);
//      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Query  ***
  $qry = "INSERT INTO ACCOUNT(ACC_EMAIL, ACC_PASS, ACC_FNAME, ACC_LNAME, ACC_PHONE, ACC_ADDRESS, ACC_TYPE, ACC_DRIVER) 
      VALUES (
      '$email',
      '$pass',
      '$fName',
      '$lName',
      '$phone',
      '$Address',
      '$accType',
      '$driver'
      )";


//      *** Implement Query   ***
  if (mysqli_query($link,$qry)){
    return true;
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;
  }
}

function checkEMail($eMail) {
//      ** Check input for database exploits **
  fixSql($eMail);

//      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Database Query's    ***
  $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$eMail'";

  if($result = mysqli_query($link,$qry)) {                // Implement the query
    if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
      $link->close();
      return false;
    }else if (mysqli_num_rows($result) == 0) {
      $link->close();
      return true;}
  }else {             // Query Failed - Error Messages Not shown !!!!
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;
  }
  return false;
}

/** Function:       checkLogin
 * Last Modified:   2 November 2016
 * @param           $email - Email address  (40 characters MAX)
 * @param           $pw -    Password    md5 Encrypted password      Always 32 characters long
 * @return          bool - Will return true if the user exists and the password is correct.
 * Description:     This function is used to determine if the Email and password entered on the
 *                  login page match the username and password in the database.
 */
function checkLogin($id , $pass){
//  deleteExpiredTempPassword();
//      ** Check input for database exploits **
  $id = fixSql($id);
  $pass = md5(fixSql($pass));
//      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Database Query's    ***
  $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$id'";


  if($result = mysqli_query($link,$qry)) {                // Implement the query
    if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
      $res = mysqli_fetch_assoc($result);             // Put the result into an array
      if($pass == $res['ACC_PASS'] && $id == $res['ACC_EMAIL']){
        $_SESSION['email']      =  $res['ACC_EMAIL'];
        $_SESSION['fName']      =  $res['ACC_FNAME'];
        $_SESSION['lName']      =  $res['ACC_LNAME'];
        $_SESSION['phone']      =  $res['ACC_PHONE'];
        $_SESSION['addr']       =  $res['ACC_ADDRESS'];
        $_SESSION['accType']    =  $res['ACC_TYPE'];
        $_SESSION['accDriver']  =  $res['ACC_DRIVER'];
        $_SESSION['isLogged']   =   true;

        if ($res['ACC_DRIVER'] == "no") return 'normalLogin';
        if ($res['ACC_DRIVER'] == "yes") return 'driverLogin';

      } else if ($pass ==$res['ACC_TEMP_PASS'] && $id == $res['ACC_EMAIL'] && $res['ACC_TEMP_PASS_EXPIRES'] != NULL) return "tempPassUsed";
      else return "Wrong Email or Password";
    }
  }else {             // Query Failed - Error Messages Not shown !!!!
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;
  }
  return false;
}

function createOrder($deliveryAddress, $storeAddress, $driverEmail, $customerEmail, $DeliveryTime) {
  //      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Query  ***
  $qry = "INSERT INTO ORDERED(ORD_DEL_ADDR, ORD_STORE_ADDR, ORD_DRIVER, ORD_CUSTOMER, ORD_DELIVERED) 
      VALUES (
      '$deliveryAddress',
      '$storeAddress',
      '$driverEmail',
      '$customerEmail',
      '$DeliveryTime'      
      )";


//      *** Implement Query   ***
  if (mysqli_query($link,$qry)){
    return true;
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;
  }
}
function addItemsToOrder($orderNum, $itemName, $itemBrand, $itemPrice, $itemDesc){
  //      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Query  ***
  $qry = "INSERT INTO ITEMS(ORD_NUM, ITEM_NAME, ITEM_BRAND, ITEM_PRICE, ITEM_DESC) 
      VALUES (
      '$orderNum',
      '$itemName',
      '$itemBrand',
      '$itemPrice',
      '$itemDesc'      
      )";


//      *** Implement Query   ***
  if (mysqli_query($link,$qry)){
    return true;
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;
  }
}

// Megans Login Info  : megan@beautiful.com   pass: 1234

function getOrderNumber($userEmail, $storeAddress)
{

//      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Database Query's    ***
  $qry = "SELECT * FROM ORDERED WHERE ORD_CUSTOMER = '$userEmail' AND ORD_STORE_ADDR = '$storeAddress'";


  if ($result = mysqli_query($link, $qry)) {                // Implement the query
    if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
      $res = mysqli_fetch_assoc($result);
      return $res['ORD_NUM'];
    }
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;

  }
}


function getOrders($driverEmail) {
  //      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Database Query's    ***
  $qry = "SELECT * FROM ORDERED WHERE ORD_DRIVER = '$driverEmail'";


  if ($result = mysqli_query($link, $qry)) {                // Implement the query
    if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
      $res = mysqli_fetch_assoc($result);
      return $res;
    }
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;

  }
}

function getItems($orderNumber){
  //      *** Establish a connection to the database  ***
  $link = dbConnect();

//      *** Database Query's    ***
  $qry = "SELECT * FROM ITEMS WHERE ORD_NUM = '$orderNumber'";


  if ($result = mysqli_query($link, $qry)) {                // Implement the query
    if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
      $res = mysqli_fetch_assoc($result);
      return $res;
    }
  }else {
    echo "Error: " . $qry . "<br>" . mysqli_error($link);
    $link->close();
    return false;

  }
}