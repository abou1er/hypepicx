<?php 
session_start(); //  if the cookie $_SESSION['admmin'] is not declared then redirection // si le cookie $_SESSION['admin'] n'est pas déclaré alors redirection
if(!$_SESSION['role']){
    header('Location: index.php');

}

require_once 'connect/connect.php';

                
//PARTI INSERT HARDFOOD
if(isset($_POST['submit'])){
    $title_image = htmlspecialchars($_POST['title_image']);
    $url_image = htmlspecialchars($_POST['url_image']);
    $hardfood = "hardfood ";

   
                
                // $nature = htmlspecialchars($_POST['nature']);
                // $nft = htmlspecialchars($_POST['nft']);



    if(!empty($_POST['title_image']) && !empty($_POST['url_image'])){ 



        $insererImage = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');

        $insererImage->execute(array($title_image, $hardfood, $url_image, $_SESSION['id_user']));  //
        
        $good =  "l'image hardfood a bien était ajouté";


        
    }else{
        $erreur = "compléter tous le champs";
    }

}
//****FIN  HARDFOOD****
   


// PARTI INSERT LIFESTYLE

if(isset($_POST['submit_LS'])){
    
    $title_image_LS = htmlspecialchars($_POST['title_image_LS']);
    $url_image_LS = htmlspecialchars($_POST['url_image_LS']);
    $lifestyle = "lifestyle ";

                                                                        //input2 ---->  
if(!empty($_POST['title_image_LS']) && !empty($_POST['url_image_LS']) || !empty($_POST['title_image_LS2']) && !empty($_POST['url_image_LS2']) ){ 

    $title_image_LS2 = htmlspecialchars($_POST['title_image_LS2']);
    $url_image_LS2 = htmlspecialchars($_POST['url_image_LS2']);

    //INSERT INTO `image`( `title_image`,`category_image`, `url_image`, `date_post`, `user_id_user`) VALUES ("Miel","hardfood","img/gif honeyTumblr_l_149405472047514.gif",NOW(),1);
    
    
            $insererImage = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');
    
            $insererImage->execute(array($title_image_LS, $lifestyle, $url_image_LS, $_SESSION['id_user']));  //

    //insert2
    $insererImage2 = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');
    
    $insererImage2->execute(array($title_image_LS2, $lifestyle, $url_image_LS2, $_SESSION['id_user']));  //
      
            $goodLS =  "l'image Lifestyle a bien était ajouté ";
            
        }else{
            $erreur = "compléter tous le champs";
        }

    }

//*****FIN LIFFESTYLE*******


//PARTI INSERT NATURE
if(isset($_POST['submitN'])){
    $title_image_N = htmlspecialchars($_POST['title_image_N']);
    $url_image_N = htmlspecialchars($_POST['url_image_N']);
    $nature = "nature ";

  


    if(!empty($_POST['title_image_N']) && !empty($_POST['url_image_N'])){ 

//INSERT INTO `image`( `title_image`,`category_image`, `url_image`, `date_post`, `user_id_user`) VALUES ("Miel","hardfood","img/gif honeyTumblr_l_149405472047514.gif",NOW(),1);


        $insererImage = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');

        $insererImage->execute(array($title_image_N, $nature, $url_image_N, $_SESSION['id_user']));  //
        
        $goodN =  "l'image nature a bien était ajouté";


        
    }else{
        $erreur = "compléter tous le champs";
    }

}
//****FIN   NATURE****




//PARTI INSERT NFT
if(isset($_POST['submitNFT'])){
    $title_image_NFT = htmlspecialchars($_POST['title_image_NFT']);
    $url_image_NFT = htmlspecialchars($_POST['url_image_NFT']);
    $nft = "nft ";

  


    if(!empty($_POST['title_image_NFT']) && !empty($_POST['url_image_NFT'])){ 

//INSERT INTO `image`( `title_image`,`category_image`, `url_image`, `date_post`, `user_id_user`) VALUES ("Miel","hardfood","img/gif honeyTumblr_l_149405472047514.gif",NOW(),1);


        $insererImage = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');

        $insererImage->execute(array($title_image_NFT, $nft, $url_image_NFT, $_SESSION['id_user']));  //
        
        $goodNFT =  "l'image NFT a bien était ajouté";


        
    }else{
        $erreur = "compléter tous le champs";
    }

}
//****FIN   NFT****



//PARTI INSERT Anime
if(isset($_POST['submitAnim'])){
    $title_image_Anim = htmlspecialchars($_POST['title_image_Anim']);
    $url_image_Anim = htmlspecialchars($_POST['url_image_Anim']);
    $anim = "Anime ";

  


    if(!empty($_POST['title_image_Anim']) && !empty($_POST['url_image_Anim'])){ 

//INSERT INTO `image`( `title_image`,`category_image`, `url_image`, `date_post`, `user_id_user`) VALUES ("Miel","hardfood","img/gif honeyTumblr_l_149405472047514.gif",NOW(),1);


        $insererImage = $bdd->prepare('INSERT INTO `image` (title_image, category_image, url_image, date_post, user_id_user) VALUES(?,?,?,NOW(),?)');

        $insererImage->execute(array($title_image_Anim, $anim, $url_image_Anim, $_SESSION['id_user']));  //
        
        $goodAnim =  "l'image Anim a bien était ajouté";


        
    }else{
        $erreur = "compléter tous le champs";
    }

}
//****FIN   Anime****






