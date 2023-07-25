<?php

// récupération des données du formulaire
$email = isset($_POST['email']) ? $_POST['email'] : '';

// identifiants de connexion à la bdd
$config = require __DIR__.'/config.php';

// connexion à la bdd
try {
    $conn = new PDO($config['dsn'], $config['user'], $config['password']);
} catch (PDOException $e) {
    echo 'erreur de connexion : ' . $e->getMessage() . "<br/>";
    exit();
}

// sécurisation active des données du formulaire
$sanitizedEmail = $conn->quote($email);

// création de la requête sql
$sql = "SELECT * FROM user WHERE email = {$sanitizedEmail} AND enabled = TRUE";

// exécution de la requête sql
try {
    $stmt = $conn->query($sql);
} catch (PDOException $e) {
    echo 'erreur : ' . $e->getMessage() . "<br/>";
    echo $sql . "<br/>";
    exit();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Injection de code SQL - Version sécurisée avec quote()</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>Injection de code SQL - Version sécurisée avec quote()</h2>

    <p>
        Requête SQL générée :<br>
        <code><pre><?= $sql ?></pre></code>
    </p>

    <p>
        Nombre de lignes : <?= $stmt->rowCount() ?>
    </p>

    <p>
        <?php if ($stmt->rowCount()): ?>
            <ul>
                <?php foreach ($stmt->fetchAll() as $row): ?>
                    <li>
                        id: <?= $row['id'] ?><br>
                        email: <?= $row['email'] ?><br>
                        enabled: <?= $row['enabled'] ? 'true' : 'false' ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php else: ?>
            Aucun résultat
        <?php endif ?>
    </p>
</body>
</html>

