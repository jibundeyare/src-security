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

// création de la requête sql
$sql = "SELECT * FROM user WHERE email = :email AND enabled = TRUE";
$stmt = $conn->prepare($sql);

// exécution de la requête sql
try {
    // sécurisation passive des données du formulaire
    $stmt->execute([
        'email' => $email,
    ]);

    // capture la sortie de debugDumpParams()
    ob_start();
    $stmt->debugDumpParams();
    $output = ob_get_contents();
    ob_end_clean();
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
    <title>Injection de code SQL - Version sécurisée avec prepare()</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>Injection de code SQL - Version sécurisée avec prepare()</h2>

    <p>
        Requête SQL générée :<br>
        <code><pre><?= $output ?></pre></code>
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

