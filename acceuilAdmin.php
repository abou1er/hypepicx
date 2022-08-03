<?php 
session_start(); //  if the cookie $_SESSION['admmin'] is not declared then redirection // si le cookie $_SESSION['admin'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';

if(isset($_SESSION['email'])){

    $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
    $requser->execute(array($_SESSION['id_user']));
    $user = $requser->fetch();

                            //the $_SESSION variable is usable if *session_start();* at the top of the page 
                            // la variable de $_SESSION est utilisable si *session_start();* en haut de page
                            $_SESSION['id_user'] = $user['id_user'];
                            $_SESSION['pseudo'] = $user['pseudo']; // typography of the table must be the same //['typo tableau doit être la même']
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['role'] = $user['role_user'];
                            
                            // $_SESSION['motdepasse'] = $user['motdepasse'];
                            
}else{
    header('Location: index.php' );
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil Admin</title>

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
            
                  
            
            
                         <div class="retourHall"></div>
                
                       
                        <div class="acceuil"></div>
            
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

        <a href="membre.php">Afficher tous les membres</a>
        
        <br>
        <a href="editProfilAdmin.php">Editer mon profil</a>
        <br>
        <a href="addMembrebyAdmin.php">Ajouter un membre</a>
        <br>
        <a href="addAdminByAdmin.php">Ajouter un Admin</a>
        <br>
        <a href="addImage2.php">Ajouter une image</a>
        <br>
        <a href="allImage.php">Accéder à la galerie</a>
        <br>

        <a href="imageADelAdmin.php">Supprimer des pics</a>
        <br>

        <a href="logout.php">déconnexion</a>

    </div>



</body>
<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
</html>

