<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['id_user']){
    header('Location: index.php');

}
require_once 'connect/connect.php';
   
    $sortByLocation = $bdd->query('SELECT * FROM image ORDER BY id_image DESC');


    if (isset($_GET['searching']) AND !empty($_GET['searching'])) {
        $recherche = htmlspecialchars($_GET['searching']);
        $sortByLocation = $bdd->query('SELECT * FROM image WHERE title_image LIKE "%'.$recherche.'%" OR category_image LIKE "%'.$recherche.'%"  ORDER BY id_image DESC');
    }                                 //select dans la table trip la colonne levelTrip LIKE ce qui ressemblera à ce qui sera rentré dans l'input OR locationTrip ressempble à ce qui sera rentré

    //fin barre de recherche**********************************************





    //le placé à la fin inserera sans recharger la page
    $select = $bdd->prepare("SELECT * FROM image");
    $select->execute();

    $resultat = $select->fetchAll();// fetch indique qu'il doit le recup
     // var_dump($resultat);        //var_dump = console_log


    //  include 'dbconnect.php';

    //  include 'nav.php';

    $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($_SESSION['id_user']));
        $user = $requser->fetch();
  
    


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <link rel="stylesheet" href="css/allImage.css">

   
    <link rel="stylesheet" href="css/header.css">
    <title>Le Hall of Pic</title>

</head>
<body>

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


    </div>
</div>    

    
    





    <div class="triRecherche">

        <div class="tri">

                <div class="searchByLevel">   <!-- barre de recherche par niveau -->
                   Trier par catégorie
                </div>  

                <div class="formLevel">    
                    <form class="formleft" action="" method="get">
                        
                        <button class="btnNa green" type="submit" name="searching" id="nature "value="nature" >nature</button>
                        
                        
                        <div class="wrapper">
                        <button class="btn-food" type="submit" name="searching" value="hardfood" >hardfood</button>
                        </div>


                        <div class="box">
                            <button class="but-ls" type="submit" name="searching" value="lifestyle" >lifestyle</button>
                        </div>
                        
                        <button class="btn btn-1" type="submit" name="searching" value="anime" >anime</button>
                        

                      
                            <button class="but-nft  rainbow rainbow-1 " type="submit" name="searching" value="nft" >NFT</button>
                          
                        
                        <a href="allImageMembre.php"><button type="submit" >reset</button></a>
                    </form>
                </div>    
        </div>            


        <div class="search">

            <div class="searchByName">
            Rechercher par nom  
            </div>

            <!-- barre de recherche par région-->
            <div class="formu">
                 <form action="" method="get">
                    <input type="search" name="searching" placeholder="rechercher par nom">
                    <input type="submit" value="Rechercher"> <!-- soumettra en GET la valeur rentrée dans l'input -->
                    <a href="allImageMembre.php"><button type="submit" >Reset</button></a>   
                </form>
            </div>

        </div>    

    </div>           





    <h1>Le Hall of Pic</h1>

        <!-- condition barSearch -->
        <div class="container">
 <?php 

         if($sortByLocation->rowCount() > 0){
             while($loca = $sortByLocation->fetch()){
                 // echo ma carte
echo  
    "<a class='lien' href='imgSelectedMembre.php?id_image=".$loca["id_image"]."'> 
            


        <div class='parent-cadre' style>
            <img class='img-cadre'  src ='img/cadregold.png'> 

         
            
                <div class='interieur'>     
                
                    <img style='max-width:100% ; max-height:100%;  ' src = " .$loca['url_image']. "> 
                </div>
                

                <div class='infocarte'>




                        <div class='titre'>

                            <span>". $loca["title_image"] ."</span>

                        </div>


                        <div class=datepostimg'>
                
                            ". $loca["date_post"] ."

                
                        </div>

                </div>
                    
        </div>
             
    </a>";

// fin carte

                //  var_dump($sortByLevel);
             }
                
        }else{
            ?><p>aucune image trouvé</p>
            <br>
            <br>
            <a href="allImageMembre.php"><button type="submit" >reset</button></a>
        
            <?php
        } 
        


        ?>
        
        </div>
        <!-- finCondition -->

    <br>
    <br>

    </body>    

    <?php  include_once 'footer.php';?>

<script src="apparitionAuDefilement.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="satisfaction.js"></script> -->
<script src="script.js"></script>
<script src="burger.js"></script>
    


</html>