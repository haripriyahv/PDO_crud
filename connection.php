<?php
$user = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=form";
try {
    $conn = new PDO($dsn, $user, $password);
        // echo "Connected to the  database successfully!";
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>