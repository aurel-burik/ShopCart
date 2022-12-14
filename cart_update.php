<?php
session_start();
include_once("config.php");
if(isset($_POST["type"]) && $_POST["type"]=='update' && $_POST["product_quantity"]>0)
{
	foreach($_POST as $key => $value){ //add all post vars to new_product array
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
	//remove unecessary vars
	unset($new_product['type']);
	unset($new_product['return_url']); 
	
    $statement = $mysqli->prepare("SELECT product_name, price FROM products WHERE product_code=? LIMIT 1");
    $statement->bind_param('s', $new_product['product_code']);
    $statement->execute();
    $statement->bind_result($product_name, $price);
	
	while($statement->fetch()){
		
		//fetch product name, price from db and add to new_product array
        $new_product["product_name"] = $product_name; 
        $new_product["product_price"] = $price;
        
        $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
    } 
}
//update or remove items 
if(isset($_POST["product_quantity"]) || isset($_POST["remove_code"]))
{
	//update item quantity in product session
	if(isset($_POST["product_quantity"]) && is_array($_POST["product_quantity"])){
		foreach($_POST["product_quantity"] as $key => $value){
			if(is_numeric($value)){
				$_SESSION["cart_products"][$key]["product_quantity"] = $value;
			}
		}
	}
	//remove an item from product session
	if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
		foreach($_POST["remove_code"] as $key){
			unset($_SESSION["cart_products"][$key]);
		}	
	}
}

$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);
?>