<?php
session_start();
$servername = "localhost";
$username = "if0_36251446";
$password = "Gaurav1029";
$database_name = "if0_36251446_project";
try {
    $conn = new mysqli($servername, $username, $password, $database_name);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['Submit'])) {
        // Check if POST variables are set
        if (isset($_POST['ITEM'], $_POST['MATERIALS'], $_POST['STEPS'])) {
            // Sanitize inputs
            $ITEM = $conn->real_escape_string($_POST['ITEM']);
            $MATERIALS = $conn->real_escape_string($_POST['MATERIALS']);
            $STEPS = $conn->real_escape_string($_POST['STEPS']);

            $sql_query = "INSERT INTO user_product (ITEM, MATERIALS, STEPS) VALUES ('$ITEM', '$MATERIALS', '$STEPS')";

            if ($conn->query($sql_query) === TRUE) {
?>
                <script>
                    alert("Data added successfully!");
                    window.location.href = "UserIdea.html";
                </script>
<?php
            } else {
                throw new Exception("Error: " . $sql_query . "<br>" . $conn->error);
            }
        } else {
            throw new Exception("POST variables are not set.");
        }
    }
} catch (Exception $e) {
    echo '<html>
    <head>
        <title>Error</title>
        <style>
            body {
                font-size: 24px;
                text-align: center;
                margin-top: 100px;
            }
        </style>
    </head>
    <body>
        <div style="font-size:50px;">' . $e->getMessage() . '</div>
        <script>
            setTimeout(function(){
                window.history.back();
            }, 3000);
        </script>
    </body>
  </html>';
}

// Close the connection
if ($conn) {
    $conn->close();
}
?>
