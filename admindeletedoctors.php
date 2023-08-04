<?php

require_once "databasecon.php";

$username = $_POST['username'] ?? null;
$imagePath = '';
// echo '<pre>';
// echo print_r($_POST);
// echo '</pre>';
if(!$username){
    header('Location: managedoctors.php');
    exit;
}

$statement = $pdo->prepare("DELETE FROM doctor WHERE username=:username");
$statement->bindValue(':username', $username);
$statement->execute();
header('Location: managedoctors.php');