<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher tous les membres</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="css/profilAdmin.css">
</head>

<header>
            
            <div class="parent">
                    <div class="logo">
                        
                    </div>
            
            
            
                    <div class="parentNomDuSite">
                        <div class="nomdusite render">hypEpic</div>
                    </div>
            
            
                    <div class="home">
            
                  
            
                    <div class="pseudo"><?php echo $_SESSION['pseudo'];  ?></div>
            
            <div class="profil"><img src="img/profil.png" alt=""> <?php echo('<br><a href="profilAdmin.php?id='.$_SESSION['id_user'].'" >Voir mon profil</a> '); ?> </div> 



            <div class="retourHall"><img src="img/logo-eye-eye.png" alt="icon-profil"width="160px"><?php echo('<br><a href="allImage.php?id='.$_SESSION['id_user'].'" >Retour Hall of Pics</a> '); ?></div>
   
          
            <a href="acceuilAdmin.php"><div class="acceuil"><img src="img/home.png" alt="icon-profil">
           Retour page accueil Admin </div></a>
            
                        
            
                    </div>
            
            
            
                    <div class="burger" id="burger">
            
                        <span id="spantop"></span>
                        <span id="spanmiddle"></span>
                        <span id="spanbottom"></span>
            
                    </div>
            
            
            
            
                </div>
            
                
            
                <div class="parentresponsive">
                <div class="menuresponsive" id="menuresponsive">
                    <a href="acceuilAdmin.php"  >Accueil</a>
            
                    <?php echo('<br><a href="profilAdmin.php?id='.$_SESSION['id_user'].'" >Profil</a> '); ?>
            
                    <?php echo('<br><a href="allImage.php?id='.$_SESSION['id_user'].'" >Hall of Pics</a> '); ?>
            
                     
                </div>
            </div>    
            
</header>
    


<body>


<h1>Afficher tous les membres</h1>

    <!-- afficher membre -->
    <?php
        $recupUsers = $bdd->prepare('SELECT * FROM user WHERE role_user = "membre" ');
        $recupUsers ->execute();
        while($user = $recupUsers->fetch()){
                                                         

            ?>
            <!-- <p> nom du membre <?= $user['pseudo']; ?>  <a href="bannir.php?id=<?= $user['id_user']; ?> "  style="color:red;"> bannir le membre  </a>  </p> -->
              <!-- dans $user se trouve la table membre avec id et pseudo dans ce lien change de page prenant compte de l'id -->
<!-- 
              <p> Le <span style="color:green;"> <?= $comment['date_creation'];?>  </span> <span style="color:orange; font-weight:bold;" > <?= $comment['pseudo'];?> </span>  Dit :  <span style="color:blue; font-weight:bold;" >  <?= $comment['the_comment'];?> </span> commentaire n° <?= $comment['id_comment'];?>  Rôle dans la communité <span style="font-weight:bold;" ><?= $comment['role_user'];?> </span> 
  
    
  <a href="fulldeleteCommentaireAdmin.php?id=<?= $comment['id_comment'];  ?>&id_image=<?= $id_image;  ?>"
  onclick="return confirm('Voulez-vous vraiment supprimer le commentaire * <?php echo $comment['the_comment']; ?> *');">  <span style="color:red">Supprimer le commentaire</span></a>
    -->





              <p> Pseudo du membre:<span style="color:green; font-weight:bold;"> <?= $user['pseudo']; ?>  </span>. Email du membre: <span style="color:orange; font-weight:bold;" ><?= $user['email']; ?> </span> 
              <a href="bannir.php?id=<?= $user['id_user'] ?>"
	onclick="return confirm('Voulez-vous vraiment bannir le membre * <?php echo $user['pseudo']; ?> *. Cela aura pour effet de supprimer son compte de la base de donnée.');">
  <span style="color:red">Bannir le membre</span></a>  </p>

            <?php

        }
   ?>
    <!-- fin affiche -->

    <a href="acceuilAdmin.php"> retour page d'acceuil ADMIN</a>
    
</body>

<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
</html>