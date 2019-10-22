<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// se connecte à la base de données pour récupérer le libellé long  à partir du numero reçu en post
// construit un flux XML
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
echo '<infos>';


set_exception_handler('gestion_erreur');


try{
	//appel du fichier de connexion à la base de données
	$bdd = new PDO('mysql:host=localhost;dbname=18ppe2g01;charset=utf8','18ppe2g01','hArmonie(01');
        
        $sql='SELECT * FROM PRATICIEN WHERE PRA_NUM='.$_POST['PRA_NUM'];
        $leslignes=$bdd->query($sql);
        $ligne = $leslignes->fetch();
        if($ligne != null){
            echo '<pra_num>'.$ligne['PRA_NUM'].',</pra_num>';
            echo '<pra_nom>'.$ligne['PRA_NOM'].',</pra_nom>';
            echo '<pra_prenom>'.$ligne['PRA_PRENOM'].',</pra_prenom>';
            echo '<pra_adresse>'.$ligne['PRA_ADRESSE'].',<pra_adresse>'; 
            echo '<pra_cp>'.$ligne['PRA_CP'].',</pra_cp>'; 
            echo '<pra_coef>'.$ligne['PRA_COEFNOTORIETE'].',</pra_coef>';
            echo '<typ_code>'.$ligne['TYP_CODE'].'</typ_code>';
        }
        
        echo '</infos>';
        // fermeture de la connexion à Mysql
	$bdd=null;

} // fin Try
catch(Exception $e){
	//echo "erreur";
	//throw new Exception('Erreur Exception declenchee');;
	die();
}// fin catch

function gestion_erreur($exception) {
  echo "Une erreur est survenue: " . $exception->getMessage();
  die();
}//fin gestion_erreur
?>