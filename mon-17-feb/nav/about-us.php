<?php
    session_start();
    $_SESSION['about'] = $_SESSION['about']+1;


    $aboutCounter = $_SESSION['about'];

    $sInjectTitle = 'About us';
    $sInjectActiveLink = 'about';

    require_once("top.php");
    $sInjectJS = 'about-us';
    require_once("bottom.php");