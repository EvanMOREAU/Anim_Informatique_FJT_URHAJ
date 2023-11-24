<?php
    // code source de connexion.php
    $host = "localhost";
    $user_mysql = "root";    // nom de l'utilisateur MySQL 
    $password_mysql = "root";    // mot de passe de l'utilisateur MySQL
    $database = "evan_injections_sql";

    $db = mysqli_connect($host, $user_mysql, $password_mysql, $database);

    if(!$db)
    {
        echo "Echec de la connexion\n";
        exit();
    }

    mysqli_set_charset($db, "utf8");
?>
<!DOCTYPE>
<html>
    <head>
        <title></title>
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
        <h1 align='center' style='color: white;'>Défi spécial : Injection SQL </h1>

        <?php
        if(!empty($_GET['username']) && !empty($_GET['password']))
        {
            $username = $_GET['username'];
            $password = $_GET['password'];

            $query = "SELECT id, username FROM users WHERE username = '".$username."' AND password = '".$password."'";
            $rs = mysqli_query($db, $query);

            if(mysqli_num_rows($rs) == 1)
            {
                $user = mysqli_fetch_assoc($rs);

                echo '<div class="alert alert-success" role="alert" align="center"> Félicitation, vous venez de réussir l\'injection SQL. Vous êtes actuellement connecté avec l\'utilisateur "'.htmlspecialchars($user['username']).'" </div>';
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert" align="center"> Mauvais nom d\'utilisateur et/ou mot de passe ! </div>';
            }

            mysqli_free_result($rs);
            mysqli_close($db);
        }
        ?>
 
        <div class="login-box">
            <form action="index.php" method="GET">
                <div class="user-box">
                    <input type="text" name="username"/>
                    <label>Nom d'utilisateur :</label>
                </div>
                <div class="user-box">
                    <input type="text" name="password" />
                    <label>Mot de passe :</label>
                </div>
                <input class='a' type="submit" value="Connexion" style=' background: linear-gradient(90deg, transparent, red);'/>
            </form>
        </div>
    </body>
</html>