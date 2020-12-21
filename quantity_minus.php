<?php
session_start();
if (isset($_SESSION['cart'])) {
	if (!empty($_SESSION['cart'])) {
		$cart_row= (isset($_GET['cart_row'])) ? (int)$_GET['cart_row'] : 0;
		$count=$_SESSION['cart'][$cart_row]['quantity'];
		if ($count > 1) {
			$count--;
		}
		$_SESSION['cart'][$cart_row]['quantity']=$count;
		header("location: cart-ar.php");
	}else {
		header("location: cart-ar.php");
	}
}else {
	header("location: cart-ar.php");
}

