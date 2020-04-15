<?php
$jData = $_POST['name'];
$sData = json_encode($jData);

file_put_contents('godnat.json', $sData);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="godnat-post.php" method="POST">
<input type="text" name="name">
<button>SUBMIT</button>
</form>
    
</body>
</html>