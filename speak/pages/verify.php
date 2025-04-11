<?php
require_once '../../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// ---------------------start 6 chivres-------------------
function generateCode() {
    $letter1 = '';
    $letter2 = '';
    for ($i = 0; $i < 1; $i++) {
        $letter1 .= chr(rand(65, 90));
        $letter2 .= chr(rand(65, 90));
    }

    $number1 = rand(10, 99);
    $number2 = rand(10, 99);

    return $letter1 . $number1 . $letter2 . $number2;
}

// Function to send verification email
function sendEmail($email, $code) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chkouritarik03@gmail.com'; // Replace with your email
        $mail->Password = 'dmwvqrhcmwspzrnc'; // Replace with your email password (App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('chkouritarik03@gmail.com', 'SpeakUp');
        $mail->addAddress($email, $email); // Email is passed as recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Your verification code is: <strong>$code</strong>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
$cd=generateCode();
sendEmail($_GET['email'],$cd);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM user WHERE email_us='$email' AND verification_code='$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      
        $sql1 = "UPDATE user SET verified=1 and verification_code=".$cd." WHERE email_us=".$email."";
        $result1 = mysqli_query($con, $sql1);
        if ($result1) {
            header("location:login.php");
        } else {
            echo '<center><span class="badge text-bg-danger"><h6>Failed to verify email!</h6></span></center>';
        }
    } else {
        echo '<center><span class="badge text-bg-danger"><h6>Invalid verification code!</h6></span></center>';
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>verify email</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
    <form method="post">
        <label>Enter Verification Code:</label>
        <input type="text" name="code" required>
        <input type="hidden" name="email" value="<?= $_GET['email']; ?>">
        <input type="submit" value="Verify">
    </form>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

