<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['id_user']){
    header('Location: index.php');

}
require_once 'connect/connect.php';
   
    $dataImage = $bdd->query('SELECT * FROM image ORDER BY id_image DESC');


    if (isset($_GET['searching']) AND !empty($_GET['searching'])) {
        $recherche = htmlspecialchars($_GET['searching']);
        $dataImage = $bdd->query('SELECT * FROM image WHERE title_image LIKE "%'.$recherche.'%" OR category_image LIKE "%'.$recherche.'%"  ORDER BY id_image DESC');
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
    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                <?php echo('<br><a class="nav-link active" href="profilMembre.php?id='.$_SESSION['id_user'].'" >Profil</a> '); ?>


            </div>
    </div>    

<!-- bootNav 2-->
<nav class="navbar navbar-expand-lg bg-light triRecherche">
  <div class="container-fluid">
  <a class="navbar-brand float-end">Trier par catégorie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        

        <li class="nav-item mb-3 me-4">
                        <form class="formleft" action="" method="get">
                            <div class="wrapper">
                                <button class="btn-food" type="submit" name="searching" value="hardfood" >hardfood</button>
                            </div>
                        </form>             
        </li>

        
        <li class="nav-item mb-3 me-4">
        <form class="formleft" action="" method="get">
                    <button class="btnNa green rounded-pill" type="submit" name="searching" id="nature "value="nature">nature </button>                       
                </form>            
        </li>

        <li class="nav-item mb-3 me-4">
                <form class="formleft" action="" method="get">
                    <div class="box">
                        <button class="but-ls" type="submit" name="searching" value="lifestyle" >lifestyle</button>
                    </div>
                </form>          
        </li>

        <li class="nav-item mb-3 me-4">
                <form class="formleft" action="" method="get">
                            <button class="btn btn-1" type="submit" name="searching" value="anime" >anime</button>
                        </form>          
        </li>

        <li class="nav-item mb-3 me-4">
        <form class="formleft" action="" method="get">
                            <button class="but-nft  rainbow rainbow-1 " type="submit" name="searching" value="nft" >NFT</button>
                        </form>           
        </li>

        <li class="nav-item dropdown">
          <ul class="dropdown-menu"> 
          </ul>
        </li>
        
      </ul>

      <a href="allImageMembre.php"><button type="submit" class="rounded-pill p-2"> Reset </button></a>
      <form class="d-flex" role="search">
        <input class="form-control me-2" name="searching" type="search" placeholder="rechercher par nom" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
      </form>

      
    </div>
  </div>
</nav>
<!-- fin bootnav 2 -->





          





    <h1>Le Hall of Pic</h1>

        <!-- condition barSearch -->
        <div class="container">


             <?php 

                         if($dataImage->rowCount() > 0){
                             while($dataImg = $dataImage->fetch()){
                                 // echo ma carte
                echo  
                    "<a class='lien' href='imgSelectedMembre.php?id_image=".$dataImg["id_image"]."'> 
                            
                            
                            
                        <div class='parent-cadre' style>
                                <img class='img-cadre'  src ='img/cadregold.png'> 
                            
                            
                            <div class='interieur'>     
                            
                                <img style='max-width:100% ; max-height:100%;  ' src = " .$dataImg['url_image']. "> 
                            </div>
                            
                            
                            
                            
                            
                            <div class='infocarte'>
                            
                                    <div class='titre'>

                                        <span>". $dataImg["title_image"] ."</span>
                            
                                    </div>
                            
                            
                                    <div class=datepostimg'>
                            
                                        ". $dataImg["date_post"] ."

                            
                                    </div>
                            
                            </div>

                        </div>
                            
                    </a>";
                            
                // fin carte
                            
                                //  var_dump($dataImg);
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
                
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
                
            <script src="apparitionAuDefilement.js"></script>
            <!-- <script src="satisfaction.js"></script> -->
            <script src="script.js"></script>
            <script src="burger.js"></script>
    
        </div>                 

</html>