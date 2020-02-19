<?php 
    $_SESSION['index'];
    $indexCounter = $_SESSION['index']+1;
    $_SESSION['about'];
    $aboutCounter = $_SESSION['about']+1;
    $_SESSION['signup'];
    $signupCounter = $_SESSION['signup']+1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$sInjectTitle?></title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <nav>
        <div class="<?php echo $sInjectActiveLink == 'home' ? 'active':'';?>">
            <a href="index.php">HOME <?= $indexCounter == '' ? '':$indexCounter ?></a>
        </div>
        <div class="<?php echo $sInjectActiveLink == 'about' ? 'active':'';?>">
            <a href="about-us.php">About us <?= $aboutCounter == '' ? '':$aboutCounter ?></a>
        </div>
        <div class="<?php echo $sInjectActiveLink == 'signup' ? 'active':'';?>">
            <a href="sign-up.php">Sign up <?= $signupCounter == '' ? '':$signupCounter ?></a>
        </div>

    </nav>