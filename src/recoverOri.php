<?php 
include '../config/config.php';

if(isset($_GET['u']) && isset($_GET['token']) && !empty($_GET['u']) && !empty($_GET['token'])){
    $u = htmlspecialchars(base64_decode($_GET['u']));  //$u pour utilisateur si une personne accede au code ne devinera pas forcement l'utilité
    $token = htmlspecialchars(base64_decode($_GET['token']));

    $check = $bdd->prepare('SELECT * FROM mdprecup WHERE token_user = ? AND token = ?');
    $check->execute(array($u, $token));
    $row = $check->rowCount();

    var_dump($row);

    // if($row){
    //     $get = $bdd->prepare('SELECT token_user FROM user WHERE token_user = ?');
    //     $get->execute(array($u));
    //     $data_u = $get->fetch();
    //     var_dump($data_u);

    //     echo('pk sa marche');


        //  if(hash_equals($data_u['token_user'], $u)){
        //      header('Location: password_change.php?u='.base64_encode($u));

        //      //var_dump($data_u);

        //  }else{
        //      echo 'Erreur : le token ne correspond pas';
        //  }
    
//     }else{
//         echo "Erreur : compte non valide";
//         var_dump($data_u);
//         var_dump($u);
//     }



}else{
    echo "Lien non valide";
}


?>

