
<?php
    session_start();
    $_SESSION["connexion"]=false;
    if(!isset($_SESSION["erreur"])){
        $_SESSION["erreur"]=false;
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../GSB/images/iconeGSB.png" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/gsb.css">
        <title>GSB - Authentification</title>
    </head>
    
    <body id="index">
        <form class="form-signin" name="identification" action="php/authentification.php" method="post">
            <img src="images/logoGSB.png" id="logoNotconnected"alt="" width="300" height="250">
            <h1 id="copyr" class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
            <div id="error">
                <?php
                    if($_SESSION["erreur"]){
                        echo "<div class='alert alert-danger' role='alert'><b>Erreur :</b> indentifiants incorrects !</div>";
                    }
                ?>
            </div>
            <input type="text" id="identifiant" class="form-control"  name="identifiant" placeholder="Identifiant" pattern="[A-Z]([a-z]|é)*(-[A-Z]([a-z])*)?" required autofocus>
            <input type="password" id="motdepasse" name="motdepasse" class="form-control" placeholder="Mot de passe" pattern="[0-3][0-9]-([a-z]){3}-[0-9]{4}" required>
            <button class="btn btn-lg btn-primary btn-block" name="connexion" type="submit">Connexion</button>
            <p id="copyr" class="mt-5 mb-3 text-muted">&copy; 2019 - BTS SIO1 - All rights reserved</p>
        </form>
    </body>
</html>