<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "root";
$basededonnees = "evan_injections_sql";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupération des données envoyées par le formulaire
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête SQL pour insérer les données dans la table users
    $requete = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    // Exécution de la requête
    if (mysqli_query($connexion, $requete)) {
        echo '<div class="alert alert-success" role="alert" align="center"> L\'utilisateur a été enregistré avec succès. </div>';

    } else {
        echo '<div class="alert alert-danger" role="alert" align="center"> Erreur lors de l\'enregistrement de l\'utilisateur : '. mysqli_error($connexion) .' </div>' ;
    }
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>

<!-- Formulaire d'enregistrement de l'utilisateur -->
<!DOCTYPE html>
<html>
<head>
    <title>Enregistrement utilisateur</title>
    <style>
            body{
                background: grey; 
            }
            input
            {
                display: block;
            }

            .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: rgba(24, 20, 20, 0.987);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
            }

            .login-box .user-box {
            position: relative;
            }

            .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
            }

            .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            pointer-events: none;
            transition: .5s;
            }

            .login-box .user-box input:focus ~ label,
            .login-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #bdb8b8;
            font-size: 12px;
            }

            .login-box form .a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            margin-top: 40px;
            letter-spacing: 4px
            }

            .login-box .a:hover {
            background: red;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px red,
                        0 0 25px red,
                        0 0 50px red,
                        0 0 100px red;
            }

            .login-box .a {
            position: absolute;
            display: block;
            }

            @keyframes btn-anim1 {
            0% {
                left: -100%;
            }

            50%,100% {
                left: 100%;
            }
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </head>
    <body style='background: grey;'>
    <h1 align='center' style='color: white;'>Défi spécial : Inscription </h1>
    <h2 align='center' style='color: white;'> Pensez à noter vos identifiants. Cela pourrait vous être utile.</h2>
    <div class="login-box">
        <form method="POST" action="">
            <div class="user-box">
                <input type="text" name="username" required/>
                <label>Nom d'utilisateur :</label>
            </div>
            <div class="user-box">
                <input type="text" name="password" required/>
                <label>Mot de passe :</label>
            </div>
            <input class='a' type="submit" name="submit" value="S'inscrire" style=' background: linear-gradient(90deg, transparent, red);'/>
        </form>
    </div>

</body>
</html>