<?php
session_start();

if (!$_SESSION["connexion"]) { //Si aucun utilisateur n'est connecté
    header('Location:../index.php');    //Renvoie sur la page d'authentification (index.php)
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../GSB/images/iconeGSB.png" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/gsb.css">
        <script type="text/javascript" src="../js/fichier_javascript_gsb.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>GSB - Authentification</title>
    </head>

    <body <!-- Corps du document -->
        <div class="left">
            <div class="item-titre">
                <span class="glyphicon glyphicon-align-justify"></span>
                <b><u>Connecté</u> :</b> <?php echo $_SESSION["identifiant"]; //Affichage du nom du visiteur?>
            </div>
            <div class="item">
                <span class="glyphicon glyphicon-home"></span>
                <a id="links" href="accueil.php">Accueil</a>
            </div>
            <div class="item-titre">
                <span class="glyphicon glyphicon-folder-open"></span>
                <b>COMPTES-RENDUS</b>
            </div>
            <div class="item">
                <span class="glyphicon glyphicon-plus"></span>
                <a id="links" href="creerCR.php">Nouveaux</a>
            </div>
            <div class="item-titre">
                <span class="glyphicon glyphicon-folder-open"></span>
                <b>CONSULTER</b>
            </div> 
            <div class="item">
                <svg class="glyphicon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 192 192" style=" fill:#000000;"><g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g id="original-icon" fill="#ffffff"><g id="surface1"><path d="M137.53846,0.92308c-13.70192,0 -27.375,5.25 -37.84615,15.69231c-1.32692,1.35577 -18.20192,17.97116 -33.92308,33.69231c-22.84615,22.84615 -47.10577,47.10577 -49.15385,49.15385c-20.91346,20.91346 -20.91346,55.00962 0,75.92308c10.44231,10.44231 24.375,15.69231 38.07692,15.69231c13.70192,0 27.375,-5.25 37.84615,-15.69231c1.64423,-1.67307 26.19231,-26.19231 49.15385,-49.15385c15.77885,-15.77885 32.27885,-32.50962 33.69231,-33.92308c20.91346,-20.91346 20.91346,-54.77885 0,-75.69231c-10.4423,-10.4423 -24.14423,-15.69231 -37.84615,-15.69231zM137.53846,15.69231c10.35577,0 20.13462,3.98077 27.46154,11.30769c15.11538,15.11538 15.08654,39.80769 0,54.92308c-1.41346,1.41346 -18.14423,17.91346 -33.92308,33.69231l-41.53846,-41.53846l-70.84615,70.84615c-6.25961,-17.04808 10.38462,-36.46154 10.38462,-36.46154l47.30769,-47.53846c15.72115,-15.72115 32.36539,-32.59615 33.69231,-33.92308c7.32693,-7.32692 17.10577,-11.30769 27.46154,-11.30769z"></path></g></g><path d="" fill="none"></path><path d="" fill="none"></path><path d="M96,192c-53.01934,0 -96,-42.98066 -96,-96v0c0,-53.01934 42.98066,-96 96,-96v0c53.01934,0 96,42.98066 96,96v0c0,53.01934 -42.98066,96 -96,96z" fill="none"></path><path d="M96,188.16c-50.89856,0 -92.16,-41.26144 -92.16,-92.16v0c0,-50.89856 41.26144,-92.16 92.16,-92.16v0c50.89856,0 92.16,41.26144 92.16,92.16v0c0,50.89856 -41.26144,92.16 -92.16,92.16z" fill="none"></path><path d="M0,192v-192h192v192z" fill="none"></path><path d="M3.84,188.16v-184.32h184.32v184.32z" fill="none"></path></g></g></svg>
                <a id="links" href="medicaments.php">Médicaments</a>
            </div>
            <div class="item">
                <svg class="glyphicon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 192 192" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M96,0c-29.58,0 -34.95,8.34 -35.88,10.92c-0.105,0.285 -0.21,0.66 -0.24,0.96l-4.44,39.12c5.88,-2.565 13.935,-2.235 24.36,-1.68c4.845,0.255 10.335,0.6 16.2,0.6c5.85,0 11.355,-0.345 16.2,-0.6c10.41,-0.555 18.48,-0.885 24.36,1.68l-4.44,-39.12c-0.03,-0.3 -0.135,-0.675 -0.24,-0.96c-0.93,-2.58 -6.315,-10.92 -35.88,-10.92zM92.16,15.36h7.68v11.52h11.52v7.68h-11.52v11.52h-7.68v-11.52h-11.52v-7.68h11.52zM71.64,56.64c-7.2,-0.21 -12.72,0.255 -15.36,2.76c-1.725,1.65 -2.52,4.59 -2.52,9c0,23.295 18.945,42.24 42.24,42.24c23.295,0 42.24,-18.945 42.24,-42.24c0,-4.41 -0.795,-7.35 -2.52,-9c-3.51,-3.33 -12.225,-2.97 -23.16,-2.4c-4.935,0.255 -10.5,0.6 -16.56,0.6c-6.06,0 -11.625,-0.345 -16.56,-0.6c-2.73,-0.15 -5.4,-0.285 -7.8,-0.36zM96,114.48c-8.61,0 -17.175,0.78 -25.32,2.28l25.32,61.44l25.68,-61.32c-8.28,-1.56 -16.92,-2.4 -25.68,-2.4zM63.12,118.44c-31.245,7.59 -55.44,24.975 -55.44,43.2v30.36h88.32c-1.545,0 -3.015,-0.96 -3.6,-2.4zM96,192h88.32v-30.36c0,-18.135 -23.925,-35.55 -54.96,-43.2l-29.76,71.16c-0.6,1.425 -2.055,2.4 -3.6,2.4z"></path></g></g></g></svg>
                <a id="links" href="praticiens.php">Praticiens</a>
            </div>
            <div class="item">
                <svg class="glyphicon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 192 192"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,192v-192h192v192z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M122.30769,117.40385c-1.18269,-0.37501 -8.59615,-3.72116 -3.95192,-17.82693h-0.0577c12.08654,-12.43269 21.31731,-32.48077 21.31731,-52.21153c0,-30.31731 -20.16346,-46.21154 -43.61538,-46.21154c-23.45192,0 -43.5,15.89423 -43.5,46.21154c0,19.8173 9.17308,39.92308 21.34615,52.35576c4.73077,12.43269 -3.75,17.04808 -5.50962,17.6827c-24.54807,8.88462 -53.33654,25.06731 -53.33654,41.04807c0,4.29808 0,1.70192 0,6c0,21.75 42.17308,26.71154 81.23077,26.71154c39.11538,0 80.76923,-4.96154 80.76923,-26.71154c0,-4.29808 0,-1.70192 0,-6c0,-16.4423 -28.93269,-32.50961 -54.69231,-41.04807z"></path></g></g></g></svg>
                <a id="links" href="visiteurs.php">Autres visiteurs</a>
            </div>
        </div>
        <div class="right">
            <img src='../images/banniere.png' id="logoConnecte" height="200" alt="">
            <!-- THÉO - Il faut que tu modifies que dans cette <div>-->
            
            
            
            
            
        </div>
    </body>
</html>

