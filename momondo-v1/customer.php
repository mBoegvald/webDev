<?php 
require_once('has-access.php');
$sName = $_SESSION['sName'];
require_once('top.php');
?>
    <div id="admin">
        <h1>Customer page</h1>
        <p>Hi, <?=$sName;?></p>
    </div>
</body>
</html>