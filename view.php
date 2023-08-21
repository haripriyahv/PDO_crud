<?php

require 'connection.php';

$query = "SELECT * from emp_details ";
$statement = $conn->prepare($query);
$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <div class='container-fluid w-50 mt-5' >
        <p>EMPLOYEE DETAILS</p>
    <table class='table table-striped mt-2'>
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th colspan=4>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($user as $data): ?>
            <tr>
                <td><?=$data->stud_id; ?></td>
                <td><?=$data->name; ?></td>
                <td><?=$data->email; ?></td>
                <td><a href="edit.php?id=<?=$data->id;?> "class='btn btn-success'>EDIT</a></td>
                <td>
                    <form action="delete.php" method="POST">
                        <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure?')" value="<?=$data->id; ?>">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>     
            <?php endforeach?>     
        </tbody>
    </table>
    </div>
</body>
</html>