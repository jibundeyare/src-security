<?php

// absence de token csrf

// récupération des données du formulaire
$email = isset($_POST['email']) ? $_POST['email'] : '';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF - Version vulnérable</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>CSRF - Version vulnérable</h2>

    <p>
        Vous avez accepté l'invitation de <?= htmlentities($email) ?>.
    </p>
</body>
</html>

