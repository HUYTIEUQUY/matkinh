<?php
session_start();
require_once 'connect.php';
$email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = htmlspecialchars(addslashes(trim($_POST["email"])));
    $password = htmlspecialchars(addslashes(trim($_POST["password"])));
    //$password = sha1($password);
    $sql_select = "SELECT * FROM users WHERE email = '$email' AND pass = '$password'";
    $result = mysqli_query($connection,$sql_select);
    if($row = mysqli_fetch_array($result))
    {
        $_SESSION['customer'] = $email;
        $_SESSION['customername'] = $row['username'];
        $_SESSION['customerid'] = $row['id'];
        header("location: giohang.php");
    }
    else
    {
        header("location: giohang.php");
    }
}
else
{
    header("location: giohang.php");
}
?>



