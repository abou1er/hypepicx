<?php 
    require_once '../config/config.php';
    if(isset($_GET['u']) && !empty($_GET['u'])){
        $token_user = htmlspecialchars(base64_decode($_GET['u']));
        $check = $bdd->prepare('SELECT * FROM recover WHERE token_user = ?');
        $check->execute(array($token_user));
        $row = $check->rowcount();
            if($row == 0){
                echo "Lien non valide";
                die();

            }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser mot de passe</title>
</head>
<body>
<h4>Réinitialiser mot de passe</h4>

<form action="password_change_post.php" method="post">
    <input type="hidden" name="token_user" value="<?php echo base64_decode(htmlspecialchars($_GET['u'])); ?>" />
    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required/>
    <br><br>
    <input type="password" name="password_repeat" class="form-control" placeholder="Re-tapez le mot de passe" />
    <button type="submit" >nouveau mot de passe</button>




</form>

    
</body>
</html>