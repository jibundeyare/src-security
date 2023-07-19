<?php

$email = isset($_POST['email']) ? $_POST['email'] : '';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Injection de code HTML / JS (version vulnérable)</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>Injection de code HTML / JS (version vulnérable)</h2>

    <p>
        Résultat du code vulnérable <?= $email ?>
    </p>
</body>
</html>