<!------------------------ register.php ------------------------>

<!------------ php ------------>

<?php
// Démarrer une nouvelle session
session_start();

// Informations de connexion à la base de données MySQL
$host = "localhost";
$user = "root"; // a remplacer par son nom d'utilisateur MySQL
$pass = "root"; // a remplacer par son mot de passe MySQL
$dbname = "auth_db";
$encoding = PASSWORD_ARGON2I;

// Connexion à la base de donnée
$conn = new mysqli($host, $user, $pass, $dbname);

// Bouton de retour à la page d'accueil
echo "<a href='index.php'>Retour à la page d'accueil</a><br><br>";

// Si la connexion a échoué, afficher un message d'erreur
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Verifier si le formulaire a été envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], $encoding);
    
    // Requête SQL pour insérer un nouvel utilisateur dans la base de données
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        // Si l'insertion est réussie, rediriger vers la page de connexion avec un message de succès
        header("Location: login.php?success=1");
        exit();
    } else {
        // Sinon, afficher un message d'erreur
        echo "Erreur lors de la création du compte.";
    }
}
?>


<!------------ html ------------>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un compte</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Créer un compte</h2>
    <form method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required><br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Créer un compte</button>
    </form>
</body>
</html>