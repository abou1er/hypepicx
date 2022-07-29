<?php 
session_start();

      
        // $pseudoSaisi = htmlspecialchars($_POST['pseudo']);
        // // $mdpSaisi = htmlspecialchars($_POST['mdp']);
        // $mailSaisil = htmlspecialchars($_POST['mail']);
        try{// va nous permettre d'avoir un retour si c'est pas bon catch nous affiche le msg si erreur dans chemin d'accés

            $bdd = new PDO("mysql:host=localhost;dbname=mdpoublie;charset=utf8", "root", "");
    
        }catch(PDOException $e){
    
            echo $e->getMessage();
        }
    
        //si name=formconnexion  existe alors on est dans la condition... existera au clic du submit
	// Si le formulaire a été soumis
	if (isset($_POST['submit'])) {
		if (empty($_POST['password']) || empty($_POST['email'])){
			echo "Un champ n'a pas été rempli.";
		}
		else{
			// Écriture de la requête
			$req = "SELECT * FROM user where email=? AND role_user ='membre'";

			// Préparation de la requête
			$req_prep = $bdd->prepare($req);


			
			// Exécution de la requête
			$req_prep->execute(array($_POST['email']));

			// Vérification du mot de passe
			$donnees = $req_prep->fetch();
			if (password_verify($_POST['password'], $donnees['motdepasse'])) {
                $_SESSION['email'] = $donnees['email'];
				
				$_SESSION['id_user'] = $donnees['id_user'];
				$_SESSION['pseudo'] = $donnees['pseudo']; //['typo tableau doit être la même']
				$_SESSION['email'] = $donnees['email'];
				$_SESSION['role'] = $donnees['role_user'];
                
                header("Location: profilMembre.php?id=".$_SESSION['id_user']);

			} else {
			    echo "Echec : Non reconnue en tant que membre. Mail ou mot de passe incorrect.";
			}
		}
	}

	// Sinon on affiche le formulaire
	else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion MEMBRE</title>
</head>
<body>
    
</body>
</html>
<h1>connexion pour l'espace MEMBRE</h1>
		<form action="" method="post" align="center" >
			adresse e-mail :<br>
			<input type="text" name="email"><br>
			Mot de passe :<br>
			<input type="password" name="password"><br><br>
			<input type="submit" name="submit" value="Connecté">
		</form>
<?php
	}
?>
	</body>
</html>