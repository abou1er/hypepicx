<?php 
session_start(); //  if the cookie $_SESSION['admmin'] is not declared then redirection // si le cookie $_SESSION['admin'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';
 

    //query bar search by name // barre de recherche par nom***********************************
    $dataImage = $bdd->query('SELECT * FROM image ORDER BY id_image DESC');


    if (isset($_GET['searching']) AND !empty($_GET['searching'])) {
        $recherche = htmlspecialchars($_GET['searching']);
        $dataImage = $bdd->query('SELECT * FROM image WHERE title_image LIKE "%'.$recherche.'%" OR category_image LIKE "%'.$recherche.'%"  ORDER BY id_image DESC');
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/footer.css">

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
            <a href="index.php">
                <div class="nomdusite render">hypEpic</div>
            </a>
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

    

<!-- SEARCHBAR -->
<?php 
require_once 'searchbar.php';
?>
<!-- FIN SEARCHBAR -->



    <h1>Le Hall of Pic</h1>

        <!-- all cards -->
        <div class="containerDur">
 <?php 

if($dataImage->rowCount() > 0){
   
                 // echo cards

                 require_once 'allcards.php';
                
                // fin cards

                //  var_dump($dataImg);
             
                
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="apparitionAuDefilement.js"></script>
<!-- <script src="satisfaction.js"></script> -->
<script src="script.js"></script>
<script src="burger.js"></script>
    


</html>
