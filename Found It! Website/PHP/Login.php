<?php
session_start();

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $conn = new mysqli('localhost', 'root', '', 'jojay-test');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } 
    else{
        $stmt = $conn->prepare("SELECT * FROM registration WHERE Username = ?");
        $stmt->bind_param("s", $Username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if ($user['Password'] == $Password) {
                
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $Username;
                header("Location: ../HTML/Listings.html"); 
                exit();
            } else {
               
                $error = "Incorrect password";
            }
        } else {
            
            $error = "Username not found";
        }

        echo "<script>alert('$error');</script>";
        echo "<script>window.location.href = '../HTML/Login.html';</script>";
        
        $stmt->close();
        $conn->close();
    }
}
?>
