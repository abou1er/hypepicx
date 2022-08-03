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
    <title>Supprimer une Pic</title>
    <link rel="stylesheet" href="css/allImage.css">     
    <link rel="stylesheet" href="css/header.css">
      <link rel="stylesheet" href="css/profilAdmin.css">

      <link rel="stylesheet" href="css/footer.css">

</head>



<header>

    <div class="parent">
        <div class="logo">
            <!-- <a href="index.html">  <img src="img/logokisspng-jacket-denim-clothing-jeans-hoodie-denim-jacket-svg-png-icon-free-download-59453-5b728f8a4e2901.2879395615342345063202.png"  alt="logo">
                </a> -->
        </div>



        <div class="parentNomDuSite">
            <div class="nomdusite render">hypEpic</div>
        </div>


        <div class="home">

            <!-- <a href="profilAdmin.php">Voir mon profil<div class="profil"><img src="img/profil.png" alt="icon-panier" width="150%">
            </div></a> -->
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

<div class="central">

<h3>Le Hall des pics </h3>
<h4>L'ensemble des pics à supprimer sont réunis ici : </h4>
     <!-- afficher article -->
     <?php
        // $recupComment = $bdd->prepare('SELECT * FROM commentaire');

        //RAJOUTER LA TABLE DANS INNER JOINT POUR RECUP URL IMAGE

    


        $recupComment = $bdd->prepare('SELECT * FROM `image` ORDER BY id_image DESC');

        // $recupComment = $bdd->prepare('SELECT * FROM `comment` INNER JOIN `user` ON comment.user_iduser = user.id_user WHERE id_user = ?  ORDER BY `date_creation` desc');

        $recupComment ->execute();
        

        while($comment = $recupComment->fetch()){
             
            

            ?>

            
            <!--  -->

          
                
            
            <div class="aDel">
                <!-- "<a class='lien' href='imgSelectedMembre.php?id_image=".$loca["id_image"]."'>  -->
                <?php 
                echo($comment['title_image']);
                echo '<a  href="imgSelected.php?id_image=' . $comment['id_image'] . '"><img style="max-width:100% ; max-height:100%; width:150px " src = "' . $comment['url_image'] . '"/> </a>';
                ?>
               



            <div class="delete">
               <a href="deleteImageAdmin.php?id=<?= $comment['id_image'] ?>"
	onclick="return confirm('Voulez-vous vraiment supprimer la pic * <?php echo $comment['title_image']; ?> *');">
  <span style="color:red">Supprimer la pic</span></a>
            </div>

            </div>
           
              
  


       

       

          

            <?php

        // var_dump($comment);
       
        }
      
   ?>



<?php 

  echo "<a href=profilAdmin.php?id=".$_SESSION['id_user'].">retour au profil</a>";

  echo"<br><a href=allImage.php?id=".$_SESSION['id_user'].">retour au Hall of pic</a> <br>" ;
?>
   
</div>
  
    <!-- fin affiche -->
</body>

<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    
</html>