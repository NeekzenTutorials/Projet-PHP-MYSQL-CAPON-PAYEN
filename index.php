<!------------------------ index.php ------------------------>

<!------------ php ------------>

<?php
// Démarrer une nouvelle session
session_start();

// Informations de connexion à la base de données MySQL
$host = "localhost:3360";
$user = "root"; // a remplacer par son nom d'utilisateur MySQL
$pass = "root"; // a remplacer par son mot de passe MySQL
$dbname = "auth_db";

// Connexion à la base de donnée
$conn = new mysqli($host, $user, $pass, $dbname);

// Si la connexion a échoué, afficher un message d'erreur
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Afficher un message indiquant que l'utilisateur est connecté et fournir afficher le bouton de déconnexion
    echo "Connecté en tant que " . $_SESSION['username'] . " | <a href='logout.php'>Déconnexion</a>";
} else {
    // Sinon, afficher un message indiquant que l'utilisateur n'est pas connecté et afficher le bouton de connexion
    echo "Non connecté. <a href='login.php'>Se connecter</a>";
}
?>


<!------------ html ------------>

<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Page d'accueil</h2>
</body>
</html>