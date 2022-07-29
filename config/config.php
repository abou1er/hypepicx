<?php 


try{// va nous permettre d'avoir un retour si c'est pas bon catch nous affiche le msg si erreur dans chemin d'accés

    $bdd = new PDO("mysql:host=localhost;dbname=hypepic2;charset=utf8", "root", "");

}catch(\Exception $e){

    die('Erreur' .$e->getMessage());
}

//https://www.youtube.com/watch?v=T-felqUpR_0&t=251s&ab_channel=NoS1gnal