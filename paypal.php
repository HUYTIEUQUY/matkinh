<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="timkiem.css" type="text/css">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['total'])) // paypal
{
    $tien = $_SESSION['total'];
}
?>
<div class="container">
<?php
include('connect.php');
include('template\nav.php');
include('template\header.php');
?>
<fieldset>
    <legend>
            THANH TOÁN QUA CỔNG PAYPAL
    </legend>
    <!-- nhập địa chir email người nhận tiền -->
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" >
    <!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhấn nút thanh toán -->
        <input type="hidden" name="business" value="sb-qrma476102009@business.example.com">
    <!-- thông tin mua hàng -->
        <input type="hidden" name="cmd" value= "_xclick" >
    <!-- trị giá của giỏ hàng vì paypal không hỗ trọ tiền Việt nên phải đổi ra tiền đô -->

    Số tiền cần thanh toán:<input type="hidden" name="amount" value="<?= $tien*0.87/20000;?>">
   
        <!-- loại tiền -->
        <input type="hidden" name="currency_code" value="USD">
        <!-- đường link cung cấp cho paypal biết để sau khi xử lý thành công nó sẽ chuyển về clik nay -->
        <input type="hidden" name="return" value="http://localhost/matkinh/my_order.php">
        <input type="hidden" name="return" value="http://localhost/matkinh/my_order.php">

        <!-- nút bấm -->
        <input type="submit" name="submit" value="Thanh toán bằng Paypal">
    </form>
</fieldset>
<?php
include('template\footer.php');
?>
</div>
</body>
</html>

