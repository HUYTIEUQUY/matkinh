<?php 


    session_start();

    if(isset($_GET['MaSP']) & !empty($_GET['MaSP'])){
        $items = $_GET['MaSP'];
        
        if(isset($_GET['quanity']) & !empty($_GET['quanity'])){
            $newquanitys = $_GET['quanity'];

            // $newquantity[1] = 2;
            // echo $newquantity[1];

            // echo $newquantitys[4];

            $cart = $_SESSION['cart'];
            foreach($cart as $key => $value){
                if($key==$items[$key]){
                    $quanity = $newquanitys[$items[$key]];
                    // echo '----'.$item.'so luong sau khi tang'.$quantity;
                    $_SESSION['cart'][$items[$key]] = $quanity;
                }
            }
        }
        header('location:giohang.php');
    }else{
        header('location:giohang.php');
    }
?>