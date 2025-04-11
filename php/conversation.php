<?php
require_once '../config.php';

if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
    header("Location: ../login.php");
    exit();
}

$id_am = mysqli_real_escape_string($con, $_GET['id_am']);
$id = $_SESSION['id'] ?? $_COOKIE['id'];

// Marquer les messages comme lus
$sql1 = "UPDATE message 
         JOIN conversation ON message.id_cv = conversation.id_cv 
         SET message.vue_ms = 1 
         WHERE conversation.id_am = $id_am AND message.id_send != $id";
mysqli_query($con, $sql1);

// Récupérer les infos de l’ami
$sql5 = "SELECT * FROM amis WHERE id_am = $id_am";
$result5 = mysqli_query($con, $sql5);
$row5 = mysqli_fetch_array($result5);
$friend_id = ($row5['id_us1'] != $id) ? $row5['id_us1'] : $row5['id_us2'];

$sql6 = "SELECT * FROM user WHERE id_us = $friend_id";
$result6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_array($result6);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SpeakUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-image: url('../images/si.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100vh;
      width: 100vw;
    }
a{
  text-decoration:none;
}
    .chatbox {
      max-width: 600px;
      height: 100vh;
      margin: auto;
      display: flex;
      flex-direction: column;
      border-radius: 10px;
      background-color: white;
      overflow: hidden;
      border: 1px solid #ccc;
    }

    .chatbox-header {
      padding: 10px;
      background-color: #0d6efd;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;

    }

    .chatbox-body {
      flex: 1;
      overflow-y: auto;
      padding: 10px;
      background-color: #f8f9fa;
      display: flex;
      flex-direction: column;
    }

    .chatbox-footer {
      padding: 10px;
      background-color: #fff;
      border-top: 1px solid #ccc;
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

    .img2 {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ccc;
    }

    .rtn {
      background: none;
      border: none;
      font-size: 22px;
      color: white;
    }

    @media (max-width: 768px) {
      .chatbox {
        width: 100%;
        height: 100vh;
        border-radius: 0;
      }
    }
    .child{
      display:flex;
    align-items:center;
    gap: 5px;
    }
  </style>
</head>
<body>

<input type="hidden" id="id_am" value="<?= $id_am ?>">
<input type="hidden" id="id_session" value="<?= $id ?>">

<div class="chatbox shadow">
  <div class="chatbox-header">
   <div class="child"> <a href="../index.php" class="rtn"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;SpeakUp</a></div>
   <div class="child">
   <h5 class="m-0 text-white flex-grow-1 text-center"><?= $row6['name_us'] ?></h5>
   <a href="../speak/pages/profil.php?id=<?= $row6['id_us'] ?>"><img src="../images/<?= $row6['img_us'] ?>" alt="Profil" class="img2"></a>

   </div>

  </div>

  <div class="chatbox-body" id="chatBody"></div>

  <div class="chatbox-footer">
    <form id="chatForm">
      <div class="input-group">
        <input type="text" class="form-control" id="message" name="message" placeholder="Écrire un message..." required>
        <button class="btn btn-primary" type="submit">Envoyer</button>
      </div>
    </form>
  </div>
</div>

<script>
const chatbody = document.getElementById("chatBody");
const id_am = document.getElementById("id_am").value;
const id_session = document.getElementById("id_session").value;
let scroll = true;

// Gestion de l’envoi
$('#chatForm').on('submit', function(e) {
  e.preventDefault();
  $.ajax({
    url: '../php/send.php?id='+id_am,
    type: 'POST',
    data: { message: $('#message').val(), id_am: id_am },
    success: function(res) {
      $('#message').val('');
    },
    error: function(error) {
      alert("Erreur lors de l'envoi");
    }
  });
});

// Gestion du scroll intelligent
chatbody.addEventListener('scroll', () => {
  const threshold = 50;
  scroll = chatbody.scrollHeight - chatbody.scrollTop - chatbody.clientHeight < threshold;
});

// Récupérer les messages
async function fetchMessages() {
  try {
    const res = await fetch('json.php?id_am=' + id_am);
    const data = await res.json();
    chatbody.innerHTML = '';

    data.forEach(msg => {
      const p = document.createElement('p');
      const div = document.createElement('div');
      div.innerHTML = msg.content;

      if (msg.id_send == id_session) {
        p.className = 'chatbox-message';
      } else {
        p.className = 'chatbox-message1';
      }

      p.appendChild(div);
      chatbody.appendChild(p);
    });

    if (scroll) {
      chatbody.scrollTop = chatbody.scrollHeight;
    }

  } catch (err) {
    console.error('Erreur chargement messages :', err);
  }
}

setInterval(fetchMessages, 800); // refresh chat
</script>

</body>
</html>