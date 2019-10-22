<?php

session_start();

//Variables  définissant les alternatives possibles
$_SESSION["envoieFormulaire"] = false;
$_SESSION["raffraichissement"] = false;


if (empty($_POST)) { //Si la page est chargée via un raffraichissement
    $_SESSION["raffraichissement"] = true;
} else {    //Si la page est chargée via l'envoi du formulaire
    $_SESSION["envoieFormulaire"] = true;
}

include 'sousProgrammes.php';

if ($_SESSION["raffraichissement"] === true && $_SESSION["connexion"] === true) { //Si on tente d'accéder à cette page en étant déja connecté
    header('Location:accueil.php');    //Renvoie sur la page visiteur
} else {
    if ($_SESSION["raffraichissement"] === true && $_SESSION["connexion"] === false) { //Si on tente d'accéder à cette page sans être connecté
        header('Location:../index.php');    //Renvoie sur la page de connexion
    } else {
        if ($_SESSION["envoieFormulaire"] === true) {
            $_SESSION["identifiant"] = $_POST['identifiant'];   //Récupère l'identifiant du visiteur
            $_SESSION["motDePasse"] = $_POST['motdepasse'];     //Récupère le mot de passe saisie
        }
        try { //Tente d'éxécuter le code suivant, Si erreur -> Arrête l'éxecution du code et passe dans le catch

            if ($_SESSION["envoieFormulaire"] === true) { //Si le formulaire a bien été envoyé
                //Connexion a notre base de données
                $bdd = new PDO('mysql:host=localhost;dbname=...;charset=utf8', '...', '...');
                //Selectionne toutes les informations du visiteur saisi
                $reponse = $bdd->query('SELECT * FROM VISITEUR WHERE VIS_NOM =\'' . $_SESSION["identifiant"] . '\''); //
                //Permet de lire la réponse de la requête SQL
                $donnees = $reponse->fetch();
                //Récupère le mot de passe du visiteur dans la table VISITEUR
                $mdpBD = $donnees['VIS_DATEEMBAUCHE'];
                //Reformule le format de la date d'embauche du visiteur
                $mdpBD = date('d-m-Y', strtotime($mdpBD));
                $mdpBD = modulerDateEmbauche($mdpBD);

            //if ($_SESSION["envoieFormulaire"] === true) {
                //Vérifie si le mot de passe saisi corespond à celui de l'utilisateur dans la base de donnée
                if ($_SESSION["identifiant"] === $donnees['VIS_NOM'] && $_SESSION["motDePasse"] === $mdpBD) {
                    $_SESSION["connexion"] = true;  //Indique que l'utilisateur est bien connecté
                    header('Location:accueil.php');    //Envoi sur la page du visiteur
                } else { //Si la connexion a échoué
                    $_SESSION["erreur"]=true;
                    header('Location:../index.php');
                }
            }
            $reponse->closeCursor(); // Termine le traitement de la requête
        } catch (Exception $e) {
            die('Erreur de connexion ');    //Message d'erreur du try
        }
    }
}
?>
