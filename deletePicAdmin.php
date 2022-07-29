<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}


require_once 'connect/connect.php';

//23min17  https://www.youtube.com/watch?v=6ZSUTrvFSvM&t=160s&ab_channel=FrenchCoder-D%C3%A9veloppementWeb

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUsers = $bdd->prepare('SELECT * FROM image WHERE id_image = ? ');
    $recupUsers->execute(array($getid));

    if($recupUsers->rowCount() >0){

        $bannirUser = $bdd->prepare('DELETE FROM image WHERE id_image = ?');
        $bannirUser->execute(array($getid));

        header('Location: allImage.php');

        // header('Location: comAsupprimerAdmin.php?id='".$_GET['id']."'');

    }else{
            echo"aucune image trouvé";
        }
    }else{
    echo"l'identifiant n'a apas été récupéré";
}

?>
