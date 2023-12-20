<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="paymentdetails";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn){
    die("Could not connect Database".mysqli_connect_error());
}
?>