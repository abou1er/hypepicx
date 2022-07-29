<?php 
    //require_once __DIR__.'/../config/config.php';

    
try{// va nous permettre d'avoir un retour si c'est pas bon catch nous affiche le msg si erreur dans chemin d'accés

    $bdd = new PDO("mysql:host=localhost;dbname=hypepic2;charset=utf8", "root", "");

}catch(\Exception $e){

    die('Erreur' .$e->getMessage());
}

    if(isset($_POST['email']) && !empty($_POST['email'])){

        // $email = htmlspecialchars($_POST['email']);

        // $token_user = bin2hex(openssl_random_pseudo_bytes(24));
        
                                
        // $insert = $bdd->prepare('UPDATE user  SET token_user = ? WHERE email = ?'); **update token si user n'a pas de token
        // $insert->execute(array($token_user, $email));


//https://www.youtube.com/watch?v=T-felqUpR_0&t=251s&ab_channel=NoS1gnal

        $email = htmlspecialchars($_POST['email']);

        $check = $bdd->prepare('SELECT token_user FROM user WHERE email = ? ');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();// si 1 ya bien un token





        if($row){
            $token = bin2hex(openssl_random_pseudo_bytes(24));
            $token_user = $data['token_user'];

            $insert = $bdd->prepare('INSERT INTO recover(token_user, token_recover, email_user,date_demande ) VALUES(?,?,?,NOW()) ');
            $insert->execute(array($token_user, $token, $email));

            $link = 'recover.php?u='.base64_encode($token_user).'&token_recover='.base64_encode($token);

            echo"<a href='$link'>Lien</a>";
        }else{
            echo"Compte non existant";
            //header('Location: ../index.php');
            //die();

        }

    }


?>