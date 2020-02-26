<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momondo</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/momondo-v1/app.css">
</head>
<body>
<?php 
// Get the users status/mode
$mode = 'none';
if(isset($_SESSION['bAdmin'])){
    if($_SESSION['bAdmin']){
       $mode = 'admin';
    }else{
        $mode = 'user';
    }
}
// Create arrays for the 3 different options

$navOptions = [
    'none' => [
        '<nav id="navStandard">',
        '<a href="http://localhost/momondo-v1/index.php" id="logo" class="active">Momondo</a>',
        '<a href="">Fly</a>',
        '<a href="">Hotel</a>',
        '<a href="">Car</a>',
        '<a href="">Trips</a>',
        '<a href="">Discover</a>',
        '<a href="">My trips</a>',
        '<a href="http://localhost/momondo-v1/login.php">Login</a>',
        '</nav>'
    ],
    'user' => [
        '<nav id="navUser">',
        '<a href="http://localhost/momondo-v1/index.php" id="logo" class="active">Momondo</a>',
        '<a href="">Fly</a>',
        '<a href="">Hotel</a>',
        '<a href="">Car</a>',
        '<a href="">Trips</a>',
        '<a href="">Discover</a>',
        '<a href="">My trips</a>',
        '<a href="http://localhost/momondo-v1/logout.php">Logout</a>',
        '</nav>'
    ],
    'admin' => [
        '<nav id="navAdmin">',
        '<a href="http://localhost/momondo-v1/index.php" id="logo" class="active">Momondo</a>',
        '<a href="http://localhost/momondo-v1/admin.php">Edit/Delete flights</a>',
        '<a href="http://localhost/momondo-v1/api/api-create-flight.php">Create flights</a>',
        '<a href="http://localhost/momondo-v1/logout.php">Logout</a>',
        '</nav>'
    ]
];
foreach ($navOptions[$mode] as $option){
    echo $option;
}