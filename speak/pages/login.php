<?php
require_once '../../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>log in</title>
    <link rel="shortcut icon" href="images/hh.webp" type="image/x-icon">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container mt-5 my-5">
        <div class="row mt-5">
            <div class="col-4 mt-5"></div>
            <div class="lo col-4 border border-dark rounded mt-5">
                <center><h1 class="mb-5">login</h1></center>
                <form method="post">
                    <div class="login">
                        <div class="log">
                            <label class="text-start mb-2"><h6>Email :</h6></label>
                            <input class="form-control" type="email" name="email" placeholder="email..." value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" required>
                        </div>
                        <label class="text-start mb-2"><h6>Password :</h6></label>
                        <input class="form-control mb-4" type="password" name="password" placeholder="password..." value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required>
                    </div>
                   <div class="checkbox">
                   <input class="check form-check-input" type="checkbox" name="remember_me" id="remember_me" <?php echo isset($_COOKIE['email']) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="remember_me">
                           <h6>Remember Me !</h6>
                        </label>
                   </div>
                    <div class="hh">
                        <input class="btn btn-outline-light mb-3" type="submit" value="login">
                        <a class="mb-3 btn btn-outline-light" href="register.php">register</a>
                    </div>

                    <div class="form-check">
                        
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email1 = $_POST['email'];
        $password1 = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email_us = '$email1' and pass_us='$password1'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
if ($row['verified']!=1 ) {
    echo '<center><div class="badge text-bg-danger text-center"><h6><a href="./verify.php?email='.$email1.'">your account not verified</a></h6></div></center>';
}else {
    

            $_SESSION['id']=$row['id_us'];
    
            if (isset($_POST['remember_me'])) {               
                setcookie('id', $row['id_us'], time() + (86400 * 30), "/"); 
                setcookie('email', $email1, time() + (86400 * 30), "/"); 
                setcookie('password', $password1, time() + (86400 * 30), "/");
                $_SESSION['id']=$row['id_us'];
           
                
             }    else {
                echo '<center><div class="badge text-bg-danger text-center"><h6>Incorrect email or password</h6></div></center>';
            }
             $sql = "UPDATE user set status_us=1 WHERE id_us=".$row['id_us']."";
             $result = mysqli_query($con, $sql);

             header("Location:../../index.php?".$_SESSION['id']."");

            
         
    }}}
    ?>

</body>
</html>
