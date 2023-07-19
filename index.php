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
    </style>
</head>
<body>
    <h1>src-security</h1>

    <p>
        <select name="" id="scenario">
            <option value="">Choisissez votre scénario</option>
            <option value="html-js-injection-vulnerable">Injection de code HTML / JS (version vulnérable)</option>
            <option value="html-js-injection-secured">Injection de code HTML / JS (version sécurisée)</option>
            <option value="sql-injection-vulnerable">Injection de code SQL (version vulnérable)</option>
            <option value="sql-injection-secured">Injection de code SQL (version sécurisée)</option>
        </select>
    </p>
    <div>
        <form id="form" action="" method="post">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <button type="submit">Valider</button>
        </form>
    </div>

    <script>
        let scenario = document.getElementById('scenario');
        let form = document.getElementById('form');
        let input = document.getElementById('email');

        scenario.addEventListener('change', (event) => {
            let option = event.target.value;
            let action = '';
            let email = '';

            switch (option) {
                case 'html-js-injection-vulnerable':
                case 'html-js-injection-secured':
                    action = option + '.php';
                    email = '<img src="" onerror="alert(\'You\\\'ve been hacked by JDY!\')">';
                    break;

                case 'sql-injection-vulnerable':
                case 'sql-injection-secured':
                    action = option + '.php';
                    email = '\' OR email LIKE \'%\' ORDER BY id ASC LIMIT 1 OFFSET 0; -- >';
                    break;
            }

            form.action = action;
            input.value = email;
        });
    </script>
</body>
</html>
