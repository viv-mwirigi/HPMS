<?php

require_once "databasecon.php";

$username = $_POST['username'] ?? null;
$imagePath = '';
// echo '<pre>';
// echo print_r($_POST);
// echo '</pre>';
if(!$username){
    header('Location: managepatients.php');
    exit;
}

$statement = $pdo->prepare("DELETE FROM patients WHERE name=:username");
$statement->bindValue(':username', $username);
$statement->execute();
header('Location: managepatients.php');