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
	include("connexion.inc.php");
		$med_depotlegal=$_POST['MED_DEPOTLEGAL'];
		// renvoie tous les medicaments qui si situe apres le medicament voulue
        $sql='select * from `MEDICAMENT` WHERE MED_DEPOTLEGAL > "'.$med_depotlegal.'"';
		// execute la requette
        $lesMedicaments=$conn->query($sql);
		// recupere le premier enregistrement
        $medicament = $lesMedicaments->fetch();
		echo '<libMedDepot>'.$medicament['MED_DEPOTLEGAL'].'</libMedDepot> - ';
		echo '<libFamille>'.$medicament['FAM_CODE'].'</libFamille> - ';
        echo '<libMed>'.$medicament['MED_NOMCOMMERCIAL'].'</libMed> - ';
		echo '<libMedComp>'.$medicament['MED_COMPOSITION'].'</libMedComp> - ';
		echo '<libMedEffets>'.$medicament['MED_EFFETS'].'</libMedEffets> - ';
		echo '<libMedContre>'.$medicament['MED_CONTREINDIC'].'</libMedContre> - ';
		echo '<libPrixEnch>'.$medicament['MED_PRIXECHANTILLON'].'</libPrixEnch> - ';
		echo '</infos>';
        // fermeture de la connexion à Mysql
	$conn=null;

} // fin Try
catch(Exception $e){
	echo "erreur";
	throw new Exception('Erreur Exception declenchee');;
	die();
} // fin catch

function gestion_erreur($exception) {
  echo "Une erreur est survenue: " . $exception->getMessage();
  die();
}//fin gestion_erreur


?>
