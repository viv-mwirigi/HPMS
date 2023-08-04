<?php

require_once "databasecon.php";

$username = '%'.$_GET['name'].'%';

$statement  =$pdo->prepare("SELECT * FROM appointments where doctor like :username");
$statement->bindValue(":username", $username);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $doctor = $_POST['doctor'];
    $time = $_POST['time'];
    

    $statement = $pdo->prepare("UPDATE appointments SET time = :time where username = :username");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':time', $time);
    $statement->execute();
    header("Location: doctorsappointments.php?name=$doctor");
    
    // $checkAccounts = $pdo->prepare("SELECT * FROM patients");
    // $checkAccounts->execute();
    // $results = $checkAccounts->fetchAll();
    // $usernameCount = 0;
    // $emailCount = 0;

    // echo '<pre>';
    // echo print_r($results);
    // echo '</pre>';

    // foreach($results as $i => $result){
    //     if($result['name'] === $username) {
    //         $usernameCount = 1;
            
    //     }

    //     if($result['email'] === $email) {
    //         $emailCount = 1;
            
    //     }
    // }
    
    // if($usernameCount === 1) {
    //     $errors[] = 'Username already exists.';
    // } 

    // if($emailCount === 1) {
    //     $errors[] = 'Email already exists';
    // }

   
   
    // if($usernameCount === 0 && $emailCount === 0)
    // {
    //     $statement->execute();
    //     header("Location: patients.php?name=$username");
    // }

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="push-in">
        <h1>Choose Patient</h1>
        <?php foreach($users as $i => $user): ?>
        <form action="editdiagnosis.php?name=<?php echo $user['username']; ?>" method="get">
        <div class="form-group">
                <input class="form-control" name="name"  type="text" value="<?php echo $user['username']; ?>" readonly  hidden></input>
            </div>
          <div class="form-group">
                <label>Patients name</label>
                <input class="form-control" name="firstname" type="text" value="<?php echo $user['firstname']; ?><?php echo " ".$user['lastname']; ?>" readonly></input>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Make diagnosis</button>
        </form>
        <?php endforeach; ?>
        </div>
        <br>
        <a href="/project/doctors.php?<?php echo $_SERVER['QUERY_STRING']; ?>" type="submit" class="btn btn-primary">Back to dashboard</a>
    </div>
   

    <script src="/project/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>
</html>