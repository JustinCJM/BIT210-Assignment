<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


require_once 'includes/dbh.inc.php';


if(isset($_POST["send"])){
    //generate password
    $random_characters = 2; 
    $lower_case = "abcdefghijklmnopqrstuvwxyz";
    $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $numbers = "1234567890";
    $symbols = "!@#$%^&*";
    
    $lower_case = str_shuffle($lower_case);
    $upper_case = str_shuffle($upper_case);
    $numbers = str_shuffle($numbers);
    $symbols = str_shuffle($symbols);
    
    $random_password = substr($lower_case, 0, $random_characters);
    $random_password .= substr($upper_case, 0, $random_characters);
    $random_password .= substr($numbers, 0, $random_characters);
    $random_password .= substr($symbols, 0, $random_characters);

    $mail = new PHPMailer(true); // Fixed the typo: "newPHPMailer" to "new PHPMailer"

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Fixed the typo: "smp.gmail.com" to "smtp.gmail.com"
    $mail->SMTPAuth = true;
    $mail->Username = 'ryuiyap@gmail.com'; // Replace with your Gmail email
    $mail->Password = 'leve msvm mvjh clqr'; // Replace with your Gmail password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('ryuiyap@gmail.com'); // Replace with your Gmail email

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject ="Your Travurr merchant account has been successfully registered!";
    $mail->Body = "Message: " . $_POST["message"] . "<br><br>Generated password: " . $random_password . "<br><br>Email: " . $_POST["email"];
    $email = $_POST["email"];
    $mail-> send();
    
    // $sql = "UPDATE merchant SET pwd='$hashedPassword' WHERE email='kelvinchin1917@gmail.com'";
    $query = "UPDATE merchant SET pwd='$random_password' , default_pwd='$random_password', regStatus = 'SUCCESS' WHERE email='$email'";


            if ($mysqli->query($query) === TRUE) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . $conn->error;
            }

    echo"
    <script>
    alert('Merchant has been successfully registered! Email has been sent.');
    document.location.href = 'reviewMerchant.php';
    </script>";}

    // echo "<script>console.log('yeet');</script>";


    if(isset($_POST["send1"])){
        
        $mail = new PHPMailer(true); // Fixed the typo: "newPHPMailer" to "new PHPMailer"
    
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Fixed the typo: "smp.gmail.com" to "smtp.gmail.com"
        $mail->SMTPAuth = true;
        $mail->Username = 'ryuiyap@gmail.com'; // Replace with your Gmail email
        $mail->Password = 'leve msvm mvjh clqr'; // Replace with your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
    
        $mail->setFrom('ryuiyap@gmail.com'); // Replace with your Gmail email
    
        $mail->addAddress($_POST["email"]);
    
        $mail->isHTML(true);
    
        $mail->Subject ="Your Travurr merchant account registration has been denied";
        $mail->Body = "Message: " . $_POST["message"] . "<br><br> Email: " . $_POST["email"];
        $email = $_POST["email"];

        $merchId = $_POST["merch_id"]; 

        $mysqli->begin_transaction();
        try {
            $query = "DELETE FROM merch_documents where merchantID = $merchId";
            if($mysqli->query($query) !== TRUE){
                throw new Exception("Error in deleting document");
            }

            $query2 = "DELETE FROM merchant WHERE merchantID = '$merchId'";
            if($mysqli->query($query2) !== TRUE){
                throw new Exception("Error in deleting merchant details");
            }
            $mysqli->commit();
            echo "<script>alert('Merchant and their documents removed successfully! Email has been sent.');</script>";
        } catch (Exception $e){
            $mysqli->rollback();
            echo "Error deleting : " . $e->getMessage();
        }

        $mail->send();

        echo "<script>document.location.href = 'reviewMerchant.php';</script>";
    }

?>
