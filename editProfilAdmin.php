<?php
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';

                    //si bonne recup de l'id en GET rentre dans la condition qui se trouve être tte la page Fermeture du crochet après </html> else redirection page de connexion
    if(isset($_SESSION['id_user'])){

        $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($_SESSION['id_user']));
        $user = $requser->fetch();


        if(isset($_POST['profil']) AND isset($_POST['newpseudo'])AND ($_POST['newpseudo']) == $user['pseudo']){
            header("Location: profilAdmin.php?id=".$_SESSION['id_user']);
        }



                    //condition de modif du pseudo
            if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) && ($_POST['newpseudo']) !=  $user['pseudo']){

                $newpseudo = htmlspecialchars($_POST['newpseudo']);
                $insertpseudo = $bdd->prepare('UPDATE user SET pseudo = ? WHERE id_user = ?');
                $insertpseudo->execute(array($newpseudo, $_SESSION['id_user']));
                header("Location: profilAdmin.php?id=".$_SESSION['id_user']);
            }

            //condition de modif du mail
            if(isset($_POST['newmail']) AND !empty($_POST['newmail']) && ($_POST['newmail']) !=  $user['mail']){
                $newmail = htmlspecialchars($_POST['newmail']);
                $insertmail = $bdd->prepare('UPDATE user SET email = ? WHERE id_user = ?');
                $insertmail->execute(array($newmail, $_SESSION['id_user']));
                header("Location: profilAdmin.php?id=".$_SESSION['id_user']);
            }
            
         
            
            if(isset($_POST['newpseudo'])AND $_POST['newpseudo'] == $user['pseudo']){
                
                header("Location: profilAdmin.php?id=".$_SESSION['id_user']);
            }

            





        
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition de profil Admin</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/profilAdmin.css">

</head>
<body>

        <header>
            
<div class="parent">
        <div class="logo">
            
        </div>



        <div class="parentNomDuSite">
            <a href="index.php">
                <div class="nomdusite render">hypEpic</div>
            </a>
        </div>


        <div class="home">

      


             <div class="retourHall"><img src="img/logo-eye-eye.png" alt="icon-profil"><?php echo('<br><a href="allImage.php?id='.$_SESSION['id_user'].'" >Retour Hall of Pics</a> '); ?></div>
    
           
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

    <div class="central">
        <h2> <img src="img/profil.png" width="60px" alt=""> Editer mon profil </h2>
        <br><br>
        <form method='POST' action="">

            <p> <strong>Pseudo actuel:</strong>   <?php echo$user['pseudo']; ?></p> 
            

            <!-- <label for="">Mail actuel: </label>
            <input type="mail" name="mailactuel" placeholder='mail actuel'     id="" value ="<?php echo$user['email']; ?>"> <br><br> -->
            <p> <strong>Mail actuel:</strong>   <?php echo$user['email']; ?></p> 



            <label for="">Mettre à jour mon pseudo : </label>
            <input type="text" name="newpseudo" placeholder='nouveau pseudo voulu' id="" > <br><br>
            
            <!-- <label for="">Mail: </label>
            <input type="mail" name="newmail" placeholder='nouveau mail voulu'     id="" > <br><br> -->


            <input type="submit" name="submit" value="Changer mon pseudo"> <br><br>
        </form>
        
        <a href="editProfilMdpAdmin.php?id=<?= $_SESSION['id_user']; ?>"><button>Changer le mot de passe</button></a>
        <br>
        <a href="profilAdmin.php?id=<?= $_SESSION['id_user']; ?>"><button>Revenir page profil</button></a>
       
       
       <?php if(isset($msg)){
           echo $msg;
       } ?>
    
    </div>
    
</body>

<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    

</html>

<?php } else {
    header("Location: profilAdmin.php?id=".$_SESSION['id_user']);
}?>