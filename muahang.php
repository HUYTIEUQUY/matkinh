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

    //nếu trang được gọi lại lần 2(submit bởi form)
    if(isset($_POST) & !empty($_POST) & isset($_POST['agree'])) {
        if($_POST['agree'] == true){ //lấy dữ liệu từ form
            $quocgia=$_POST['country'];
            $ho=$_POST['fname'];
            $ten=$_POST['lname'];
            $address=$_POST['address'];
            $city=$_POST['city'];
            $zip=$_POST['zipcode'];
            $mobile=$_POST['phone'];
            $payment=$_POST['payment'];
            $hoten = $ho." ".$ten;


            //kiem tra khach hang đã có trong usermeta hay chưa
            $sql_sel="select * from thongtindathang where uid=$uid";
            $res=mysqli_query($connection,$sql_sel);
            $r=mysqli_fetch_assoc($res); //mảng kết hợp
            $count=mysqli_num_rows($res);

            //đã có dl khach hang --> cập nhật dl lại
            if($count==1){
                $sql_usersmeta="update thongtindathang set QuocGia='$quocgia', HoTen= '$hoten', DiaChi='$address', city='$city', zip='$zip',
                SDT='$mobile' where uid=$uid";
            }else{
                $sql_usersmeta="insert into thongtindathang(QuocGia, HoTen,  DiaChi, city,  zip, SDT, uid)
                values('$country', '$hoten', '$address', '$city','$zip','$mobile',
                '$uid')";
            }

            $res_usersmeta=mysqli_query($connection,$sql_usersmeta);
            //Nếu update hoặc insert KH vao usermeta thanh công
            //--tính tổng tiền đặt hàng, insert vào bảng order (đơn đặt hàng)
            if($res_usersmeta){
                //insert vào order
                $sql_order="insert into dathang(uid, TongTien, TrangThai, PTThanhToan) values('$uid', '$total', 'Order placed', '$payment')";
                $res_order=mysqli_query($connection,$sql_order);
                //nếu dl vao bảng order thành công,insert vào bảng orderitems
                if($res_order){

                    $res_USER=mysqli_query($connection,"update users set sale = sale+1 where id = $uid");
                    if($res_USER){
                            //lấy giá trị khóa chính của field vừa insert
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
              //xóa session 
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
        <div class="col-md-offset-3 col-md-6"><h3>Chi tiết thanh toán</h3><br>
            <label>Quốc gia</label>
            <select name="country" class="form-control">
                <option value="">Select Country</option> <option value="VN">Việt Nam</option> <option value="CH">China</option> <option value="TL">ThaiLand</option><option value="LA">Lào</option>
            </select>
            <div class="clearfix space20"></div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>Họ</label>
                    <input class="form-control" type="text" name="fname" value=""  required>
                </div>
                <div class="col-md-6">
                    <label>Tên</label>
                    <input class="form-control" type="text" name="lname" value="" required>
                </div>
            </div>
            <div class="clearfix space20"></div><br>
            <label>Địa chỉ</label>
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
            <label>Số điện thoại : </label>
            <input type="text" class="form-control" name="phone" required pattern="[0-9]{10}" title="Vui lòng nhập đúng số điện thoại">
        </div>                        
    </div>

    </br>

    <div class="row">
        <div class="col-md-offset-1 col-md-10"><h4>Đơn hàng của bạn</h4><br>
            <table class="table">
                <tr> <!--tổng giỏ hàng-->
                    <th width="30%">Giỏ hàng đã tạo</th>
                    <td width="30%"><?php echo $countproduct; ?></td>
                </tr>
                <tr>
                    <td>Free</td>
                </tr>
                <tr>
                    <th>Tổng đơn hàng</th>
                    <td><?php  echo number_format($total,'0','','.') ." Đ";  if($r_sale['sale']>2){echo "  Đã giảm 20%";} ?>  </td>
                </tr>
            </table>
        </div>
    </div>


    <!--Phương thức thanh toán-->

    <div class="row">
        <div class="col-md-offset-1 col-md-5"> <h4>Phương thức thanh toán</h4><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <th>Vận chuyển và xử lý </th>
            <input type="radio" name="payment" value="cod" checked="checked"> <!--Thanh toán khi giao hàng -->
            <label>Thanh toán trực tiếp khi nhận hàng</label>
            <p>Make your payment directly into our bank account. Please use your
            Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
        </div>
        <div class="col-md-5">
            <input type="radio" name="payment" value="pal">
                            
            <!--Thanh toán bằng tài khoản Paypal -->
            <label>Paypal</label>
            <p>Thanh toán qua PayPal; Bạn có thể thanh toán bằng thẻ tín dụng của mình nếu bạn không có
             Tài khoản Paypal</p>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <input type="checkbox" name="agree" value="true" class="css-checkbox">Tôi đã đọc và chấp nhận Điều kiện Điều khoản
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

