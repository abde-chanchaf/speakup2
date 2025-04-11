<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
        body {
        font-family: Arial, sans-serif;
        background-image: linear-gradient(to bottom, rgb(45, 2, 45)20%, purple 50%, rgb(231, 79, 231),rgb(242, 145, 242));
        height:100vh;
  width:100vw;
  margin: 0px;
  padding-top: 65px;
  overflow-x: hidden;
  overflow-y: scroll;
    }
        .card {
            width: 320px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            align-items: center;
            margin-left:500px;
            gap: 10px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .info {
            flex-grow: 1;
        }
        .name {
            font-size: 20px;
            font-weight: bold;
            position: absolute;
            left: 75px;
            top: 18px;
        }
        .mutual-friends {
            font-size: 14px;
            color:rgb(155, 154, 154);
            display: flex;
            align-items: center;
            gap: 5px;
            position: absolute;
            left: 70px;
            top: 18px;
        }
        .mutual-friend-pic {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            object-fit: cover;
        }
        .add-friend-btn {
            width: 75px;
            padding: 8px 0;
            border: none;
            border-radius: 5px;
            background-color: #e7f3ff;
            color: #1877F2;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            position: absolute;
            right: 10px;
            top: 20px;
            
        }
        a{
            text-decoration:none;
            font-size:15px;
        }
        ul{
            list-style-type: none;
        }
        li{
            margin-bottom:5px;
        }
        :
        .div{
            height: 90vh;
            position:absolute;
            top: 10vh;
            right: 39vw;
            width: 400px;
        }
        @media (max-width: 800px) {
            
            .card {
                    width: 320px;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    padding: 10px;
                    display: flex;
                    align-items: center;
                    
                    margin-left:-17px;
                gap: 10px;
                background: purple;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                position: relative;
                }
            }
</style>

<div class="div">
   <!--   <div class="saerchc">
     <input type="text" class="saerch" name="saerch" id="saerch">
     <i class="fa-solid fa-magnifying-glass"></i>
     </div> -->

     
     <ul>
 <?php


           $sql='SELECT * FROM `user` where id_us!='.$_SESSION['id'].'';
           $result=mysqli_query($con,$sql);
           while ($row=mysqli_fetch_array($result)) {
            $sql1="SELECT * FROM `amis` where id_us1=".$_SESSION['id']." and id_us2=".$row['id_us']."
                   or id_us2=".$_SESSION['id']." and id_us1=".$row['id_us']."";
            $result1=mysqli_query($con,$sql1);

            $sql2="SELECT * FROM `enattent` where id_req=".$_SESSION['id']." and id_att=".$row['id_us']."
            or id_att=".$_SESSION['id']." and id_req=".$row['id_us']."";
     $result2=mysqli_query($con,$sql2);
              if ($result1->num_rows <= 0 && $result2->num_rows <= 0) {
                //    echo $row['id_us'];
                //    echo $row['role_us'];
                //    echo $row['img_us'];
                //    echo $row['email_us'];
                //    echo $row['name_us'];
                //    echo $row['pass_us'];
                //    echo $row['nickname_us'];
                //    echo '<br>';

                   echo '<li class="card">
            
            <a href="speak/pages/profil.php?id='.$row['id_us'].'"><img src="images/'.$row['img_us'].'" alt="Photo de profil" class="profile-pic"></a>
            <div class="info">
            <strong class="name">'.$row['nickname_us'].'</strong>
             <h5 class="mutual-friends">'.$row['name_us'].'</h5>
            
            <a href="php/ajout2.php?id_aj='.$row['id_us'].'" class="add-friend-btn" id="btn">Add</a>
           </div>
              
        </li>';
              }
 
    }
   
 ?>
</ul>
  
     </div>

   


