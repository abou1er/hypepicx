<?php
session_start();

    try{// va nous permettre d'avoir un retour si c'est pas bon catch nous affiche le msg si erreur dans chemin d'accés

        $bdd = new PDO("mysql:host=localhost;dbname=mdpoublie;charset=utf8", "root", "");

    }catch(PDOException $e){

        echo $e->getMessage();
    }
                    //si bonne recup de l'id en GET rentre dans la condition qui se trouve être tte la page Fermeture du crochet après </html> else redirection page de connexion
    if(isset($_SESSION['id_user'])){

        $requser = $bdd->prepare('SELECT * FROM user WHERE id_user = ?');
        $requser->execute(array($_SESSION['id_user']));
        $user = $requser->fetch();


        if(isset($_POST['profil']) AND isset($_POST['newpseudo'])AND ($_POST['newpseudo']) == $user['pseudo']){
            header("Location: profilMembre.php?id=".$_SESSION['id_user']);
        }



                    //condition de modif du pseudo
            if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) && ($_POST['newpseudo']) !=  $user['pseudo']){

                $newpseudo = htmlspecialchars($_POST['newpseudo']);
                $insertpseudo = $bdd->prepare('UPDATE user SET pseudo = ? WHERE id_user = ?');
                $insertpseudo->execute(array($newpseudo, $_SESSION['id_user']));
                header("Location: profilMembre.php?id=".$_SESSION['id_user']);
            }

            //condition de modif du mail
            if(isset($_POST['newmail']) AND !empty($_POST['newmail']) && ($_POST['newmail']) !=  $user['mail']){
                $newmail = htmlspecialchars($_POST['newmail']);
                $insertmail = $bdd->prepare('UPDATE user SET email = ? WHERE id_user = ?');
                $insertmail->execute(array($newmail, $_SESSION['id_user']));
                header("Location: profilMembre.php?id=".$_SESSION['id_user']);
            }
            
            
             //condition de modif mdp
             if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) && isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])){
                
               
                $inputmdp1 = htmlspecialchars($_POST['newmdp1']);
                $inputmdp2 = htmlspecialchars($_POST['newmdp2']);


                $mdp= password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
                
                

                if($inputmdp1 ==  $inputmdp2){
                    $insertmdp = $bdd->prepare("UPDATE user SET motdepasse = ? WHERE id_user = ?");
                    $insertmdp->execute(array( $mdp, $_SESSION['id_user']));

                    header("Location: profilMembre.php?id=".$_SESSION['id_user']);

                }else{
                    $msg="les mdp ne correspondent pas";
                }
 
            }
            
            if(isset($_POST['newpseudo'])AND $_POST['newpseudo'] == $user['pseudo']){
                
                header("Location: profilMembre.php?id=".$_SESSION['id_user']);
            }

            





        
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
        <h2>Editer mon profil </h2>
        <br><br>
        <form method='POST' action="">


            <p> <strong>Pseudo actuel:</strong>   <?php echo$user['pseudo']; ?></p> 
            

            <!-- <label for="">Mail actuel: </label>
            <input type="mail" name="mailactuel" placeholder='mail actuel'     id="" value ="<?php echo$user['email']; ?>"> <br><br> -->
            <p> <strong>Mail actuel:</strong>   <?php echo$user['email']; ?></p> 




            <label for="">Pseudo: </label>
            <input type="text" name="newpseudo" placeholder='nouveau pseudo voulu' id="" > <br><br>
            
            <label for="">Mail: </label>
            <input type="mail" name="newmail" placeholder='nouveau mail voulu'     id="" > <br><br>



            <input type="submit" name="submit" value="Mettre à jour le profil"> <br><br>
        </form>
        
        <a href="editProfilMdpMembre.php?id=<?= $_SESSION['id_user']; ?>"><button>changer mdp</button></a>
        
        <a href="profilMembre.php?id=<?= $_SESSION['id_user']; ?>"><button>revenir page profil</button></a>
       
       
       <?php if(isset($msg)){
           echo $msg;
       } ?>
    
    </div>
    
</body>
</html>

<?php } else {
    header("Location: profilMembre.php?id=".$_SESSION['id_user']);
}?>