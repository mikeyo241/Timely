<?php

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



function reDir($location) {
  header("Location: $location");
}
