<?php
session_start();
if(!isset($_SESSION['sName'])) {
    header('Location: login.php');
    exit();
}
// if(isset($_SESSION['bAdmin'])) {
//     if($_SESSION['bAdmin'] == true) {
//         header('Location: admin.php');
//         exit();
//     }else {
//         header('Location: customer.php');
//         exit();
//     }
// }