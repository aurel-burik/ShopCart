<?php
$currency = '&#8377; '; //Currency Character or code
$db_username = 'root';
$db_password = '';
$db_name = 'production';
$db_host = 'localhost';
$shippingcost      = 1.33; //shipping cost
$taxes              = array( //List your Taxes percent here.
                            'VAT' => 24, 
                            'Service Tax' => 5
                            );						
//connect to MySql						
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>