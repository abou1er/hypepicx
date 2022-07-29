<?php 
session_start(); //  if the cookie $_SESSION['admmin'] is not declared then redirection // si le cookie $_SESSION['admin'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';
 

    //query bar search by name // barre de recherche par nom***********************************
    $sortByLocation = $bdd->query('SELECT * FROM image ORDER BY id_image DESC');


    if (isset($_GET['searching']) AND !empty($_GET['searching'])) {
        $recherche = htmlspecialchars($_GET['searching']);
        $sortByLocation = $bdd->query('SELECT * FROM image WHERE title_image LIKE "%'.$recherche.'%" OR category_image LIKE "%'.$recherche.'%"  ORDER BY id_image DESC');
    }                                 
    //fin barre de recherche**********************************************



    $select = $bdd->prepare("SELECT * FROM image");
    $select->execute();

    $resultat = $select->fetchAll();// fetch indique qu'il doit le recup
     // var_dump($resultat);        //var_dump = console_log


    //  include 'dbconnect.php';

    //  include 'nav.php';


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/allImage2.css">

    <link rel="stylesheet" href="css/header.css">
    <title>Le Hall of Pic</title>

</head>
<body>

<div class="parent">
        <div class="logo">
           
        </div>



        <div class="parentNomDuSite">
            <div class="nomdusite render">hypEpic</div>
        </div>


        
        <div class="home">

            
            <div class="pseudo"><?php echo $_SESSION['pseudo'];  ?></div>
             <div class="profil"><img src="img/profil.png" alt=""> <?php echo('<br><a href="profilAdmin.php?id='.$_SESSION['id_user'].'" >Voir mon profil</a> '); ?> </div> 

             
           
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

    </div>
</div>    

    
    





    <div class="triRecherche">

        <div class="tri">

                <div class="searchByLevel">   <!-- search bar by category // barre de recherche par catégorie -->
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
                          
                        
                        <a href="allImage.php"><button type="submit" >reset</button></a>
                    </form>
                </div>    
        </div>            


        <div class="search">

            <div class="searchByName">
            Rechercher par nom  
            </div>

            <!--search bar by name // barre de recherche par nom -->
            <div class="formu">
                 <form action="" method="get">
                    <input type="search" name="searching" placeholder="rechercher par nom">
                    <input type="submit" value="Rechercher"> <!-- will submit in GET the value entered in the input //  soumettra en GET la valeur rentrée dans l'input -->
                    <a href="allImage.php"><button type="submit" >Reset</button></a>   
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
echo  //       "<a class='lien' href='tripSelected.php?idTrip=".$toto["idTrip"]."'>  va ouvrir la page en y rajouant l'id correspondant au lien sur lequel j'ai cliqué. (si envie possiblité de mettre d'autre info ."&locationTrip=".$toto["locationTrip"]."&nameTrip=".$toto["nameTrip"]."&levelTrip=".$toto["levelTrip"]."')

    "<a class='lien' href='imgSelected.php?id_image=".$loca["id_image"]."'> 
            


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
            <a href="allImage.php"><button type="submit" >reset</button></a>
        
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
<!-- <script src="satisfaction.js"></script> -->
<script src="script.js"></script>
<script src="burger.js"></script>
    


</html>
