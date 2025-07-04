<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color:rgb(236, 236, 236);
        }
        .area_personale_login{
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin:1rem;
        }

        .login_box {
            display: flex;
            flex-direction: column;
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        .login_box h2 {
            margin-top:0px;
            margin-bottom: 20px;
            color: #333;
        }

        .login_box input {
            flex-grow: 1;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .login_box button {
            margin-top:10px;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .login_box button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="area_personale_login">
        <div class="login_box">
            <h2>Accesso Utente</h2>
            <input type="text" id="codiceFiscale" placeholder="Codice Fiscale" maxlength="16">
            <input type="password" id="password" placeholder="Password">
            <button onclick="accedi()">Accedi</button>
        </div>
    </div>


    <script>
        function accedi() {
            const cf = document.getElementById("codiceFiscale").value;
            const pwd = document.getElementById("password").value;

            fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `codiceFiscale=${encodeURIComponent(cf)}&password=${encodeURIComponent(pwd)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "insegnante") {
                    window.location.href = "gestione.php";
                } else {
                    alert("Credenziali errate.");
                }
            })
            .catch(() => alert("Errore nella comunicazione col server."));
        }
    </script>
</body>
</html>