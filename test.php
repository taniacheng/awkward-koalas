<?php
include("autoloader.php");
$cart = new ShoppingCart();
echo $cart;

//adding a product with quantity
$cart -> addToCart(66,2);

?>