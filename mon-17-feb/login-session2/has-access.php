<?php
session_start();
if(!isset($_SESSION['sName'])) {
    header('Location: login.php');
    exit();
}