<?php

require 'connection.php';

$id1=$_GET['id'];
$query = "SELECT * from emp_details where id=:id";
$stmt = $conn->prepare($query);
$stmt->execute([':id'=>$id1]);
$user=$stmt->fetch(PDO::FETCH_OBJ);
 if(isset($_POST['stud_id']) && (isset($_POST['name'])) && (isset($_POST['email']))){
    $id=$_POST['stud_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];

    $query = "SELECT * from emp_details where stud_id=:stud_id AND id != :current_id LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->execute([':stud_id'=>$id,':current_id'=>$id1]);
    $data =$stmt->fetch(PDO::FETCH_ASSOC);

    if($data){
        echo "<script type='text/javascript'>alert('the id is already exist')</script>";
    }else{
        $query = "SELECT * from emp_details where email=:email AND id != :current_id LIMIT 1";
        $stmt1 = $conn->prepare($query);
        $stmt1->execute([':email'=>$email,':current_id'=>$id]);
        $data1 =$stmt1->fetch(PDO::FETCH_ASSOC);
        if($data1){
            echo "<script type='text/javascript'>alert('the email is already exist')</script>";
        }
        else{
            $update = "UPDATE emp_details SET stud_id=:stud_id,name=:name,email=:email where id=:id";
            $stmt2 = $conn->prepare($update);
            if($stmt2->execute([':id'=>$id1,':stud_id'=>$id,':name'=>$name,':email'=>$email])){
                echo 'updated successfully';
                header("location:view.php");
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
    <title>EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
<div class="container w-25 mt-5">
        <p>EDIT DETAILS</p>
            <form method=post>
                <div class="mb-2">
                    <input type="text" name="stud_id" placeholder="id" class="form-control bg-light" value= "<?= $user->id;?>" >
                </div>
                <div class="mb-2">
                    <input type="text" name="name" placeholder="name" class="form-control bg-light" value="<?= $user->name;?>">
                </div>
                <div class="mb-2">
                    <input type="text" name="email" placeholder="email" class="form-control bg-light"   value="<?= $user->email;?>">
                </div>

                <div class='align-item justify space-evently'>
                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
                  
                </div>
            </form>

    </div>
</body>
</html>