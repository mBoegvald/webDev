<?php 
require_once('db.php');
try{
    $q = $db->prepare('SELECT * FROM users');
    $q->execute();
    $data = $q->fetchAll(); // [{},{}]
    echo 'Hi '.$data[0]->name; // PDO::FETCH_OBJ
    // echo 'Hi '.$data[0]['name']; // PDO::FETCH_ASSOC

    // echo json_encode($data);
}catch(PDOException $ex){
    echo $ex;
}