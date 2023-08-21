<?php
require "connection.php";

if(isset($_POST['submit'])){
    $id=$_POST['stud_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];

    $query = "SELECT * from emp_details where stud_id = :stud_id LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->execute([':stud_id'=>$id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user){
        echo "<script type='text/javascript'>alert('id already exists')</script>";
        // print_r  ($user);
    }else{
    $query = "SELECT * from emp_details where email = :email LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->execute([':email'=>$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user){
        echo"<script type='text/javascript'>alert('email already exists')</script>";
    }

    else{
    $query = "INSERT INTO emp_details (stud_id,name,email) VALUES (:stud_id,:name,:email)";
        $statement = $conn -> prepare($query);
        if($statement -> execute([':stud_id'=>$id,':name'=>$name,':email'=>$email])){
            echo "<script type='text/javascript'>alert('INSERTED')</script>";
        }
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMP_DETAILS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container w-25 mt-5">
        <p>ENTER DETAILS</p>
            <form method=post>
                <div class="mb-2">
                    <input type="text" name="stud_id" placeholder="id" class="form-control bg-light">
                </div>
                <div class="mb-2">
                    <input type="text" name="name" placeholder="name" class="form-control bg-light">
                </div>
                <div class="mb-2">
                    <input type="text" name="email" placeholder="email" class="form-control bg-light">
                </div>

                <!-- <input type="submit" name="submit" class="btn btn-primary" > -->
                <div class='align-item justify space-evently'>
                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
                    <a href="view.php" class='btn btn-primary'>VIEW</a>
                </div>
            </form>

    </div>
</body>
</html>