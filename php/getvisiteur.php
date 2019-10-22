<?php 
header("Cache-Control: no-cache, must-revalidate"); 
header('Content-Type: text/xml; charset=UTF-8'); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; 

// construit un flux xml basé sur les visiteurs d'une classe obtenue par post
echo '<listevisiteurs>'; 

set_exception_handler('gestion_erreur');


try{
	//appel du fichier de connexion à la base de données
	include("connexion.inc.php");
        // recupere tous les etudiants de la table etudiant
        $sql="select * from VISITEUR where NUM_DPT='".$_POST['code']."'";
        $lesvisiteurs=$conn->query($sql) ;
        $visit = $lesvisiteurs->fetch();
        // parcours des etudiants et construction des noeuds du XML
        while($visit!=null) 
            { 
            echo '<visiteur>';
            echo '<matricule>'.$visit['VIS_MATRICULE'].'</matricule>'; 
            echo '<nom>'.$visit['VIS_NOM'].'</nom>';
            echo '</visiteur>'; 
            $visit = $lesvisiteurs->fetch();

            } 
             
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

echo '</listevisiteurs>'; 
    ?>