<?php
session_start();

if(!$_SESSION['auth']){
    header('location:SignIn.php');
}else{
    // switch ($_SESSION['role']) {
    //     case 'Tenant':
    //         header('location:../WebContent/home.php');
    //         break;
    //      case 'Plot Owner':
    //         header('location:../WebContent/house_reg.php');
    //         break;
    //     default:
    //         echo "Unregistered";
    //         break;
    // }
    /*
    echo $_SESSION['username'];
    echo $_SESSION['role'];
    */
}
?>
