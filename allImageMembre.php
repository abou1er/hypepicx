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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/allImage.css">

    <title>Le Hall of Pic</title>

</head>
<body>

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
           
            <div class="pseudo"><?php echo $_SESSION['pseudo'];  ?></div>
            <div class="profil"><img src="img/profil.png" alt=""> <?php echo('<br><a href="profilMembre.php?id='.$_SESSION['id_user'].'" >Voir mon profil</a> '); ?> </div> 
            
            
    <div class="" style="margin-top:23px; ">
    <div class="titreFoot"><h4>Présentation du projet </h4></div>
  
  <div class="reseau" >

      <div class="insta"> <a href="presentation.php" target="_blank">
      </div>

      <div class="txt">HYPEPIC</a></div>
  </div> 
    </div>

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


<!-- SEARCHBAR -->
<?php 
require_once 'searchbar.php';
?>
<!-- FIN SEARCHBAR -->





    <h2 class="titleHofP ms-1" >Le Hall of Pic</h2>

        
        <!-- all cards -->
        <div class="containerDur">


             <?php 

                         if($dataImage->rowCount() > 0){
                            
                 // echo cards

                 
 while($dataImg = $dataImage->fetch()){
    echo  
                        "<a class='lien' href='imgSelectedMembre.php?id_image=".$dataImg["id_image"]."'> 
                                
                                
                                
                            <div class='parent-cadre' style>
                                    <img class='img-cadre'  src ='img/cadregold.png'> 
                                
                                
                                <div class='interieurs' style='background-image: url(".$dataImg['url_image']. ");'> 
                                
                                
                                
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
                                
                                        //  var_dump($sortByLevel);
                 }
 
                 //  var_dump($dataImg);
              

                        }else{
                            ?><p>aucune image trouvé</p>
                            
                            <br>
                            <br>
                            <a href="allImageMembre.php"><button type="submit" >reset</button></a>
                        
                            <?php
                        } 

                    
                    
                        ?>

                        </div>
                <!-- fin all Cards -->
                    
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