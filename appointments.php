<?php

require_once "databasecon.php";


$statement  =$pdo->prepare('SELECT * FROM doctor');
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);



if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $email= $_POST['email'];
    $age = $_POST['age'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $doctor = $_POST['doctor'];
    $time = $_POST['time'];
    

    $statement = $pdo->prepare("INSERT INTO appointments(username, firstname, lastname, email, age, doctor, time) 
                            VALUES(:username, :firstname, :lastname, :email, :age, :doctor, :time)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':doctor', $doctor);
    $statement->bindValue(':age', $age);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':time', $time);
    $statement->execute();
    header("Location: patients.php?name=$username");
    
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
        <h1>Create new appointment</h1>
        <form action="appointments.php" method="post">
        <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="username" type="text" value=""></input>
            </div>
          <div class="form-group">
                <label>First name</label>
                <input class="form-control" name="firstname" type="text" value=""></input>
            </div>
            <div class="form-group">
                <label>Last name</label>
                <input class="form-control" type="text" name="lastname" value="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="">
            </div>
            <div class="age">
                <label>Age</label>
                <input class="form-control" type="text"  name="age" value="">
            </div>
            <div class="doctor">
                <label>Doctor</label>
                <br>
                <select name="doctor" required>
                <option value="">Select a doctor to set appointment</option>
                <?php foreach($users as $i => $user): ?>
                <option value="Dr. <?php echo $user['firstname']." - "; ?><?php echo $user['specialty'] ?> ">Dr. <?php echo $user['firstname'] ?> - <?php echo $user['specialty'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="age">
                <label>Time</label>
                <input class="form-control" type="datetime-local" name="time" value="" min="<?php echo date("Y-m-d"); ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-success">Create Appointment</button>
        </form>

        </div>
    </div>
   

    <script src="/project/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>
</html>