<?php
session_start();
if(isset($_GET['MaSP']) & !empty($_GET['MaSP'])){
	$items=$_GET['MaSP'];

//Nếu có số lượng nhập thì lấy theo số lương nhập

	if(isset($_GET['quanity']) & !empty($_GET['quanity'])){
	$quanity=$_GET['quanity'];
}
else//không có thì số lương mặc định là 1
 	$quanity=1;


	 //Nếu session[ơcart] đã tồn tại tìm sp có cùng id để tăng số lượng
if(isset($_SESSION['cart'])){
	$cart= $_SESSION['cart'];
	foreach($cart as $key => $value){
		if($key==$items)
			$quanity=$quanity+$value;
	}
}

	 // Cập nhật biến session[cart]
	 $_SESSION['cart'] [$items] =$quanity;
	
	 header('location: giohang.php');
}else{
header('location: giohang.php');
}



?>