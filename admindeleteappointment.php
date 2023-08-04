<?php

require_once "databasecon.php";

$username = $_POST['username'] ?? null;
$imagePath = '';
// echo '<pre>';
// echo print_r($_POST);
// echo '</pre>';
if(!$username){
    header('Location: manageappointments.php');
    exit;
}

$statement = $pdo->prepare("DELETE FROM appointments WHERE username=:username");
$statement->bindValue(':username', $username);
$statement->execute();
header('Location: manageappointments.php');