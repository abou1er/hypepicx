<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['id_user']){
    header('Location: index.php');

}



require_once 'connect/connect.php';


    
    // include 'dbconnect.php';
    //inclu le contenu de la page php au niveau ou se trouve *include*

    $id_image = $_GET["id_image"]; //je crée la var $idTrip qui sera egal à l'id qui sera affiché dans l'url grace à $_GET[""];
    // echo $idTrip;

    

    $select = $bdd->prepare('SELECT * FROM `image` INNER JOIN `user` ON image.user_id_user = user.id_user WHERE id_image = ?' );

    //$select = $bdd->prepare("SELECT * FROM image WHERE id_image = ?"); //prepare $select la variable sera = ce que je vise par la requête 
    $select->execute([$id_image]);  // ici  execute la requête $select avec la variable de l'idTrip
    


    $resultat = $select->fetch();// fetch indique qu'il doit le recup les infos de la variables $select
    // $resultat contient maintenant toutes les info récupérer et devient donc un tableau

    //  var_dump($resultat);        //var_dump = console_log


     //var_dump($resultat); // vérif que $resultat contient bien toutes les info

   





    if(isset($_POST['envoi'])){
        if(!empty($_POST['le_commentaire'])){ //ligne d'origine if(!empty($_POST['titre']) && !empty($_POST['contenu'])){
            $le_commentaire = nl2br(htmlspecialchars($_POST['le_commentaire']));  //nm2br prend en compte l'affichege des sauut de ligne
            //$contenu = $_POST['contenu'];
    
            //INSERT `comment` INNER JOIN `image` ON comment.user_id_user = user.id_user ORDER BY `date_creation` desc');

            $insererArticle = $bdd->prepare('INSERT INTO comment (the_comment, date_creation, user_iduser, image_id_image) VALUES(?,NOW(),?,?)');
            var_dump($insererArticle->execute(array($le_commentaire,$_SESSION['id_user'], $resultat['id_image'])));  //$insererArticle->execute(array($titre, $contenu));
            
            echo"le commentaire a bien été envoyé";
            header('Location: imgSelectedMembre.php?id_image='.$resultat['id_image'].''); 
        }else{
            echo"compléter tous le champs";
        }
    }

// var_dump($resultat);

 

 ?>

<!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Pic <?php echo('' . $resultat['title_image'] .'');?></title>
     <!-- <link rel="stylesheet" href="imgSelected.css"> -->
     <!-- <link rel="stylesheet" href="css/allImage.css"> -->
     
    <link rel="stylesheet" href="css/header.css">
     <link rel="stylesheet" href="css/img-selected.css">
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


 <body class="container-fluid">

 


   

<div class="container">

<div class="parent-cadre">
    
    <img class="img-cadre"src="img/cadregold.png" alt="">

   <div style='background-image: url(<?php  echo('"'. $resultat['url_image'] .'"')?>) ; ' class='interieur'>


            <?php 
            echo('<img  src = "' . $resultat['url_image'] . '"; class="firstImg"/>');
            ?>
  
    </div>

    

    <div class="infocarte">
        <div class="titre"> <?php echo $resultat["title_image"];  ?> </div>
        <div class="datepost"> <?php echo $resultat["date_post"];  ?> </div>
        <div class="categorie">posté par : <?php echo $resultat["pseudo"];  ?> </div>

    </div>

    
    
    
</div>





<!-- ------------------------PARTIE COMMENTAIRE---------------------------------- -->


<div class="container-fluid"></div>
    <div class="contain-right">

        <div class="contain-comment">

            <div class="logo-comment">
            <!-- <img src="img/ruban.png" alt=""> -->
            </div>

    


            <div class="ajout-com">

                <form action="" method="post">
                    <textarea placeholder="Ajouter un commentaire" name="le_commentaire" id=""  cols="45" rows="5"></textarea>
  
                    <input type="submit" value="envoyer" name="envoi">
                </form>

            </div>

            <div class="titre">
                COMMENTAIRES
            </div>
                <br>

            <div class="boucle-com">
                <?php
                    $recupComment = $bdd->prepare('SELECT * FROM `comment` INNER JOIN `user` ON comment.user_iduser = user.id_user  WHERE image_id_image = ? ORDER BY `date_creation` desc');
                    $recupComment ->execute([$id_image]);

                    //  $comment = $recupComment->fetch();
                    // var_dump($comment);

                    // echo('' . $comment['the_comment'] .'');

                    while($comment = $recupComment->fetch()){
        
                ?>



            <!-- <div class="boucle-com"> -->
                <p> Le <span style="color:green;"> <?= $comment['date_creation'];?>  </span> <span style="color:orange; font-weight:bold;" > <?= $comment['pseudo'];?> </span>  Dit :  <span style="color:blue; font-weight:bold;" >  <?= $comment['the_comment'];?> </span> commentaire n° <?= $comment['id_comment'];?>  Rôle dans la communité <span style="font-weight:bold;" ><?= $comment['role_user'];?> </span> 
  

    <?php

    // var_dump($comment);

    }

  
    ?>


            </div>

        </div>    

            <div class="del-com">

            <?php  echo "<a href=comAsupprimerMembre.php?id=".$_SESSION['id_user'].">supprimer un de mes commentaires</a>"; ?>

            </div>


    

    </div>



   


 </body>

 <?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    




 </html>


