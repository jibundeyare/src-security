# src-security

Ce repo contient des exemples de code vulnérable aux attaques d'injection de code HTML / JS ou de code SQL.
Il montre également comment se prémunir de ces attaques.

## Prérequis

- PHP 8.x
- MariaDB 10.x

## Installation

Le fichier `src_security.sql` créé une BDD nommé `src_security`.
Il vous faut un accès à MariaDB possédant les privilèges nécessaires pour créer cette BDD.

```
git clone https://github.com/jibundeyare/src-security.git
cd src-security
# remplacez `foo` par un utilisateur valide
mariadb -u foo -p < src_security.sql
cp config.php.dist config.php
```

Ouvrez le fichier `config.php` et saisissez les codes d'accès à la BDD `src_security` :

```
return [
    'dsn' => 'mysql:dbname=src_security;host=127.0.0.1;port=3306;charset=utf8mb4',
    'user' => 'foo',
    'password' => '123',
];
```

## Utilisation

Lancez le serveur web de développement :

```
php -S localhost:8000
```

Puis ouvrez le lien suivant avec votre navigateur web : [http://localhost:8000](http://localhost:8000)

## Bugs

Des bugs de sécurité majeurs !

## Licence

Ce projet est soumis aux conditions de la licence GNU GPLv3.

[GNU General Public License v3.0 | Choose a License](https://choosealicense.com/licenses/gpl-3.0/)

