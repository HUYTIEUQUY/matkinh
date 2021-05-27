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
<div class="container">
<?php
include('connect.php');
include('template\nav.php');
include('template\header.php');

?>
<div  style="margin-top: 50px;">
    <div class="row">
        <?php
        $sql = "SELECT * FROM SanPham where MaLoai='3'";
        $res = mysqli_query($connection,$sql);
        while ($r = mysqli_fetch_array($res)) {
        ?>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail" style="height: 400px; width: 250px;" >
               <a href="chitietsp.php?MaSP=<?php  echo $r['MaSP']?>">
               <img style="height: 250px; width: 200px;" src="img/<?php echo $r['Anh'] ?>" alt="<?php echo $r['TenSP'] ?> ">  
               </a>
                <div class="caption">
                    <h4><?php echo $r['TenSP'] ?></h4>
                    <p><?php echo number_format($r['Gia'],'0','','.'); ?>đ</p>
                    <p><a href="addtocart.php?MaSP=<?php echo $r['MaSP']?>" role="button" class="btn btn-info">Thêm vào giỏ hàng</a></p>
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
</div>
</body>
</html>

