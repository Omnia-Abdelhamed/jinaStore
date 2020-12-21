<?php
session_start();
if (isset($_SESSION['cart'])) {
	if (!empty($_SESSION['cart'])) {
		$cart_row= (isset($_GET['cart_row'])) ? (int)$_GET['cart_row'] : 0;
		unset($_SESSION['cart'][$cart_row]);
		header("location: cart-ar.php");
	}else {
		header("location: cart-ar.php");
	}
}else {
	header("location: cart-ar.php");
}

