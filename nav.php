




<style>
.nav{
            height: 11vh;
            width: 500px;
            position:absolute;
            bottom:  0vh;
            right: 37vw;
            background-Color:black;
            border-top-right-radius:30px;
            border-top-left-radius:30px;
            display:flex;
            justify-content:center;
            align-items:center;
            gap:35px;
            font-size:20px;
        }
        img{
            height: 50px;
            width: 50px;
            border-radius:100%;
        }
        a{
            display:flex;
            justify-content:center;
            align-items:center;
            color:rgb(242, 145, 242);
        }
        a:hover{
            color:red;
            background-color:rgb(242, 145, 242);
        }
        .hr{
            height: 40px;
            width: 90px;
            text-decoration:none;
            border:1px solid white;
            border-radius:30px;
        }
        
        .dropbtn {
  background-color: black;
  color: white;
  padding: 16px;
  font-size: 16px;
  border:1px solid white;
  cursor: pointer;
  border-radius:30px;
}

.dropup {
  position: relative;
  display: inline-block;
}

.dropup-content {
  display: none;
  position: absolute;
  bottom: 50px; /* Pushes the menu upward */
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropup-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropup-content a:hover {
  background-color: #ddd;
}

.dropup:hover .dropup-content {
  display: block;
}

.dropup:hover .dropbtn {
  background-color: rgb(242, 145, 242);
}
.dropup:hover i{
    color:red;
}

    </style>




<div class="nav">
    <a class="hr" href="./?amis">Amis</a>
    <a class="hr" href="./?att">En attant</a>
    <a class="hr" href="./?ajout">Ajout</a>
    <div class="dropup">
  <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
  <div class="dropup-content">
    <a href="speak/pages/profil.php">profil</a>
    <a href="speak/pages/deco.php">logout</a>
    
  </div>
</div>
</div>
