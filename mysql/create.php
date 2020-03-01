<?php
require_once('db.php');
try{
// POST
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$q = $db->prepare('INSERT INTO users VALUES(:id, :name, :email, :password)');
$q->bindValue(':name',  $name);
$q->bindValue(':id',  null);
$q->bindValue(':email',  $email);
$q->bindValue(':password',  $password);
$q->execute();
echo 'User ID: '.$db->lastInsertId();
}catch(PDOException $ex) {
    echo $ex;
}