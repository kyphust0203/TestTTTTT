<?php
session_start();
$id = $_GET['id'];
unset($_SESSION['addcart'][$id]);
header('Location:view_cart.php');