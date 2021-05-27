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


<script >

    	function cong()
        {
          var t =  document.getElementById("sl").value;
          document.getElementById("sl").value=parseInt(t)+1;
        }

        function tru()
        {
          var t =  document.getElementById("sl").value;
          if(parseInt(t)>1){
          document.getElementById("sl").value=parseInt(t)-1;
          }
        }
</script>

</head>
<body>
<div class="container">
<?php
include('connect.php');
include('template\nav.php');
include('template\header.php');

?>

    <div class="row" style="margin-top:50px;">
    <br>

      <h4 STYLE="margin-bottom: 30px;">THÔNG TIN CHI TIẾT </h4>
    <form action="addtocart.php" method="GET">

        <?php

                if(isset($_GET['MaSP'])) {
                    $ma = $_GET['MaSP'];
                    $sql = "SELECT * FROM SanPham where MaSP=$ma";
                    $res=mysqli_query($connection,$sql);
                    $r=mysqli_fetch_array($res);
                    $maloai=$r['MaLoai'];
        ?>


 
  
  <table style="width: 900px; margin-left: 100px;">
      <tr >
      <td rowspan="5"><img style="height: 400px; width: 300px;" src="img/<?php echo $r['Anh'] ?>" alt="<?php echo $r['TenSP'] ?> ">  
        </td>
        <td style="width:50px;" rowspan="5"></td>

        <td style="width:200px;">Tên Sản Phẩm :</td>
        <td><?php echo $r['TenSP'] ?></td>
      </tr>
      <tr>
            <td>Mô tả :</td>
            <td ><?php echo $r['MoTa'] ?></td>
      </tr>
      <tr>
            <td>Tình Trạng :</td>
            <td ><?php if($r['status']==1){echo "Còn"; }else{echo "Hết";}?></td>
      </tr>
      <tr>
      <input type="hidden" name="MaSP" value="<?php  echo $r['MaSP']?>">
        
      </tr>
      <tr>
      <td>Số lượng:
                        <input type="button" value="-"  onclick="tru()" style="width: 30px;">
                        <input type="number" value="1" min ="1" class="count" id="sl" name="quanity" style="width:30px; padding:3px 6px;" >
                        <input type="button" value="+" onclick="cong()" style="width: 30px;">
                    </td>
      <td><button style="margin-left: 100px;" type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button></td>
      </tr>
        
    
       
       </table></form>

<?php }  ?>

    </div>
</div>

<div class="container">

<h4 style="margin-top:150px; margin-bottom:30px; ">SẢN PHẨM LIÊN QUAN</h4><br><br>
    <div class="row">
        <?php
        $sql = "select * from sanpham where MaSP !=$ma and MaLoai=$maloai";
        $res = mysqli_query($connection,$sql);
        while ($r = mysqli_fetch_array($res)) {
        ?>
         <div class="col-sm-6 col-md-3">
            <div class="thumbnail" style="height: 400px; width: 250px;" >
               <a href="chitietsp.php?MaSP=<?php  echo $r['MaSP']?>">
               <img style="height: 250px; width: 200px;" src="img/<?php echo $r['Anh'] ?>" alt="<?php echo $r['TenSP'] ?> ">  
               </a>
                <div class="caption">
                    <h5><?php echo $r['TenSP'] ?></h5>
                    <p><?php echo number_format($r['Gia'],'0','','.'); ?>đ</p>
                    <p><a href="addtocart.php?id=<?php echo $r['MaSP']?>" role="button" class="btn btn-info">Thêm vào giỏ hàng</a></p>
                </div>  
            </div>
        </div>
        <?php 
        }
        ?>
    </div>
</div>
       
<?php
           
include('template\footer.php');
?>


</body>





</html>

