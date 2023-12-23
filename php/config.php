<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="paymentdetails";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn){
    die("Could not connect Database".mysqli_connect_error());
}
?>