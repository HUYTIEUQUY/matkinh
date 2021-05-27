<?php
 
if(!empty($_SESSION['cart'])){
  $quantity = count($_SESSION['cart']);
}else{
  $quantity = 0;
}

if(isset($_SESSION['customerid']) && $_SESSION['customerid'] != NULL){
  $users =1;
}else{
  $users =0;
}

?>

<div class="w3-bar  w3-light w3-large" style="margin-bottom: 20px;">
<img class="w3-bar-item w3-button" style="width: 100px; height:50px;" src="img/logo.png" alt="logo">
  <a href="index.php" class="w3-bar-item w3-button">Trang chủ</a>
  <a href="index1.php" class="w3-bar-item w3-button">Kính thời trang</a>
  <a href="index2.php" class="w3-bar-item w3-button">Kính cận</a>
  <a href="index3.php" class="w3-bar-item w3-button">Gọng kính</a>
  <a href="index4.php" class="w3-bar-item w3-button">Tròng kính</a>

  <form class="navbar-form navbar-right" action="/action_page.php">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
      </div>
      <button type="submit" class="btn btn-default">Tìm kiếm</button>
    </form>
  <a href="giohang.php" class="w3-bar-item w3-button navbar-right" > <button  type="button" class="btn btn-primary" >
    <image style="width:20px; height:20px;" src="img/giohang.png"></image> <span class="badge badge-light"style="color: red;" ><?php echo $quantity ?></span>
  </button></a>
</div>



<div class="w3-bar  w3-light" style="margin-bottom: 20px;">

<?php
if($users ==1){
?>
  <div class="nav navbar-nav navbar-right">
  <div class="w3-bar-item w3-button">
  <a href="dangxuat.php"><span class="glyphicon glyphicon-user"></span> Đăng xuất</a>
  </div>
  </div>
  <?php
}else{
  ?>
  <div class="nav navbar-nav navbar-right">
  <div class="w3-bar-item w3-button">
  <a href="dangnhap.php"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
  </div>
  </div>
  <?php } ?>
</div>