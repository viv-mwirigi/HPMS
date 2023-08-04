<?php
require_once "databasecon.php";

if($_SERVER['REQUEST_METHOD'] === 'GET') {

$username = $_GET['name'];
$statement  =$pdo->prepare('SELECT * FROM diagnosis where username = :username');
$statement->bindValue(":username", $username);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
$isGetandEmpty =0;

if(empty($users)){
    $statement  =$pdo->prepare('SELECT * FROM appointments where username = :username');
    $statement->bindValue(":username", $username);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    $isGetandEmpty = 1;
} else {
    $statement  =$pdo->prepare('SELECT * FROM diagnosis where username = :username');
$statement->bindValue(":username", $username);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
}

}



if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $doctor = $_POST['doctor'];
    $patient = $_POST['patient'];
    $diagnosis = $_POST['diagnosis'];
    $fees = $_POST['fees'];
    $symptoms = $_POST['symptoms'];
    $illness = $_POST['illness'];
    $treatment = $_POST['treatment'];
    $treatmentdesc = $_POST['treatmentdesc'];
    $drugname = $_POST['drugname'];
    $drugdosage = $_POST['drugdosage'];

    // echo '<pre>';
    // echo print_r($inputArray);
    // echo '</pre>';
    // exit;

$statement  =$pdo->prepare('SELECT * FROM diagnosis where username = :username');
$statement->bindValue(":username", $username);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if(empty($users)){
    $statement = $pdo->prepare("INSERT INTO diagnosis(username, patient, doctor, diagnosis, illness, symptoms, treatment, treatmentdesc, drugname, drugdosage, fees)
                                            values(:username, :patient, :doctor, :diagnosis, :illness, :symptoms, :treatment, :treatmentdesc, :drugname, :drugdosage, :fees)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':patient', $patient);
    $statement->bindValue(':symptoms', json_encode($symptoms));
    $statement->bindValue(':treatment', json_encode($treatment));
    $statement->bindValue(':treatmentdesc', json_encode($treatmentdesc));
    $statement->bindValue(':drugname', json_encode($drugname));
    $statement->bindValue(':drugdosage', json_encode($drugdosage));
    $statement->bindValue(':doctor', $doctor);
    $statement->bindValue(':illness', $illness);
    $statement->bindValue(':diagnosis', $diagnosis);
    $statement->bindValue(':fees', $fees);
    $statement->execute();
    header("Location: diagnosis.php?name=$doctor");
} else {
    $statement = $pdo->prepare("UPDATE diagnosis SET diagnosis = :diagnosis, illness = :illness, symptoms = :symptoms, treatment = :treatment, treatmentdesc = :treatmentdesc, drugname = :drugname, drugdosage = :drugdosage, fees = :fees where username = :username");
    $statement->bindValue(':diagnosis', $diagnosis);
    $statement->bindValue(':symptoms', json_encode($symptoms));
    $statement->bindValue(':treatment', json_encode($treatment));
    $statement->bindValue(':treatmentdesc', json_encode($treatmentdesc));
    $statement->bindValue(':drugname', json_encode($drugname));
    $statement->bindValue(':drugdosage', json_encode($drugdosage));
    $statement->bindValue(':illness', $illness);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':fees', $fees);
    $statement->execute();
    header("Location: diagnosis.php?name=$doctor");
}

    
    
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
    <title>Edit patient diagnosis</title>
    
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="js/jquery-3.6.3.min.js" ></script>

    <script>
        $(document).ready(function(){
            var maxField = 10;
            var addButton_1 = $('.add_button_1');
            var addButton_2 = $('.add_button_2');
            var addButton_3 = $('.add_button_3');
            var wrapper1 = $('.wrapper1');
            var wrapper2 = $('.wrapper2');
            var wrapper3 = $('.wrapper3');
            var fieldHtml1 = '<div class="form-group"><input class="form-control" name="symptoms[]" type="text" value=""></input><a href="javascript:void(0)" class="remove_button_1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg></a></div>';
            var fieldHtml2 = '<div class="form-group"><small class="text-muted">Treatment name</small><input class="form-control" name="treatment[]" type="text" value=""></input><small class="text-muted">Treatment description</small><input class="form-control" name="treatmentdesc[]" type="text" value=""></input><a href="javascript:void(0)" class="remove_button_2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg></a></div>';
            var fieldHtml3 = '<div class="form-group"><small class="text-muted">Drug name</small><input class="form-control" name="drugname[]" type="text" value=""></input><small class="text-muted">Dosage</small><input class="form-control" name="drugdosage[]" type="text" value=""></input><a href="javascript:void(0)" class="remove_button_3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16"><path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/></svg></a></div>';

            //once add button is clicked
            $(addButton_1).click(function(){
                $(wrapper1).append(fieldHtml1);
            });

            //once remove button is clicked
            $(wrapper1).on('click', '.remove_button_1', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            })

            //once add button is clicked
            $(addButton_2).click(function(){
                $(wrapper2).append(fieldHtml2);
            });

            //once remove button is clicked
            $(wrapper2).on('click', '.remove_button_2', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            })
            //once add button is clicked
            $(addButton_3).click(function(){
                $(wrapper3).append(fieldHtml3);
            });

            //once remove button is clicked
            $(wrapper3).on('click', '.remove_button_3', function(e){
                e.preventDefault();
                $(this).parent('div').remove();
            })
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="push-in">
        <h1>Make Diagnosis</h1>
        <?php foreach($users as $i => $user): ?>
        <form action="editdiagnosis.php?name=<?php if(empty($users)){ echo $user['username']; } else { echo $user['username'];} ?>" method="post">
            <div class="form-group">
                <input class="form-control" name="username"  type="text" value="<?php echo $user['username']; ?>" readonly  hidden></input>
            </div>
            <div class="form-group">
                <input class="form-control" name="doctor"  type="text" value="<?php echo $user['doctor']; ?>" readonly  hidden></input>
            </div>
            <div class="form-group">
                <label>Patients name</label>
                <input class="form-control" name="patient" type="text" value="<?php if($_SERVER['REQUEST_METHOD'] === 'GET' && $isGetandEmpty === 1){ echo $user['firstname']." ".$user['lastname']; } else { echo $user['patient'];} ?>" readonly></input>
            </div>
            <div class="form-group">
                <label>Illness</label>
                <input class="form-control" name="illness" type="text" value="<?php if($_SERVER['REQUEST_METHOD'] === 'GET' && $isGetandEmpty === 1){ echo $user['firstname']." ".$user['lastname']; } else { echo $user['patient'];} ?>"></input>
            </div>
            <div class="form-group wrapper1">
                <div class="row">
                <label>Symptoms</label>
                <a href="javascript:void(0);" class="add_button_1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            </a>
                </div>
            </div>
            <div class="form-group wrapper2">
                <div class="row">
                <label>Treatment</label>
                <a href="javascript:void(0);" class="add_button_2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            </a>
                </div>
            </div>
            <div class="form-group wrapper3">
                <div class="row">
                <label>Medication</label>
                <a href="javascript:void(0);" class="add_button_3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            </a>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description of condition.</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="diagnosis" value=""><?php if($_SERVER['REQUEST_METHOD'] === 'GET' && $isGetandEmpty === 1){ echo " "; } else { echo $user['diagnosis'];} ?></textarea>
            </div>
            <div class="form-group">
                <label>Medical Fee</label>
                <input class="form-control" name="fees" type="number" step="0.01" value="<?php if($_SERVER['REQUEST_METHOD'] === 'GET' && $isGetandEmpty === 1){ echo "0"; } else { echo $user['fees'];} ?>"></input>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <?php endforeach; ?>
        </div>
    </div>
   

    <script src="/project/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>
</html>