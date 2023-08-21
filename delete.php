<?php
require "connection.php";
 
if(isset($_POST['delete'])){
    $id=$_POST['delete'];
    try{
        $query  = "DELETE from emp_details where id=:id";
        $statement = $conn->prepare($query);
        $del = $statement->execute([':id'=>$id]);
        if($del){
            echo "<script type='text/javascript'>alert('DELETED SUCCESSFULLY')</script>";
                header('location:view.php');
                exit(0);
        }else{
            echo "<script type='text/javascript'>alert('UNSUCCESSFULL')</script>";
            header('location:view.php');
            exit(0);
        }
    }
    catch(PDOExpection $e){
        echo $e->getmessage();
    }
}
?>