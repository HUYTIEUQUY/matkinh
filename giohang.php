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
<?php
session_start();
?>
<div  class="container">
<?php
include('template\nav.php');
include('template\header.php');

require('connect.php');


?>

<table  class="table table-hover">
   <tr style="text-align: center;">
   <th></th>
   <th>STT</th>
   <th>ẢNH</th>
    <th>Tên sản phẩm</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
    <th>Hành động</th>
   </tr>
   <!-- //Khởi tạo total -->
   
   <?php
   $total=0;
   $i=1;


    if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
        $iditemaray=$_SESSION['cart'];
        foreach($iditemaray as $ma=>$quanity){
            $sql = "select * from sanpham where MaSP=$ma";
            $res=mysqli_query($connection,$sql);
            $r=mysqli_fetch_array($res);


           
        
    
    ?>
   <!-- //Đọc sesion -->
   <form action="updatecart.php" method="get">
   <tr>
        <td><input type="hidden" name="MaSP[<?php echo $r['MaSP'] ?>]" value="<?php echo $r['MaSP'] ?>">
        <input type="checkbox" name="mua[<?php echo $r['MaSP'] ?>]"  size="6" style="margin-top: 30px;"></td>
        <td ><p style="margin-top: 30px;"><p ><?php  echo $i;  ?></p></td>
        <td> <img style="height: 100px; width: 80px;" src="img/<?php echo $r['Anh'] ?>" alt="<?php echo $r['TenSP'] ?> ">  </td>
        <td><p style="margin-top: 30px;"><?php  echo $r['TenSP'];?></p></td>
        <td><p style="margin-top: 30px;"><?php echo number_format($r['Gia'],'0','','.'); ?></p></td>
        <td ><input type="hidden" name="MaSP[<?php echo $r['MaSP'] ?>]" value="<?php echo $r['MaSP'] ?>">
        <input style="width: 40px; margin-top: 20px;" aria-label="quanity" class="input-qty"  min="1" name="quanity[<?php echo $r['MaSP'] ?>]" type="number" value="<?php echo $quanity; ?>" ></td>
        <td><p style="margin-top: 30px;"><?php  echo number_format($r['Gia']*$quanity,'0','','.');?></p></td>
        <td ><a href="xoasptronggiohang.php?remove=<?php echo $ma;?>" style="margin-top: 30px; " class="btn btn-danger">remove</a></td>
   </tr>
   <?php
    $total+=$r['Gia']*$quanity;
    $i+=1;
  
   
    
        } 
       
    }
   ?>
   
   <tr>
   <td  colspan="5">Tổng tiền</td>
    <td ><b><?php echo number_format($total,'0','','.'); ?></b></td>
    <td><button type="submit" class="btn btn-warning">Cập nhật</button></button></td>
    <td><a href="muahang.php" class="btn btn-info">Mua hàng</a></td>
   </tr>
   </form>
</table>

</div>
<?php
include('template\footer.php');
?>

</body>
</html>

