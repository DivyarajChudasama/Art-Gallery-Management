<?php
if(!isset($_SESSION)){session_start();}
include 'connect.php';
$pdo->query("USE my_gallery1");

    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Check if email and password are correct
    $stmt = $pdo->prepare("SELECT * FROM data1 WHERE email=:email AND password=:password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $status = $row['status'];
        $_SESSION["SessUsername"]=$row["username"];
        // Check the status column of the table
        if ($status == 0) {
            header("Location: Home.php");
            exit();
        } else {
            header("Location: dash\shipping.php");
            exit();
        }
    } else {
         header("login1.php");
         exit();
         echo "<script>alert('Incorrect Password or Email')</script>";

        // alert("Incorrect email or password");
    }


$conn = null;
?>