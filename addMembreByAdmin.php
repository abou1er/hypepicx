<?php 
session_start(); //  if the cookie $_SESSION['admmin'] is not declared then redirection // si le cookie $_SESSION['admin'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';

    if(isset($_POST['submit'])){
    // si dans ce qui est en method POST présence déclenchement de name='submit' *bouton submit*
    //echo 'a cliké'; //test


                //echo "sa passe"; //test //htmlspecialchars contre injection de code pirate les stocker dans une variable apporte une protection en plus
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mail = htmlspecialchars($_POST['email']);
                $mail2 = htmlspecialchars($_POST['email2']);
    
                    //sha1 hashage du mot de passe 
                // $mdp = sha1($_POST['mdp']);
                $inputmdp1 = htmlspecialchars($_POST['mdp']);
                $inputmdp2 = htmlspecialchars($_POST['mdp2']);

                $mdp= password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                //$mdpverif = password_verify( $_POST['mdp'], $mdp );

                // $mdp2 = sha1($_POST['mdp2']);  
                //$mdp2= password_hash($_POST['mdp2'], PASSWORD_DEFAULT);
               // $mdpverif2= password_verify( $_POST['mdp2'], $mdp2 );  
                // var_dump($mdpverif2);
                // var_dump($mdpverif);


        if(!empty($_POST['pseudo']) && !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) && !empty($_POST['mdp2']))
        // ET SI ce qui est en method POST est différent de vide que les champs nommé son bien rempli

        {

                            // strlen vérifie la longueur de caractère autorisé est respecté
                            $pseudolength = strlen($pseudo);
                                if($pseudolength <= 255){

                        
                        if($mail == $mail2){
                            
                            if(filter_var($mail, FILTER_VALIDATE_EMAIL )){
                            //FILTER_VALIDATE_EMAIL vérifie que c'est bien une adresse mail qui a été rentré. que le type de l'input n'a pas été modifié dans la console

                                $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
                                $reqmail->execute(array($mail));

                                //-----------------rowCount compte le nombre de colonne qui aurait le même contenu
                                $mailexist = $reqmail->rowCount();
                                if($mailexist == 0){ //si égal à zéro donc pas de doublon n'existe pas encore

                                // ***CERATION TOKEN***

                                // $email = htmlspecialchars($_POST['email']);

                                // $token_user = bin2hex(openssl_random_pseudo_bytes(24));
                                
                                                        
                                // $insert = $bdd->prepare('UPDATE user  SET token_user = ? WHERE email = ?');
                                // $insert->execute(array($token_user, $email));
                        
                                

                            
                                        if($inputmdp1 === $inputmdp2){
                                            //REQUETE mis dans une variable prepare la requête voulu pour la $BDD une fois que toute les conditions sont respectées
                                            $insertmbr = $bdd->prepare ("INSERT INTO user(  pseudo, email, motdepasse, role_user, token_user) VALUES(?,?,?,'membre',?)");
                                        

                                            $token_user = bin2hex(openssl_random_pseudo_bytes(24));/** */


                                            // lance l'éxécution de la requête
                                            $insertmbr->execute(array($pseudo,$mail,$mdp,$token_user));
                                            $good  = "votre compte a bien été créé! "."<a href='connexionMembre.php' >Me connecter</a>";

                                            //*header('Location: index.php');* //une fois la REQUETE éxécuté vers ou on veut être rédiriger



                                        }else{
                                            $erreur = 'Les adresses mots de passe ne correspondent pas !';
                                        }

                                }else{
                                    $erreur ="adresse mail déjà utilisé!";
                                }    

                            }else{
                                $erreur = "votre adresse n'est pas valide !";
                            } 
                            
                        }else{
                            $erreur = 'Les adresses mails ou les mots de passes ne correspondent pas !';
                        }


                                }else{
                                    $erreur = 'le pseudo ne doit pas dépasser 255caractère';
                                }




        }
   
        
         else{ 
              $erreur = "l'ensemble des champs doivent être renseigné"; 
              //faire un echo de la variable après le formulaire pour affiché le msg
            
            }


    }
    

    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Ajouter un membre</title>
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
            <a href="index.php">
                <div class="nomdusite render">hypEpic</div>
            </a>
        </div>


        <div class="home">

            <!-- <a href="profilAdmin.php">Voir mon profil<div class="profil"><img src="img/profil.png" alt="icon-panier" width="150%">
            </div></a> -->
            <div class="pseudo"><?php echo $_SESSION['pseudo'];  ?></div>
             <div class="profil"><img src="img/profil.png" alt=""> <?php echo('<br><a href="profilAdmin.php?id='.$_SESSION['id_user'].'" >Voir mon profil</a> '); ?> </div> 



             <div class="retourHall"><img src="img/logo-eye-eye.png" alt="icon-profil"width="160px"><?php echo('<br><a href="allImage.php?id='.$_SESSION['id_user'].'" >Retour Hall of Pics</a> '); ?></div>
    
           
             <a href="acceuilAdmin.php"><div class="acceuil"><img src="img/home.png" alt="icon-profil">
            Retour page accueil Admin </div></a>

        </div>



        <div class="burger" id="burger">

            <span id="spantop"></span>
            <span id="spanmiddle"></span>
            <span id="spanbottom"></span>

        </div>




    </div>

    

    <div class="parentresponsive">
    <div class="menuresponsive" id="menuresponsive">
        <a href="acceuilAdmin.php"  >Accueil</a>

        <?php echo('<br><a href="profilAdmin.php?id='.$_SESSION['id_user'].'" >Profil</a> '); ?>

        <?php echo('<br><a href="allImage.php?id='.$_SESSION['id_user'].'" >Hall of Pics</a> '); ?>

         
    </div>
