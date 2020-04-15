<?php 
require_once('db.php');
try{
    $id = $_GET['id'];
    
     $q= $db->prepare('DELETE FROM users WHERE id = :id');
    $q->bindValue(':id', $id);
    $q->execute();
    echo 'Deleted number of rows: '.$q->rowCount();
}catch(PDOException $ex){
    echo $ex;
}