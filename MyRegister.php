<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2'])) {
    try {
        $conn = mysqli_connect('localhost', 'if0_36251446', 'Gaurav1029', 'if0_36251446_project');
        if (!$conn) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm'])) {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            // Check if email already exists
            $email_check_query = "SELECT * FROM `myregister` WHERE `email`='$email' LIMIT 1";
            $result = mysqli_query($conn, $email_check_query);
            if (mysqli_num_rows($result) > 0) {
                throw new Exception("Email is already registered.");
            }

            // Check if username already exists
            $username_check_query = "SELECT * FROM `myregister` WHERE `username`='$username' LIMIT 1";
            $result = mysqli_query($conn, $username_check_query);
            if (mysqli_num_rows($result) > 0) {
                throw new Exception("Username already exists.");
            }

            $key = "YourSecretKey";
            $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $key, 0, 'YourSecretIV');
            $encrypted_confirm = openssl_encrypt($confirm, 'aes-256-cbc', $key, 0, 'YourSecretIV');

            $sql = "INSERT INTO `MyRegister`(`name`,`username`, `email`,`password`,`confirm`) VALUES ('$name', '$username', '$email','$encrypted_password','$encrypted_confirm')";

            $query = mysqli_query($conn, $sql);
            if (!$query) {
                throw new Exception("Error occurred while executing query: " . mysqli_error($conn));
            }

            echo '<script>alert("Registration Successful!")</script>';
            echo '<script>window.location="Login.html"</script>';
        }
    } catch (Exception $e) {
        echo '<script>alert("An error occurred: ' . $e->getMessage() . '")</script>';
        echo '<script>window.location="index.html"</script>';
    } finally {
        // Close the database connection
        mysqli_close($conn);
    }
}
?>
