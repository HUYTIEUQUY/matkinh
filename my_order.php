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



</head>
<body>
<div  class="container">
<?php

include('connect.php');
include('template\header.php');
include('template\nav.php');
?>
<h3>Billing Details</h3>

    <table class="table table-hover">
<tr >
   <td style="text-align:center;">Mã đặt hàng</td>
   <td style="text-align:center;">Ngày</td>
    <td style="text-align: center;">Phương thức thanh toán</td>
    
    <td style="text-align:center;">Tổng</td>

    
   </tr>
   <tr>
       <td></td>
   </tr>


<?php
    $sql = "select * from dathang";
    $res = mysqli_query($connection,$sql);
    while($r=mysqli_fetch_array($res)) {
      ?>
      <tr class="active">
        <td style="text-align: center"><?=$r['MaDH'];?></td>
      
        <td  style="text-align: center"><?=$r['timestamp'];?></td>
        <td  style="text-align: center"><?php if($r['PTThanhToan']=='cod'){echo'Trực tiếp';}else{echo'Paypal';}?></td>
        <td  style="text-align: center;"><?=$r['TongTien'];?></td>
       
      </tr>
     <?php
    }
    ?>
</table>



<?php
include('template\footer.php');
?>
</div>
</body>
</html>

