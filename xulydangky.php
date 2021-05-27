<?php
session_start();
require_once 'connect.php';
$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $email = htmlspecialchars(addslashes(trim($_POST["email"])));
    $username = htmlspecialchars(addslashes(trim($_POST["username"])));
    $password = htmlspecialchars(addslashes(trim($_POST["password"])));
    //$password = sha1($password);
    $sql_select = "insert into users ('username','email','pass') values ('$username','$email','$password') ";
    $result = mysqli_query($connection,$sql_select);
    if($row = mysqli_fetch_array($result))
    {
        $u='Thành công';
        header("location: dangnhap.php");
    }
    else
    {
        header("location: dangnhap.php");
    }
}
else
{
    header("location: dangnhap.php");
}
?>



