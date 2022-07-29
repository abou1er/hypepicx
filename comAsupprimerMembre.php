<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['id_user']){
    header('Location: index.php');

}


require_once 'connect/connect.php';


if(isset($_POST['envoi'])){
    if(!empty($_POST['le_commentaire'])){ //ligne d'origine if(!empty($_POST['titre']) && !empty($_POST['contenu'])){
        $le_commentaire = nl2br(htmlspecialchars($_POST['le_commentaire']));  //nm2br prend en compte l'affichege des sauut de ligne
        //$contenu = $_POST['contenu'];comment

        $insererArticle = $bdd->prepare('INSERT INTO comment(the_comment,date_creation, user_iduser) VALUES(?,NOW(),?)');
        var_dump($insererArticle->execute(array($le_commentaire,$_SESSION['id_user'])));  //$insererArticle->execute(array($titre, $contenu));
        //$insererArticle->execute($_POST['le_commentaire']);

        echo"le commentaire a bien été envoyé";
       
        
    }else{
        echo"compléter tous le champs";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un commentaires</title>
    <link rel="stylesheet" href="css/allImage.css">
     
     <link rel="stylesheet" href="css/header.css">
     

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
             <div class="profil"><img src="img/profil.png" alt=""> <?php echo('<br><a href="profilMembre.php?id='.$_SESSION['id_user'].'" >Voir mon profil</a> '); ?> </div> 



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
       

        <?php echo('<br><a href="profilMembre.php?id='.$_SESSION['id_user'].'" >Profil</a> '); ?>

        <?php echo('<br><a href="allImageMembre.php?id='.$_SESSION['id_user'].'" >Hall of Pics</a> '); ?>

         
    </div>
</div>    

    
</header>    
<body>


        

<h3>Le Hall de vos messages </h3>
<h4  style="color:blue; " >L'ensemble des commentaires que vous avez pus écrire sont réunis ici : </h4>
     <!-- afficher article -->
     <?php
        // $recupComment = $bdd->prepare('SELECT * FROM commentaire');

        //RAJOUTER LA TABLE DANS INNER JOINT POUR RECUP URL IMAGE

        


        $recupComment = $bdd->prepare('SELECT * FROM `comment` INNER JOIN `user` ON comment.user_iduser = user.id_user  INNER JOIN `image` ON image.id_image = comment.image_id_image WHERE id_user = ? ORDER BY `date_creation` desc');

        

        // $recupComment = $bdd->prepare('SELECT * FROM `comment` INNER JOIN `user` ON comment.user_iduser = user.id_user WHERE id_user = ?  ORDER BY `date_creation` desc');

        $recupComment ->execute([$_SESSION['id_user']]);
        

        while($comment = $recupComment->fetch()){
             
            

            ?>

            
            <!--  -->

            <p> 
                
            
            <div class="imgTripLeft">
                <!-- "<a class='lien' href='imgSelectedMembre.php?id_image=".$loca["id_image"]."'>  -->
                <?php 
                // var_dump($comment['id_image']);
                echo '<a  href="imgSelectedMembre.php?id_image=' . $comment['id_image'] . '"><img style="max-width:100% ; max-height:100%; width:150px " src = "' . $comment['url_image'] . '"/> </a>';
                ?>
               
            </div>
            <span style="color:blue; font-weight:bold;" >  <?= $comment['the_comment'];?> </span> Ce commentaire a était écrit dans la pic <span style="font-weight:bold;" ><?= $comment['title_image'];?> </span> le <span style="color:green;"> <?= $comment['date_creation'];?>  </span> Par <span style="color:orange; font-weight:bold;" ><?= $comment['pseudo'];?> </span> Rôle dans la communité <span style="font-weight:bold;" ><?= $comment['role_user'];?> </span> 
           
            
              
  


           

         <a href="deleteCommentaireMembre.php?id=<?= $comment['id_comment'] ?>"
	onclick="return confirm('Voulez-vous vraiment supprimer le commentaire * <?php echo $comment['the_comment']; ?> *');">
  <span style="color:red">Supprimer le commentaire</span></a>

                                

            
           

            <?php

        // var_dump($comment);
       
        }
      
   ?>



<?php 

  echo "<br><a href=profilMembre.php?id=".$_SESSION['id_user'].">retour au profil</a>";

  echo"<br><a href=allImageMembre.php?id=".$_SESSION['id_user'].">retour au Hall of pic</a> <br>" ;
?>
   

  
    <!-- fin affiche -->
</body>

<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    


</html>