</div>    

    
</header>    


<body>

  <div class="titrepage">
      
  <div class="letitre"><h2>Ajouter un membre</h2></div>


  <div class="message">

<?php 
    if(isset ($erreur)){
        //si appariton de $erreur alors echo contenu $erreur
        echo '<br><font color="red">'.$erreur .'</<font>';

        // var_dump ($_POST);
    }

    if(isset ($good)){
     //si appariton de $erreur alors echo contenu $erreur
     echo '<br><font color="green">'.$good .'</<font>';

        // var_dump ($_POST);
    }

?>

</div>

</div> 


       



    <div id="parent">
        

            <div class="absolute"> <!--juste la div absolute  -->
         
         

        <form class="connexAd" action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->

            <table>

                <!-- pseudo -->
               <tr>
                <td>
                <label for="pseudo">Pseudo : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Votre pseudo" name="pseudo" id='pseudo' value="<?php if(isset($pseudo)) {echo $pseudo;}?>">
                </td>
               </tr>


                <!-- mail -->
               <tr>
                <td>
                <label  for="email">Mail : </label> 
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentré dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $nomVariable est la variable sécurisé de POST_$nomVariable-------- --->
                <input type="email"  placeholder="Votre mail" name="email" id='email' value="<?php if(isset($mail)) {echo $mail;}?>">
                </td>
               </tr>

                <!-- confirmMail -->
                <tr>
                <td>
                <label for="email2">confirmer votre Mail : </label> 
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentré dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $nomVariable est la variable sécurisé de POST_$nomVariable-------- --->
                <input type="email"  placeholder="confirmer mail" name="email2" id='email2' value="<?php if(isset($mail2)) {echo $mail2;}?>">
                </td>
               </tr>


               <!-- password -->
               <tr>
                <td>
                <label for="mdp">Mot de passe :</label> 
                </td>
                
                <td>
                <input type="password"  placeholder="entrer mot de passe" name="mdp" id='mdp'>
                </td>
               </tr>

               <!-- confirm password -->
               <tr>
                <td>
                <label for="mdp2">confirmer mot de passe :</label> 
                </td>
                
                <td>
                <input type="password"  placeholder="confirmer mot de passe" name="mdp2" id='mdp2'>
                </td>
               </tr>

            </table>

            <input type="submit" name="submit" value=" Je m'inscris">
            <!-- submit tjr dans le formulaire -->

        </form>


           




            </div>

        


        <img id="ring" class="ring" src="img/ringseigneuranneaux.png" alt="">





    </div>

    
</body>

<?php  include_once 'footer.php';?>

<script src="apparitionAuDefilement.js"></script>
<!-- <script src="satisfaction.js"></script> -->
<script src="script.js"></script>
<script src="burger.js"></script>


</html>