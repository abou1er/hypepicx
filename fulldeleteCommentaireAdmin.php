<?php 
session_start(); // si le cookie $_SESSION['mdp'] n'est pas déclaré alors redirection
if(!$_SESSION['id_user']){
    header('Location: index.php');

}


require_once 'connect/connect.php';

//23min17  https://www.youtube.com/watch?v=6ZSUTrvFSvM&t=160s&ab_channel=FrenchCoder-D%C3%A9veloppementWeb

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];
    $idImage = $_GET['id_image'];
    $recupUsers = $bdd->prepare('SELECT * FROM comment WHERE id_comment = ? ');
    $recupUsers->execute(array($getid));

    if($recupUsers->rowCount() >0){

        $bannirUser = $bdd->prepare('DELETE FROM comment WHERE id_comment = ?');
        $bannirUser->execute(array($getid));

        
       

        header('Location: imgSelected.php?id_image='.$idImage.'');

        

        //"<a class='lien' href='imgSelected.php?id_image=".$loca["id_image"]."'>
       

    }else{
            echo"aucun commentaire trouvé";
        }
    }else{
    echo"l'identifiant n'a apas été récupéré";


}

?>
