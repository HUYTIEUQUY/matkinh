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
<div class="container">
<?php
include('template/nav.php');
?>
</div>
<?php
require('connect.php');
//khach hang chua dang nhap



if(!isset($_SESSION['customer']) || empty($_SESSION['customer'])){
    header('location: dangnhap.php');
}
$uid=$_SESSION['customerid'];
$total=0;
$countproduct=0;

 if(isset($_SESSION['cart'])){
    $cart=$_SESSION['cart'];

    foreach($cart as $ma => $quantity){
        $sql_product="select * from sanpham where MaSP=$ma";
        $res_product=mysqli_query($connection,$sql_product);
        $r_product=mysqli_fetch_assoc($res_product);
        $total = $total + ($r_product['Gia'] * $quantity);
        $countproduct=$countproduct+$quantity;
    }
    $sale="select * from users where id=".$uid;
    $res_sale=mysqli_query($connection,$sale);
    $r_sale=mysqli_fetch_assoc($res_sale);


    if($r_sale['sale']>2){
        $total=$total-($total*(20/100));
        $res_USERS=mysqli_query($connection,"update users set sale = 0 where id = $uid");
    }
    $t = $total;
    $_SESSION['total'] = $t;

    //n????u trang ??u??????c go??i la??i l????n 2(submit b????i form)
    if(isset($_POST) & !empty($_POST) & isset($_POST['agree'])) {
        if($_POST['agree'] == true){ //l????y d???? li?????u t???? form
            $quocgia=$_POST['country'];
            $ho=$_POST['fname'];
            $ten=$_POST['lname'];
            $address=$_POST['address'];
            $city=$_POST['city'];
            $zip=$_POST['zipcode'];
            $mobile=$_POST['phone'];
            $payment=$_POST['payment'];
            $hoten = $ho." ".$ten;


            //kiem tra khach hang ??a?? co?? trong usermeta hay chu??a
            $sql_sel="select * from thongtindathang where uid=$uid";
            $res=mysqli_query($connection,$sql_sel);
            $r=mysqli_fetch_assoc($res); //ma??ng k????t h????p
            $count=mysqli_num_rows($res);

            //??a?? co?? dl khach hang --> c?????p nh?????t dl la??i
            if($count==1){
                $sql_usersmeta="update thongtindathang set QuocGia='$quocgia', HoTen= '$hoten', DiaChi='$address', city='$city', zip='$zip',
                SDT='$mobile' where uid=$uid";
            }else{
                $sql_usersmeta="insert into thongtindathang(QuocGia, HoTen,  DiaChi, city,  zip, SDT, uid)
                values('$country', '$hoten', '$address', '$city','$zip','$mobile',
                '$uid')";
            }

            $res_usersmeta=mysqli_query($connection,$sql_usersmeta);
            //N????u update ho?????c insert KH vao usermeta thanh co??ng
            //--ti??nh t????ng ti????n ???????t ha??ng, insert va??o ba??ng order (??o??n ???????t ha??ng)
            if($res_usersmeta){
                //insert va??o order
                $sql_order="insert into dathang(uid, TongTien, TrangThai, PTThanhToan) values('$uid', '$total', 'Order placed', '$payment')";
                $res_order=mysqli_query($connection,$sql_order);
                //n????u dl vao ba??ng order tha??nh co??ng,insert va??o ba??ng orderitems
                if($res_order){

                    $res_USER=mysqli_query($connection,"update users set sale = sale+1 where id = $uid");
                    if($res_USER){
                            //l????y gia?? tri?? kho??a chi??nh cu??a field v????a insert
                            $orderid= mysqli_insert_id($connection);
                            foreach ($cart as $ma => $quantity) {
                                $sql_product="select * from sanpham where MaSP=$ma";
                                $res_product=mysqli_query($connection,$sql_product);
                                $r_product=mysqli_fetch_assoc($res_product);
                                $productprice=$r_product['Gia'];

                                $sql_orderitems="insert into chitiethoadon(MaSP, SL, MaDH, GiaSP)
                                values($ma, $quantity, $orderid, $productprice)";

                                $res_orderitems=mysqli_query($connection,$sql_orderitems);
                    
                        }
                    }
                        
                    
                }
            }
              //xo??a session 
              unset($_SESSION['cart']);
              ?>
                <?php
                    if(isset($_POST['payment'])){
                        $payment = $_POST['payment'];
                        if($payment=="pal")
                            echo "<script>location.replace('paypal.php');</script>";
                        else
                            echo "<script>location.replace('my_order.php');</script>";
                    }
                
                ?>
                <?php //paypal

        }
    }
}

