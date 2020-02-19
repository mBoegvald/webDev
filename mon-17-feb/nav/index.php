<?php
session_start();
$_SESSION['index'] = $_SESSION['index']+1;

$sInjectTitle = 'Home';

    $sInjectActiveLink = 'home';

    require_once("top.php");

$sInjectJS = 'index';

    require_once("bottom.php");