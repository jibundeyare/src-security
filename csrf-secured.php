<?php

// récupération du token csrf
$csrfToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

// comparaison de la date d'émission du token à l'heure actuelle
$error = false;
// dans une vraie application il faudrait décrypter le token avant de pouvoir l'utiliser
$tokenTimestamp = (int) $csrfToken;
$currentTimestamp = (int) date('YmdHis');

if ($currentTimestamp - $tokenTimestamp > 60) {
    $error = true;
}

// récupération des données du formulaire
$email = isset($_POST['email']) ? $_POST['email'] : '';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF - Version sécurisée</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>CSRF - Version sécurisée</h2>

    <p>
        <?php if ($error): ?>
            Désolé, votre requête n'est pas valide.
        <?php else: ?>
            Vous avez accepté l'invitation de <?= htmlentities($email) ?>.
        <?php endif ?>
    </p>
</body>
</html>

