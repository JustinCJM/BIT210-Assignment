<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = htmlspecialchars($_POST["name"]);
        $contactNumber = htmlspecialchars($_POST["contactNumber"]);
        $email = htmlspecialchars($_POST["email"]);
        $description = htmlspecialchars($_POST["description"]);

        if(isset($_FILES["documents"])) {
            $uploadDirectory = "uploads/";
            $uploadedFile = $uploadDirectory . basename($_FILES["documents"]["name"]);

            if (file_exists($uploadedFile)) {
                echo "File already exists.";
            }
            else {
                if (move_uploaded_file($_FILES["documents"]["tmp_name"], $uploadedFile)) {
                    echo "File uploaded successfully.";
                }
                else {
                    echo "Error uploading file.";
                }
            }
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "malayantour";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO merchants (name, contactNumber, email, description, documentPath) 
                VALUES ('$name', '$contactNumber', '$email', '$description', '$uploadedFile') ";

        if ($conn->query($sql) === TRUE) {
            echo "\nRegistration successful!";
        }
        else {
            echo "\nError: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>