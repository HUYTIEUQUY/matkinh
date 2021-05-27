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

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/soluong.css">

</head>
<body>
<div class="container">
<?php
include('connect.php');
include('template\nav.php');
include('template\header.php');
                if(isset($_GET['MaDH'])) {
                    $dh = $_GET['MaDH'];
                    $sql = "SELECT * FROM chitiethoadon c, sanpham s where MaDH=$dh and c.MaSP=s.MaSP";
                    $res=mysqli_query($connection,$sql);

                    $r=mysqli_fetch_array($res);
                   
        ?>

 

<table class="table table-hover">
<tr >
   <td style="text-align:center;">Mã đơn hàng</td>
   <td style="text-align:center;">Sản phẩm</td>
    <td style="text-align: center;">Ảnh</td>
    
    <td style="text-align:center;">Giá</td>
    <td style="text-align: center;" >Số lượng</td>
    
   </tr>
   <tr>
       <td></td>
   </tr>
      <tr class="active">
        <td style="text-align: center"><?php echo $r['MaDH'];?></td>
      
        <td  style="text-align: center"><?=$r['TenSP'];?></td>
        <td  style="text-align: center"><img src="img/<?=$r['Anh']?>"></td>
        <td  style="text-align: center;"><?=$r['Gia'];?></td>
        <td  style="text-align: center;"><?=$r['SoLuong'];?></td>
      </tr>
     
</table>
      

<?php 
    }
 
 ?>


<?php
           
include('template\footer.php');
?>
 </div>
</body>
</html>

