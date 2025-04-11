// tsssssssssssssst
<?php
require_once '../config.php';
$id_am = intval($_GET['id_am']);

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
} else {
  $id = isset($_COOKIE['id']);
}

$sql1 = "UPDATE message 
         JOIN conversation ON message.id_cv = conversation.id_cv 
         SET message.vue_ms = 1 
         WHERE conversation.id_am = $id_am and message.id_send != $id";
mysqli_query($con, $sql1);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure responsiveness -->
  <title>SpeakUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
  <style>
    body {
      height: 100vh;
      width: 100vw;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-image: url(../images/si.jpg);
      background-size: cover;
    }

    .chatbox {
      max-width: 600px;
      margin: auto;
      border: 1px solid #dee2e6;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      height: 90vh;
      background-color: white;
    }

    .chatbox-header {
      padding: 10px;
      background-color: #0d6efd;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .chatbox-body {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      overflow-x: hidden;
      background-color: #f8f9fa;
      display: flex;
      flex-direction: column;  
    }

    .chatbox-message {
      align-self: flex-end;
      background-color: #6c757d;
      color: white;
      padding: 10px;
      border-radius: 15px 15px 0 15px;
      margin: 5px 10px;
      max-width: 70%;
      word-wrap: break-word;
    }

    .chatbox-message1 {
      align-self: flex-start;
      background-color: #0d6efd;
      color: white;
      padding: 10px;
      border-radius: 15px 15px 15px 0;
      margin: 5px 10px;
      max-width: 70%;
      word-wrap: break-word;
    }

    .chatbox-footer {
      padding: 10px;
      border-top: 1px solid #dee2e6;
      background-color: #fff;
    }

    .rtn {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: white;
    }

    a {
      color: white;
      text-decoration: none;
    }

    p {
      max-width: 100%;
      height: auto;
      padding: auto;
      word-wrap: break-word;
      overflow-wrap: break-word;
      margin-bottom: 10px;
    }

    h5{
      position: absolute;
      left:33.5vw;
    }

    .img2 {
      width: 50px; 
      height: 50px; 
      border-radius: 50%; 
      object-fit: cover;  
      border: 2px solid #ccc;
      margin: 10px 0; 
    }

   -------------tele-------------------
    @media (max-width: 800px) {
      .chatbox {
        width: 100%;
        height: 101%;
        position: absolute;
        top:-10px;
        border-radius: 0;
        margin: 0;
      }

      .chatbox-header h5 {
        font-size: 18px;
      }

      .img2 {
        width: 50px; 
    height: 50px; 
    border-radius: 50%; 
    object-fit: cover;  
    border: 2px solid #ccc;
    margin: 10px 0;  
      }
    }
  </style>
</head>
<body>
<input type="hidden" id="id_am" value="<?= $id_am ?>">
<input type="hidden" id="id_session" value="<?= $id ?>">

<div class="chatbox shadow mt-2">
  <div class="chatbox-header">
    <button class="rtn">
      <a href="../index.php"><i class="fas fa-arrow-left"></i></a>
    </button>
    <!-- ----------------------------- sql -->
     <?php
     $sql5= "SELECT * FROM `amis` WHERE id_am=$id_am ";
     $result5=mysqli_query($con,$sql5);
     $row5=mysqli_fetch_array($result5);
     if ($row5['id_us1']!=$_SESSION['id']) {
      $sql6= "SELECT * FROM `user` WHERE id_us=".$row5['id_us1']."";
      $result6=mysqli_query($con,$sql6);
      $row6=mysqli_fetch_array($result6);
     }else {
      $sql6= "SELECT * FROM `user` WHERE id_us=".$row5['id_us2']."";
      $result6=mysqli_query($con,$sql6);
      $row6=mysqli_fetch_array($result6);
     }
?>
    <h5 class="mb-0 ">SpeakUp</h5>
    <a href="../speak/pages/profil.php?id=<?php echo $row6['id_us']?>"><img src="../images/<?php echo $row6['img_us']?>" alt="Photo de profil" class="img2"></a>

 </div>
  <div class="chatbox-body" id="chatBody"></div>
  <div class="chatbox-footer">
    <form id="chatForm" method="post">
      <div class="input-group">
        <input type="text" class="form-control" name="message" id="message" placeholder="Écrire un message..." required>
        <button class="btn btn-primary" type="submit">Envoyer</button>
      </div>
    </form>
  </div>
</div>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $message = $_POST['message'];
  $sql = "SELECT * FROM `conversation` WHERE id_am = $id_am";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $sql1 = "INSERT INTO `message`(`id_send`, `content`, `id_cv`) 
           VALUES ('" . $_SESSION['id'] . "', '$message', '" . $row['id_cv'] . "')";
  $result1 = mysqli_query($con, $sql1);

  header("location:conversation.php?id_am=$id_am");
}
?>

<script>
const chatbody = document.getElementById("chatBody");
const id_am = document.getElementById("id_am").value;
const id_session = document.getElementById("id_session").value;

let scroll = true;

chatbody.addEventListener('scroll', () => {
  const threshold = 50;
  scroll = chatbody.scrollHeight - chatbody.scrollTop - chatbody.clientHeight < threshold;
});

async function fetchMessages() {
  try {
    const res = await fetch('json.php?id_am=' + id_am);
    const data = await res.json();
    // Clearmsg
    chatbody.innerHTML = ""; 

    data.forEach(msg => {
      const wrapper = document.createElement('p');
      const msgdiv = document.createElement('div');

      msgdiv.classList.add("p-2", "rounded");
      msgdiv.innerHTML = msg.content;

      if (msg.id_send == id_session) {
        wrapper.classList.add("chatbox-message");  
      } else {
        wrapper.classList.add("chatbox-message1"); 
      }

      wrapper.appendChild(msgdiv);
      chatbody.appendChild(wrapper);
    });

    if (scroll) {
      chatbody.scrollTop = chatbody.scrollHeight;
    }
  } catch (error) {
    console.error("Erreur:", error);
  }
}

setInterval(fetchMessages, 500); // Fetch messages every 500ms
</script>

</body>
</html>
