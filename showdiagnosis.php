<?php
require_once "databasecon.php";

$username = $_GET['name'];
$username = $_GET['name'];
$statement  =$pdo->prepare('SELECT * FROM diagnosis where username = :username');
$statement->bindValue(":username", $username);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
//     echo print_r(json_decode($users[0]['symptoms'], true));
//     echo '</pre>';
//     exit;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <title>Patient's diagnosis</title>
</head>
<body>

<div class="container">
    <div class="card">
    <?php foreach($users as $i => $user): ?>
        <h5 class="card-header">Diagnosis for <?php echo $user['patient']; ?></h5>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Patient name</dt>
                    <dd class="col-sm-9"><?php echo $user['patient']; ?></dd>
                <dt class="col-sm-3">Doctor's name</dt>
                    <dd class="col-sm-9"><?php echo $user['doctor']; ?></dd>
                <dt class="col-sm-3">Illness</dt>
                    <dd class="col-sm-9"><?php echo $user['illness']; ?></dd>
                <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">
                        <p><?php echo $user['diagnosis']; ?></p>
                    </dd>

                <dt class="col-sm-3">Symptoms</dt>
                    <dd class="col-sm-9">
                        <ul>
                        <?php //$numOfSym = count(json_decode($user['symptoms'])); $index = 0; ?>
                        <?php foreach(json_decode($user['symptoms']) as $key => $value): ?>
                            <?php echo "<li>".$value."</li>"; ?>
                        <?php endforeach; ?>
                        </ul>
                    </dd>

                <dt class="col-sm-3">Treatment</dt>
                    <dd class="col-sm-9">
                        <dl class="row">
                            <ul><?php $index = 0; ?>
                            <?php foreach(json_decode($user['treatment']) as $key => $value): ?>
                                <?php echo "<li><dt class=\"col-sm-4\">".$value."</dt>"; ?>
                                    <?php foreach(json_decode($user['treatmentdesc']) as $key => $value): ?>
                                        <?php $obj = json_decode($user['treatmentdesc']); echo "<dd class=\"col-sm-8\">".$obj[$index]."</dd></li>"; $index++; break;?>
                                    <?php endforeach; ?>
                            <?php endforeach; ?>
                                
                            </ul>  
                        </dl>
                    </dd>
                    <dt class="col-sm-3">Prescribed drugs</dt>
                    <dd class="col-sm-9">
                        <ul><?php $index = 0; ?>
                            <?php foreach(json_decode($user['drugname']) as $key => $value): ?>
                                <?php echo "<li><dt class=\"col-sm-4\">".$value."</dt>"; ?>
                                    <?php foreach(json_decode($user['drugdosage']) as $key => $value): ?>
                                        <?php $obj = json_decode($user['drugdosage']); echo "<dd class=\"col-sm-8\">".$obj[$index]."</dd></li>"; $index++; break;?>
                                    <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </dd>
            </dl>
            
        </div>
        <div class="card-footer text-muted">
            Report generated from database.
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>