?>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/modern-business.css" rel="stylesheet">
<div class="container">
<form method="post">
    <div class="row">
        <div class="col-md-offset-3 col-md-6"><h3>Chi ti???t thanh to??n</h3><br>
            <label>Qu???c gia</label>
            <select name="country" class="form-control">
                <option value="">Select Country</option> <option value="VN">Vi?????t Nam</option> <option value="CH">China</option> <option value="TL">ThaiLand</option><option value="LA">L??o</option>
            </select>
            <div class="clearfix space20"></div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>H???</label>
                    <input class="form-control" type="text" name="fname" value=""  required>
                </div>
                <div class="col-md-6">
                    <label>T??n</label>
                    <input class="form-control" type="text" name="lname" value="" required>
                </div>
            </div>
            <div class="clearfix space20"></div><br>
            <label>?????a ch???</label>
            <input type="text" class="form-control" name="address" required>
            <div class="clearfix space20"></div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>City</label>
                    <input class="form-control" type="text" name="city" required>
                </div>
                <div class="col-md-6">
                    <label>Postcode</label>
                    <input class="form-control" type="text" name="zipcode" placeholder="Postcode/Zipcode" value="" required  pattern="[0-9]{2}">
                </div>
            </div>
            <div class="clearfix space20"></div><br>
            <label>S??? ??i???n tho???i : </label>
            <input type="text" class="form-control" name="phone" required pattern="[0-9]{10}" title="Vui l??ng nh???p ????ng s??? ??i???n tho???i">
        </div>                        
    </div>

    </br>

    <div class="row">
        <div class="col-md-offset-1 col-md-10"><h4>????n h??ng c???a b???n</h4><br>
            <table class="table">
                <tr> <!--t????ng gio?? ha??ng-->
                    <th width="30%">Gi??? h??ng ???? t???o</th>
                    <td width="30%"><?php echo $countproduct; ?></td>
                </tr>
                <tr>
                    <td>Free</td>
                </tr>
                <tr>
                    <th>T???ng ????n h??ng</th>
                    <td><?php  echo number_format($total,'0','','.') ." ??";  if($r_sale['sale']>2){echo "  ???? gi???m 20%";} ?>  </td>
                </tr>
            </table>
        </div>
    </div>


    <!--Phu??o??ng th????c thanh toa??n-->

    <div class="row">
        <div class="col-md-offset-1 col-md-5"> <h4>Ph????ng th???c thanh to??n</h4><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <th>V???n chuy???n v?? x??? l?? </th>
            <input type="radio" name="payment" value="cod" checked="checked"> <!--Thanh toa??n khi giao ha??ng -->
            <label>Thanh to??n tr???c ti???p khi nh???n h??ng</label>
            <p>Make your payment directly into our bank account. Please use your
            Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
        </div>
        <div class="col-md-5">
            <input type="radio" name="payment" value="pal">
                            
            <!--Thanh toa??n b????ng ta??i khoa??n Paypal -->
            <label>Paypal</label>
            <p>Thanh to??n qua PayPal; B???n c?? th??? thanh to??n b???ng th??? t??n d???ng c???a m??nh n???u b???n kh??ng c??
             T??i kho???n Paypal</p>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <input type="checkbox" name="agree" value="true" class="css-checkbox">T??i ???? ?????c v?? ch???p nh???n ??i???u ki???n ??i???u kho???n
            <div class="clearfix"></div><br><br>
            <input type="submit" value="Pay Now" class="btn btn-primary"> <div class="clearfix space20"></div><br>
        </div>
    </div>
</form>
</div>
<?php
include('template/footer.php');
?>
</body>
</html>

