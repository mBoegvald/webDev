<?php 
try{
    $dbUserName = 'root';
    $dbPassword = '';
    $connection = 'mysql:host=localhost; dbname=crud; charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //TRY CATCH
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ //ALLOWS JSON
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //ALLOWS ASSOSIATIVE
    ];
    $db = new PDO($connection, $dbUserName, $dbPassword, $options);
}catch(PDOExecption $ex){
echo $ex;
}


?>