<?php
//tạo kết nối
$connection = mysqli_connect('localhost','root','');
if(!$connection) {   //không kết nối được
	die("KẾT NỐI CSDL KHÔNG THÀNH CÔNG!!!" . mysqli_error($connection));
}
//chọn database
$select_db = mysqli_select_db($connection,'cuahangmatkinh');
if(!$select_db) {
	die("KẾT NỐI CSDL KHÔNG THÀNH CÔNG!!!" . mysqli_error($connection));
}
mysqli_set_charset($connection,'utf8');
?>