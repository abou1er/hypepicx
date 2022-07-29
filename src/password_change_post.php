<?php 
    require_once '../config/config.php';

    if(isset($_POST['password']) && isset($_POST['password_repeat']) && isset($_POST['token_user'])){
        if(!empty($_POST ['password']) && !empty($_POST['password_repeat']) && !empty($_POST['token_user'])){
            $password  = htmlspecialchars($_POST['password']);
            $password_repeat = htmlspecialchars($_POST['password_repeat']);
            $token_user = htmlspecialchars($_POST['token_user']);

            $check = $bdd->prepare('SELECT * FROM user WHERE token_user = ?');
            $check->execute(array($token_user));
            $row = $check->rowCount();

            if($row){
                if($password === $password_repeat){
                    $cost = ['cost' => 13];
                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                    $update = $bdd->prepare('UPDATE user SET motdepasse = ? WHERE token_user = ?');
                    $update->execute(array($password, $token_user));

                    $delete = $bdd->prepare('DELETE FROM recover WHERE token_user = ?');
                    $delete->execute(array($token_user));

                    echo "Le mot de passe a bien été modifié.  <a href='../index.php'>Retour à l'accueil</a>";


                }else{
                    echo "Les mots de passes ne sont pas identiques!";
                }



            }else{
                echo "Le compte n'est pas existant!";
            }

        }else{
            echo "Renseignez le nouveau mot de passe!";
        }
    }

?>