<?php
// echo '<pre>';
//     echo print_r($_POST);
//     echo '</pre>';
//     exit;
require_once "databasecon.php";
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username=$_GET['name'];
    $temp = $username;
    $checkAccounts = $pdo->prepare("SELECT * FROM patients where name= :name");
    $checkAccounts->bindValue(":name", $username);
    $checkAccounts->execute();
    $results = $checkAccounts->fetch();
}

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $temp = $_GET['name'];
        $statement = $pdo->prepare("UPDATE patients SET name=:name, password=:password where name = '$temp'");
    $statement->bindValue(':name', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();

    
    header("Location: patients.php?name=$username");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<section class="form signup">
      <header>Patient Signup</header>
      <form action="myprofile.php?name=<?php echo $temp;?>" method="POST">
        <div class="name-details">
          <div class="field input">
            <lable>Edit Name</lable>
            <input type="text" name="name" value="<?php echo $results['name']; ?>">
          </div>
        </div>
        <div class="field input">
          <lable>Change Password</lable>
          <input type="password" name="password" value="<?php echo $results['password']; ?>">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Save">
        </div>
      </form>
    </section>
</body>
</html>