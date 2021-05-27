<?php
session_start();
if(isset($_SESSION['customerid']) && $_SESSION['customerid'] != NULL){
//nếu có session tên us thì ta thực hiện lệnh dưới
?>
<p>
Xin chào: 
<?php echo $_SESSION['customer']; ?>
| <a href="index.php">Thoát</a>
<p>
<?php
}
?>