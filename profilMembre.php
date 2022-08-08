<?php
session_start();
if(!$_SESSION['id_user']){
    header('Location: index.php');

}

require_once 'connect/connect.php';

                    //si bonne recup de l'id en GET rentre dans la condition qui se trouve être tte la page fermeture du crochet après </html>
    if(isset($_GET['id'])  && $_GET['id'] > 0 ){
        $getid = intval($_GET['id']); // converti text en nombe /***Mais g pas compris en quoi c'est mieux
        $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();

        

    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/footer.css">
  
    <link rel="stylesheet" href="css/profilAdmin.css">
    

    <title>Mon profil</title>
</head>
    <header>

    <div class="parent">
            <div class="logo">
                <!-- <a href="index.html">  <img src="img/logokisspng-jacket-denim-clothing-jeans-hoodie-denim-jacket-svg-png-icon-free-download-59453-5b728f8a4e2901.2879395615342345063202.png"  alt="logo">
                    </a> -->
            </div>



            <div class="parentNomDuSite">
            <a href="index.php">
                <div class="nomdusite render">hypEpic</div>
            </a>
        </div>


            <div class="home">

      


                <div class="retourHall"><img src="img/logo-eye-eye.png" alt="icon-profil"width="160px"><?php echo('<br><a href="allImageMembre.php?id='.$_SESSION['id_user'].'" >Retour Hall of Pics</a> '); ?></div>
    
           
            

            </div>



            <div class="burger" id="burger">

                <span id="spantop"></span>
                <span id="spanmiddle"></span>
                <span id="spanbottom"></span>

            </div>




        </div>

    

        <div class="parentresponsive">
        <div class="menuresponsive" id="menuresponsive">
      

       

            <?php echo('<br><a href="allImageMembre.php?id='.$_SESSION['id_user'].'" >Hall of Pics</a> '); ?>

         
        </div>
    </div>    

    </header>    
    


<body>
    <div  class="infoProfil">
        <h2>Profil de <?php echo $userinfo ['pseudo']; ?></h2>
        <br><br>
        pseudo = <?php echo $userinfo ['pseudo']; ?>
        <br>
        mail = <?php echo $userinfo ['email']; ?>
        <br>

        <?php 
                //$_SESSION['id'] cookie créé au moment de la connexion . Donc la personne sur la page et bien la propriétaire de la session
        if(isset($_SESSION['id_user']) AND $userinfo['id_user'] == $_SESSION['id_user']){
            ?> 

            <a href="editProfilMembre.php"> <div class="editPro">Editer mon profil <?php echo $userinfo ['pseudo']; ?> </div></a>
            <br>
            <a href="logout.php">  <div class=""> Déconnexion </div></a>
            <br>
            <a href="allImageMembre.php"> <div class=""> accéder à la galerie d'image </div></a>

            <br><br><br><br>

            <!-- <a href="deleteMembre.php?id=<?= $user['id_user']; ?> "  style="color:red;"> supprimer mon compte  </a> -->

            <?php
        }
        ?>

        

        <?php 
        if(isset ($erreur)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="red">'.$erreur .'</<font>';
        }
        
        ?>

    
    </div>
    
</body>

<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    
</html>

<?php } ?>