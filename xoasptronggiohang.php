<?php
session_start();
if(isset($_GET['remove']) & !empty($_GET['remove'])){
    $ma = $_GET['remove'];
    unset($_SESSION['cart'][$ma]);
    header(('location: giohang.php'));
}
?>