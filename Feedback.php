<?php

session_start();
// Database connection details
$servername = "localhost"; // Change this to your database server
$username = "if0_36251446"; // Change this to your database username
$password = "Gaurav1029"; // Change this to your database password
$dbname = "if0_36251446_project"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    // Process feedback submission here
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare SQL statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO feedback (username, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute() === TRUE) {
        // Show alert and redirect on successful submission
        echo '<script>alert("Feedback stored successfully!"); window.location.href = "LandingPage.html";</script>';
        exit();
    } else {
        // Handle database insertion error
        echo '<script>alert("Error occurred while submitting feedback!");</script>';
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Feedback Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('BG_IMG/Feedback.jpg'); 
      background-size: cover;
      background-position: center;
      margin: 0;
      padding: 0;   
    }

    .container {
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    textarea {
      height: 100px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    #message {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }

  </style>
</head>
<body>

<div class="container">
  <h2>Feedback Form</h2>
  <form id="feedbackForm" method="POST" action="">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea id="message" name="message" required></textarea>
    </div>
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
