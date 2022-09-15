<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ecommerce";

//create the connection to database
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

//check the connection
if(!$conn){
  die("Connection fails".mysqli_connect_error());
}
