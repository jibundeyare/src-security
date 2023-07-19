<?php

$link = mysqli_connect('localhost', 'src_security', '123', 'src_security');

if (!$link) {
    echo 'erreur de connexion : ' . mysqli_connect_error();
    exit();
}

mysqli_set_charset($link, 'utf8mb4');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$sql = "SELECT * FROM user WHERE email = '{$email}' AND enabled = TRUE";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo "erreur : " . mysqli_error($link);
    exit();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Injection de code SQL (version vulnérable)</title>
</head>
<body>
    <h1>src-security</h1>

    <h2>Injection de code SQL (version vulnérable)</h2>

    <p>
        Requête SQL générée :<br>
        <code><?= $sql ?></code>
    </p>

    <p>
        Nombre de lignes : <?= $result->num_rows ?>
    </p>

    <p>
        <?php if ($result->num_rows): ?>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>            
                    <li>
                        id: <?= $row['id'] ?><br>
                        email: <?= $row['email'] ?><br>
                        enabled: <?= $row['enabled'] ? 'true' : 'false' ?>
                    </li>
                <?php endwhile ?>
            </ul>
        <?php else: ?>
            Aucun résultat
        <?php endif ?>
    </p>
</body>
</html>