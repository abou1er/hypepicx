<?php 
session_start();

      
require_once 'connect/connect.php';
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
                
                // header("Location: profilMembre.php?id=".$_SESSION['id_user']);

				header("Location: allImageMembre.php?id=".$_SESSION['id_user']);

			} else {
			    echo "Echec : Non reconnue en tant que membre. Mail ou mot de passe incorrect.";
			}
		}
	}

	// Sinon on affiche le formulaire
	else {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion MEMBRE</title>

    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/addImage.css">

    <link rel="stylesheet" href="css/header.css"> 
    
    <link rel="stylesheet" href="css/connexion.css">

   
</head>


		<header>
 
		<div class="parent">
        		<div class="logo">
           		 <!-- <a href="index.html">  <img src="img/logokisspng-jacket-denim-clothing-jeans-hoodie-denim-jacket-svg-png-icon-free-download-59453-5b728f8a4e2901.2879395615342345063202.png"  alt="logo">
               		 </a> -->
		</div>



        		<div class="parentNomDuSite">
            		<div class="nomdusite render">hypEpic</div>
        		</div>


        		<div class="home">

           		 <!-- <a href="profilAdmin.php">Voir mon profil<div class="profil"><img src="img/profil.png" alt="icon-panier" width="150%">
            		</div></a> -->
           

        		</div>



    		</div>

    

   
		</div>    

    
               
		</header>



<body>
    
		<div class="slogan"> Les pictures Hype & Epique du net avant première</div>

		<div id="parent">
	

			<div class="absolute "> <!--juste la div absolute  -->
	 
				<form class="connexAd" action="" method="post"  >
					adresse e-mail :<br>
					<input type="text" placeholder="exemple@outmail.com" name="email"><br>
					Mot de passe :<br>
					<input type="password" name="password"><br><br>
					<input type="submit" name="submit" value="Se connecter">
				</form>

				<br><br>

				<a href="src/index.php">Mot de passe oublié ?</a>
		
		



			</div>

	


			<img id="ring" class="ring" src="img/ringseigneuranneaux.png" alt="">

		</div>




	</body>

	<?php  include_once 'footer.php';?>


</html>

<?php


	}
?>
