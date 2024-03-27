<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    try {
        $conn = mysqli_connect('localhost', 'root', '', 'PROJECT');
        if (!$conn) {
            throw new Exception("Connection failed: " . mysqli_connect_error());
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Encrypt the input password
        $key = "YourSecretKey"; // Same key used for encryption
        $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $key, 0, 'YourSecretIV');

        $sql = "SELECT * FROM `MyRegister` WHERE `username` = '$username'";
        $query = mysqli_query($conn, $sql);
        
        if (!$query) {
            throw new Exception("Query execution failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($query) == 1) {
            // Fetch the user's data from the database
            $row = mysqli_fetch_assoc($query);
            $stored_password = $row['password'];

            // Compare the encrypted stored password with the encrypted input password
            if ($stored_password === $encrypted_password) {
                // Set session variables
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $row['email']; // Include email in session
                $_SESSION['loggedin'] = true;

                // Redirect to landing page
                header("Location: LandingPage.html");
                exit();
            } else {
                echo '<script>alert("Invalid username or password. Please try again.")</script>';
                echo '<script>window.location.href = "Login.html";</script>';
            }
        } else {
            echo '<script>alert("Invalid username or password. Please try again.")</script>';
           echo'<script>
  // Redirecting using JavaScript
  window.location = "Login.html";
</script>';
            exit();
        }
    } catch (Exception $e) {
        echo '<script>alert("An error occurred: ' . $e->getMessage() . '")</script>';
        header("Location: Login.html");
        exit();
    } finally {
        // Close the database connection
        mysqli_close($conn);
    }
}
?>
