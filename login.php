<!------------------------ login.php ------------------------>

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
    $password = $_POST["password"];
    
    // Requête SQL pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Si l'utilisateur existe, le rediriger vers la page d'accueil
    if ($result->num_rows == 0) {
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Sinon, afficher un message d'erreur
        echo "Identifiants incorrects.";
    }
}
?>


<!------------ html ------------>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php
    // Afficher un message de succès si l'utilisateur vient de créer un compte
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p style='color: green;'>Compte créé avec succès.</p>";
    }
    ?>
    <form method="POST">
        <label>Nom d'utilisateur:</label>
        <input type="text" name="username" required><br>
        <label>Mot de passe:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
</body>
</html>