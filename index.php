<?php require_once 'config.php'; 

if (!isset($_SESSION['id'])) {
   header('location:speak/pages/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeakUp</title>
    <style>
        body{
            background-color: linear-gradient(to bottom, rgb(45, 2, 45)20%, purple 50%, rgb(231, 79, 231),rgb(242, 145, 242));
        }
        
    </style>
</head>
<body>
 <?php
 

 if (isset($_GET['amis'])) {
    require_once 'php/amis.php';
 }elseif (isset($_GET['att'])) {
     require_once 'php/enattant.php';
 }elseif (isset($_GET['ajout'])) {
    require_once 'php/ajout.php'; 
 }else{
    include_once 'php/amis.php';

 }
  
     
    



      include_once 'nav.php';
?>


    
</body>
</html>
