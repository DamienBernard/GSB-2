<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// se connecte à la base de données pour récupérer les données du visiteur à partir du numero reçu en post
// construit un flux XML
echo '<?xml version="1.0" encoding="UTF-8"?>'; 
echo '<infos>';


set_exception_handler('gestion_erreur');


try{
	//appel du fichier de connexion à la base de données
	include("connexion.inc.php");
        //VIS_MATRICULE, VIS_NOM, Vis_PRENOM, VIS_ADRESSE, VIS_VILLE, SEC_CODE 
        $sql="select VIS_NOM, Vis_PRENOM, VIS_ADRESSE, VIS_VILLE, SEC_CODE from VISITEUR where VIS_MATRICULE='".$_POST['num_Visiteur']."'";//$_POST['num_Visiteur'];
        $levisiteur=$conn->query($sql) ;
        $visit = $levisiteur->fetch();
        echo '<nom>'.$visit['VIS_NOM'].'</nom>';
        echo '<prenom>'.$visit['Vis_PRENOM'].'</prenom>';
        echo '<adresse>'.$visit['VIS_ADRESSE'].'</adresse>';
        echo '<ville>'.$visit['VIS_VILLE'].'</ville>';
        echo '<secteur>'.$visit['SEC_CODE'].'</secteur>';
        echo '</infos>';
        // fermeture de la connexion à Mysql
	$conn=null;

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