<?php
    session_start();
    $_SESSION['signup'] = $_SESSION['signup']+1;


    $signupCounter = $_SESSION['signup'];


$sInjectTitle = 'Sign up';
 $sInjectActiveLink = 'signup';
    require_once("top.php");
    $sInjectJS = 'sign-up';
    require_once("bottom.php");