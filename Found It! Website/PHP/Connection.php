<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fullname = $_POST['Fullname'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $conn = new mysqli('localhost', 'root', '', 'jojay-test');
    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $check_stmt = $conn->prepare("SELECT Username FROM registration WHERE Username = ?");
        $check_stmt->bind_param("s", $Username);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        if ($check_result->num_rows > 0) {
            echo "<script>alert('Username is already taken. Please choose a different one.'); window.location='../HTML/Register.html';</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO registration (Fullname, Username, Password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $Fullname, $Username, $Password);
            if ($stmt->execute()) {
                echo "<script>alert('Registration successful! You can now login.'); window.location='../HTML/Login.html';</script>";
                exit(); 
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check_stmt->close();
        $conn->close();
    }
} else {
    echo "This page cannot be accessed directly.";
}
?>
