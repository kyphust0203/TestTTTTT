<?php
session_start();
$id = $_GET['id'];
if(!isset($_SESSION['addcart'][$id])){
    $_SESSION['addcart'][$id] = 1;
}
else{
    $_SESSION['addcart'][$id]++;
}
header('Location:danhsachsanpham.php');