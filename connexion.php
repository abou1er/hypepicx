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
			// $req = "SELECT * FROM user where email=? AND role_user ='admin'";
			$req = "SELECT * FROM user where email=? ";

			// Préparation de la requête
			$req_prep = $bdd->prepare($req);
	
			// Exécution de la requête
			$req_prep->execute(array($_POST['email']));

			// Vérification du mot de passe
			$donnees = $req_prep->fetch();



			if (password_verify($_POST['password'], $donnees['motdepasse'])) {

				if( $donnees['role_user'] == 'membre'){
					$_SESSION['pseudo'] = $donnees['pseudo']; 
					$_SESSION['id_user'] = $donnees['id_user'];
					header("Location: allImageMembre.php?id=".$_SESSION['id_user']);

					

				}else{

					$_SESSION['id_user'] = $donnees['id_user'];
					$_SESSION['pseudo'] = $donnees['pseudo']; 
					$_SESSION['email'] = $donnees['email'];
					$_SESSION['role'] = $donnees['role_user'];
					// $_SESSION['mdp'] = $donnees['motdepasse'];
					
					header('Location: acceuilAdmin.php' );
					
				}

			} else {
			    echo "L'indentifiant est incorrect.";
				
				//  echo
				//  "<a href=/mdpoublie/src/index.php>Mot de passe oublié ?</a>";

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
    <title>connexion hypEpic</title>

	
    <link rel="stylesheet" href="css/allImage.css">

    <!-- <link rel="stylesheet" href="css/addImage.css"> -->

    <link rel="stylesheet" href="css/header.css"> 
    
    <link rel="stylesheet" href="css/connexion.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


   
</head>


<header>
 
<div class="parent">
        <div class="logo">
       </div>



        <div class="parentNomDuSite">
            <div class="nomdusite render">hypEpic</div>
        </div>


        <div class="home">
        </div>



    </div>

    

   
</div>    

    
               
</header>



<body>
    
<div class="slogan"> Les pictures Hype & Epique du net avant première</div>










<div id="parent">
	

	<div class="absolute "> <!--juste la div absolute  -->
	 
		

		
			<form  action="" method="post">
			  	<div class="mb-3">
			  	  <label for="exampleInputEmail1" class="form-label">Adresse e-mail</label>
			  	  <input type="email" class="form-control rounded-pill" id="exampleInputEmail1" aria-describedby="emailHelp" 		placeholder="exemple@gmail.com" 		name="email">
					
			  	</div>
					
			  	<div class="mb-3 col-12">
			  	  <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
			  	  <input type="password"  name="password" class="form-control rounded-pill" id="exampleInputPassword1">
			  	</div>



			  <button type="submit" name="submit"class="btn btn-primary rounded-pill">Se connecter</button>
			</form>
		
			
		<br><br>
			
		<!-- <div class="mb-3 d-flex justify-content-center ">
			<a href="src/index.php">Mot de passe oublié ?</a>
		</div> -->
		


	</div>

	


	<img id="ring" class="ring" src="img/ringseigneuranneaux.png" alt="">

</div>




	</body>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>



</html>

<?php


	}
?>
