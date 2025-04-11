<style>
    .nav {
        height: 58px;
        width: 58px;
        position: fixed;
        top: 10vh;
        left: 27.3vw;
        background-color: black;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 35px;
        font-size: 20px;
    }
    .fa-solid{ 
      font-size:25px;

    }

    img {
        height: 50px;
        width: 50px;
        border-radius: 100%;
    }

    a {
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(242, 145, 242);
    }

    a:hover {
        color: black;
        background-color: rgb(242, 145, 242);
    }

    .hr {
        height: 40px;
        width: 90px;
        text-decoration: none;
        border: 1px solid white;
        border-radius: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .dropbtn {
        background-color: black;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: 1px solid white;
        cursor: pointer;
        border-radius: 30px;
    }

    .dropup {
        position: relative;
        display: inline-block;
    }

    .dropup-content {
        display: none;
        position: absolute;
        top: 50px; 
        left: -50px;
        border-radius: 30px;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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

    .dropup:hover i {
        color: black;
       
    }
    @media (max-width: 800px) {
      .nav {
        height: 80px;
        width: 80px;
        position: fixed;
        top: 0vh;
        left: 0vw;
        background-color: black;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 35px;
        font-size: 20px;
    }
    .dropup-content {
        display: none;
        position: absolute;
        top: 50px; 
        left: 0px;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }
    }
</style>

<div class="nav">
    <div class="dropup">
        <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
        <div class="dropup-content">
            <a class="hr" href="./?amis">Amis</a>
            <a class="hr" href="./?att">En attant</a>
            <a class="hr" href="./?ajout">Ajout</a>
            <a class="hr" href="speak/pages/profil.php">profil</a>
            <a class="hr" style="background-color: red; c" href="speak/pages/deco.php">logout</a>
        </div>
    </div>
</div>
