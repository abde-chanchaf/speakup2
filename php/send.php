<?php 
require_once '../config.php';
$id_am = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $message = $_POST['message'];
  $sql = "SELECT * FROM `conversation` WHERE id_am = $id_am";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $sql1 = "INSERT INTO `message`(`id_send`, `content`, `id_cv`) 
           VALUES ('" . $_SESSION['id'] . "', '$message', '" . $row['id_cv'] . "')";
  $result1 = mysqli_query($con, $sql1);

//   header("location:conversation.php?id_am=$id_am");
}
?>