<?php
require_once('db.php');
try{
$id = $_POST['id'];
$name = $_POST['name'];
$q = $db->prepare('UPDATE users SET name = :name WHERE id = :id');
$q->bindValue(':id', $id);
$q->bindValue(':name', $name);
$q->execute();
echo 'Updated rows: '.$q->rowCount();
}catch(PDOException $ex) {
    echo $ex;
}