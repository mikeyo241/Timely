<?php


require('../semantics3-php/lib/Semantics3.php');
function searchItems($qry)
{
# Set up a client to talk to the Semantics3 API using your Semantics3 API Credentials
  $key = 'SEM34EC3B420DF27002D6B5785CF9BE3B16D';
  $secret = 'ZDlhY2Q2MTE0NDE4NDc4NzZmM2U3NTU5YjkxYTNiZWQ';

  $requestor = new Semantics3_Products($key, $secret);


# Build the request
  $requestor->products_field("search", "$qry");

# Run the request
  $results = $requestor->get_products();

# View the results of the request
  echo $results;

}