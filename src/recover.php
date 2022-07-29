<?php 
include '../config/config.php';

if(isset($_GET['u']) && isset($_GET['token_recover']) && !empty($_GET['u']) && !empty($_GET['token_recover'])){
    $u = htmlspecialchars(base64_decode($_GET['u']));  //$u pour utilisateur si une personne accede au code ne devinera pas forcement l'utilité
    $token = htmlspecialchars(base64_decode($_GET['token_recover']));

    $check = $bdd->prepare('SELECT * FROM recover WHERE token_user = ? AND token_recover = ?');
    var_dump($check->execute(array($u, $token)));

    $data = $check->fetch();
    $row = $check->rowCount();
   
    // var_dump($u);
    // var_dump($token);
    // var_dump($row);
    // u= ODFhMDBkNTRmNDFkZTllNGMwYjI3ZmRmYmM0MzAyNzVkNTcwNjczZTQ1NDU3ZjE3  &token=   MzBkZThjNjk5NDZkY2FkNDBjMzlhODlkZTZkNWMxY2YxN2ZlOTJmNWIwNDVhMTFi
    // 81a00d54f41de9e4c0b27fdfbc430275d570673e45457f17
    // 81a00d54f41de9e4c0b27fdfbc430275d570673e45457f17

    // 3d6ec4cee746ec472f2d385539b5b4255b7dcf5ce69748d2
    // 3d6ec4cee746ec472f2d385539b5b4255b7dcf5ce69748d2

    if($row == 1){
    
        $get = $bdd->prepare('SELECT token_user FROM user WHERE token_user = ?');
        $get->execute(array($u));
        $data_u = $get->fetch();

        if(($data_u['token_user'] === $u)){

            header('Location: password_change.php?u='.base64_encode($u));
            die();
        }else{
            echo "Erreur de compte";
    
        }


    }else{
        echo "Erreur : compte non valide";
        $get = $bdd->prepare('SELECT token_user FROM user WHERE token_user = ?');
        $get->execute(array($u));
        $data_u = $get->fetch();
        // var_dump($data_u);

        echo "valeur de u";
        $u = htmlspecialchars(base64_decode($_GET['u']));  //$u pour utilisateur si une personne accede au code ne devinera pas forcement l'utilité
    //     // var_dump($u);
    }


 }else{
 echo "Lien non valide"; }



        
 

