<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        body {
            margin: 8px;
            padding: 0;
        }

        input {
            width: 500px;
        }

        button {
            width: 100px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>src-security</h1>

    <p>
        <select name="" id="scenario">
            <option value="">Choisissez votre scénario</option>
            <option value="csrf-vulnerable">CSRF - Version vulnérable</option>
            <option value="csrf-secured">CSRF - Version sécurisée</option>
            <option value="html-js-injection-vulnerable">Injection de code HTML / JS - Version vulnérable</option>
            <option value="html-js-injection-secured">Injection de code HTML / JS - Version sécurisée</option>
            <option value="sql-injection-vulnerable">Injection de code SQL - Version vulnérable</option>
            <option value="sql-injection-secured-quote">Injection de code SQL - Version sécurisée avec quote</option>
            <option value="sql-injection-secured-prepare">Injection de code SQL - Version sécurisée avec prepare</option>
        </select>
    </p>
    <div>
        <form id="form" action="" method="post">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>
            <div id="csrf-token-container" class="hidden">
                <label for="csrf_token">Token CSRF</label>
                <input type="text" name="csrf_token" id="csrf_token">
                <p>
                    timestamp : <?= date('YmdHis') ?>
                </p>
            </div>
            <div>
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>

    <script>
        let scenario = document.getElementById('scenario');
        let form = document.getElementById('form');
        let input = document.getElementById('email');
        let csrfTokenContainer = document.getElementById('csrf-token-container');

        scenario.addEventListener('change', (event) => {
            let option = event.target.value;
            let action = '';
            let email = '';

            csrfTokenContainer.classList.add('hidden');

            switch (option) {
                case 'csrf-vulnerable':
                case 'csrf-secured':
                    action = option + '.php';
                    email = 'foo@example.com';
                    csrfTokenContainer.classList.remove('hidden');
                    break;

                case 'html-js-injection-vulnerable':
                case 'html-js-injection-secured':
                    action = option + '.php';
                    email = '<img src="" onerror="alert(\'You\\\'ve been hacked by JDY!\')">';
                    break;

                case 'sql-injection-vulnerable':
                case 'sql-injection-secured-quote':
                case 'sql-injection-secured-prepare':
                    action = option + '.php';
                    email = '\' OR email LIKE \'%\' ORDER BY id ASC LIMIT 1 OFFSET 0; -- ';
                    break;
            }

            form.action = action;
            input.value = email;
        });
    </script>
</body>
</html>

