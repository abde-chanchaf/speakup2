


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> -->
    
<style>
    body {
        font-family: Arial, sans-serif;
        background-image: linear-gradient(to bottom, rgb(45, 2, 45)20%, purple 50%, rgb(231, 79, 231),rgb(242, 145, 242));
        height:100vh;
  width:100vw;
  margin: 0px;
  padding: 0px;
  overflow-x: hidden;
  overflow-y: scroll;
    }
    .card {
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    .profile-pic {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid black;
    }
    .info {
        flex-grow: 1;
        
    }
    .name {
        font-size: 15px;
        font-weight: bold;
        position: absolute;
        left: 85px;
        top: 30px;
    }
    .mutual-friends {
        font-size: 14px;
        color:rgb(155, 154, 154);
        display: flex;
        align-items: center;
        gap: 5px;
        position: absolute;
        left: 85px;
        top: 30px;
    }
    .buttons {
        display: flex;
        gap: 5px;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
    .confirm {
        background-color: green;
        color: white;
    }
    .delete {
        background-color: red;
        color: white;
    }
    ul{
        list-style-type: none;
       
        width: 335px;
        margin: 5px;
        padding: 5px;
        
    }
    li{
        margin-bottom:5px;
    }
        .add{
            position:absolute;
            font-size:30px;
            color:#e8bcb9;
            top:30vh;
            
        }
        .div{
            height: 90vh;
            position:absolute;
            top: 10vh;
            right: 39vw;
            width: 400px;
        }
        .statuson{
            height: 15px;
            width: 15px;
            background-color: green;
            position:absolute;
            bottom: 15px;
            left: 55px;
           border-radius:50%;
        }
        .statusoff{
            height: 15px;
            width: 15px;
            background-color: grey;
            position:absolute;
            bottom: 15px;
            left: 55px;
           border-radius:50%;
        }
        @media (max-width: 800px) {
            .card {
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: center;
        margin-left:180px;
        gap: 10px;
        background: purple;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        position: relative;
    }
    }
    
</style>

<!-- <li class="card">
    <img src="" alt="Photo de profil" class="profile-pic">
    <div class="info">
        <strong class="name">nackname example</strong>
        <h5 class="mutual-friends">name </h5>
    </div>
    <div class="buttons">
        <a href="php/enattant2.php?id_att='.$row['id_us'].'" id="btn"  class="btn confirm"><i class="fa-solid fa-check"></i></a >
        <a href="php/enattant2.php?id_att='.$row['id_us'].'" id="btn2"  class="btn delete"><i class="fa-solid fa-xmark"></i></a >
    </div>
</li> -->
<div class="div">
<ul>
<?php
if (isset($_SESSION['id'])) {
    $id1=$_SESSION['id'];
    $sql="SELECT * FROM amis WHERE id_us1='$id1' or id_us2='$id1'";

 } else {
    $id1 = isset($_COOKIE['id']);
    $sql="SELECT * FROM amis WHERE id_us1='$id1' or id_us2='$id1'";

 }

        $result=mysqli_query($con,$sql);
        if ($result->num_rows <= 0){


            echo '<strong class="add">add a friend for speakuuuuuuuuup</strong>';
            }else {
              
                
            
       while ($row=mysqli_fetch_array($result)) {
        if ($row['id_us2']!=$id1) {
            $sql1='SELECT * FROM user where id_us='.$row['id_us2'].'';
          $result1=mysqli_query($con,$sql1);
        }else {
            $sql1='SELECT * FROM user where id_us='.$row['id_us1'].'';
          $result1=mysqli_query($con,$sql1);
        }
        
          
          while ($row2=mysqli_fetch_array($result1)) {
            if ($row2['status_us']!=0) {
                $status='<div class="statuson"></div>';
            }else {
                $status='<div class="statusoff"></div>';
            }
            echo ' <li class="card">
          '.$status.'
    <a href="speak/pages/profil.php?id='.$row2['id_us'].'"><img src="images/'.$row2['img_us'].'" alt="Photo de profil" class="profile-pic"></a>
    <div class="info">
        <strong class="name">'.$row2['nickname_us'].'</strong>
        <h5 class="mutual-friends">'.$row2['name_us'].'</h5>
    </div>
    <div class="buttons">
        <a href="php/conversation.php?id_am='.$row['id_am'].'" id="btn"  class="btn confirm"><i class="fa-regular fa-comment"></i></a >
        
    </div>
</li>';
          }
           }}



?>
</ul>

</div>

<!-- <script>
    var btn=document.getElementById("btn");
    var btn2=document.getElementById("btn2");

    btn.addEventListener("click",()=>{
        
        
           btn.innerHTML='<i class="fa-solid fa-check"></i>';
           btn.style.color='white';
           btn.style.backgroundColor='green';
           btn2.style.display='none';

          
        
    })
    btn2.addEventListener("click",()=>{
        
        
           btn2.innerHTML='<i class="fa-solid fa-xmark"></i>';
           btn2.style.color='white';
           btn2.style.backgroundColor='red';
           btn.style.display='none';
    })

</script> -->