?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une Pics</title>

    <link rel="stylesheet" href="css/allImage.css">

    <link rel="stylesheet" href="css/addImage.css">

    <link rel="stylesheet" href="css/header.css">   

    <link rel="stylesheet" href="css/borderform">   

   
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
    <div class="central">
    <h3>Publier une Pics</h3>
    </div>

    <form action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->

            <table>

                <!-- HARDFOOD -->
               <tr>
                <td>
                <label for="hardfood2">Ajouter une image dans la catégorie HARDFOOD : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image" id='hardfood2' value="<?php if(isset($title_image)) {echo $title_image;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image" id='hardfood2' value="<?php if(isset($url_image)) {echo $url_image;}?>">
                </td>
               </tr>

            </table>

            <input type="submit" name="submit" value=" Ajouter l'image">
            <!-- submit tjr dans le formulaire -->

    </form>


<br><br>

        <!-- insertion LIFESTYLE -->
        
    <form action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->

            <table>




               <!--LIFESTYLE -->
               <tr>
                <td>
                <label for="lifestyle">Ajouter une image dans la catégorie LIFESTYLE : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image_LS" id='lifestyle' value="<?php if(isset($title_image_LS)) {echo $title_image_LS;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image_LS" id='lifestyle' value="<?php if(isset($url_image_LS)) {echo $url_image_LS;}?>">
                </td>



                <!-- //input2 -->
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image_LS2" id='lifestyle' value="<?php if(isset($title_image_LS2)) {echo $title_image_LS2;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image_LS2" id='lifestyle' value="<?php if(isset($url_image_LS2)) {echo $url_image_LS2;}?>">
                </td>
               </tr>


            </table>

            <input type="submit" name="submit_LS" value=" Ajouter l'image">
            <!-- submit tjr dans le formulaire -->

        </form>

<br><br>


<!-- NATURE -->
 <form action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->
            <table>

                
               <tr>
                <td>
                <label for="nature">Ajouter une image dans la catégorie NATURE : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image_N" id='nature' value="<?php if(isset($title_image_N)) {echo $title_image_N;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image_N" id='nature' value="<?php if(isset($url_image_N)) {echo $url_image_N;}?>">
                </td>
               </tr>

            </table>

            <input type="submit" name="submitN" value=" Ajouter l'image">
            <!-- submit tjr dans le formulaire -->

        </form>
        <!-- FIN NATURE -->


<br><br>

<!-- NFT -->
<form action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->
            <table>

                
               <tr>
                <td>
                <label for="nature">Ajouter une image dans la catégorie NFT : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image_NFT" id='nature' value="<?php if(isset($title_image_NFT)) {echo $title_image_NFT;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image_NFT" id='nature' value="<?php if(isset($url_image_NFT)) {echo $url_image_NFT;}?>">
                </td>
               </tr>

            </table>

            <input type="submit" name="submitNFT" value=" Ajouter l'image">
            <!-- submit tjr dans le formulaire -->

        </form>
        <!-- FIN NFT -->

        <br>
        
<!-- Anim -->
<form action=""  method="post">
        <!-- action="nomDePageRedirection" post envoie la recup à la base de donnée -->
            <table>

                
               <tr>
                <td>
                <label for="nature">Ajouter une image dans la catégorie Anim : </label> 
                <!-- for="pseudo" lié à l'id pseudo, cliker sur pseudo me mettra dans linput lié -->
                </td>
                
                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="Entrer le titre de l'image" name="title_image_Anim" id='nature' value="<?php if(isset($title_image_Anim)) {echo $title_image_Anim;}?>">
                </td>

                <td> <!------------------------------------------------value sera = a ce qui sera rentre dans l'input même si cT mauvais au rechargement submit sera tjr écrit dans linput $pseudo est la variable sécurisé de POST_$pseudo-------- --->
                <input type="text"  placeholder="URL de l'image" name="url_image_Anim" id='nature' value="<?php if(isset($url_image_Anim)) {echo $url_image_Anim;}?>">
                </td>
               </tr>

            </table>

            <input type="submit" name="submitAnim" value=" Ajouter l'image">
            <!-- submit tjr dans le formulaire -->

        </form>
        <!-- FIN Anim -->

<br>
<br>
<div class="retour">

<?php 
     //retour execution ANIME
     if(isset ($goodAnim)){
        //si appariton de $erreur alors echo contenu $erreur
        echo '<br><font color="cyan">'.$goodAnim .'</<font>';
                    
    }
    if(isset ($erreurAnim)){
        //si appariton de $erreur alors echo contenu $erreur
        echo '<br><font color="red">'.$erreurAnim .'</<font>';
                   
    }



        //retour execution HARDFOOD
        if(isset ($erreur)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="red">'.$erreur .'</<font>';
                       
        }
        if(isset ($good)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="green">'.$good .'</<font>';
            
            
        }


        //retour execution LIFESTYLE
        if(isset ($goodLS)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="cyan">'.$goodLS .'</<font>';
                        
        }
        if(isset ($erreurLS)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="red">'.$erreur .'</<font>';
                       
        }


        //retour execution NATURE
        if(isset ($goodN)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="chartreuse">'.$goodN .'</<font>';
                        
        }
        if(isset ($erreurN)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><font color="red">'.$erreur .'</<font>';
                       
        }

        //retour execution NATURE
        if(isset ($goodNFT)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br><span class="textemulticolore">'.$goodNFT .'</span>';
                        
        }
        if(isset ($erreurNFT)){
            //si appariton de $erreur alors echo contenu $erreur
            echo '<br> <font color="red">'.$erreur .'</<font>';
                       
        }


        
        ?>

</div>        
<br><br>
<a href="acceuilAdmin.php">Retour accueil ADMIN</a>


</body>
<?php  include_once 'footer.php';?>

<script src="script.js"></script>
<script src="burger.js"></script>
    

</html>