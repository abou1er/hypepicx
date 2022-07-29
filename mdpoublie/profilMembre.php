<?php
session_start();

    try{// va nous permettre d'avoir un retour si c'est pas bon catch nous affiche le msg si erreur dans chemin d'accés

        $bdd = new PDO("mysql:host=localhost;dbname=mdpoublie;charset=utf8", "root", "");

    }catch(PDOException $e){

        echo $e->getMessage();
    }
                    //si bonne recup de l'id en GET rentre dans la condition qui se trouve être tte la page fermeture du crochet après </html>
    if(isset($_GET['id'])  && $_GET['id'] > 0 ){
        $getid = intval($_GET['id']); // converti text en nombe /***Mais g pas compris en quoi c'est mieux
        $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();

    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil membre</title>
</head>
<body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo ['pseudo']; ?></h2>
        <br><br>
        pseudo = <?php echo $userinfo ['pseudo']; ?>
        <br>
        mail = <?php echo $userinfo ['email']; ?>
        <br>

        <?php 
                //$_SESSION['id'] cookie créé au moment de la connexion . Donc la personne sur la page et bien la propriétaire de la session
        if(isset($_SESSION['id_user']) AND $userinfo['id_user'] == $_SESSION['id_user']){
            ?> 

            <a href="editProfilMembre.php"> Editer mon profil <?php echo $userinfo ['pseudo']; ?> </a>
            <br>
            <a href="logoutMembre.php"> Déconnexion</a>
            <br>
            <a href="publierCommentaireMembre.php"> accéder au forum</a>

            <br><br><br><br>

            <!-- <a href="deleteMembre.php?id=<?= $user['id_user']; ?> "  style="color:red;"> supprimer mon compte  </a> -->

            <?php
        }
        ?>

        

        <?php 
        if(isset ($erreur)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="red">'.$erreur .'</<font>';
        }
        
        ?>

    
    </div>
    
</body>
</html>

<?php } ?>