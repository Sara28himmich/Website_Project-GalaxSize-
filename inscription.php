<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=Galaxsize;charset=utf8', 'root', 'julesVERNE2!');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['inscription'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($username) || !empty($email) || !empty($password)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $return = "L'adresse email n'est pas valide.";
        } else {
            $checkMail = $bdd->query('SELECT id FROM users WHERE email = "' . $email . '"');
            if ($checkMail->rowCount() > 0) {
                $return = "L'adresse email est déjà utilisée.";
            } else {
                $checkUsername = $bdd->query('SELECT id FROM users WHERE username = "' . $username . '"');
                if ($checkUsername->rowCount() > 0) {
                    $return = "Le nom d'utilisateur est déjà utilisé.";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $bdd->query('INSERT INTO users (username, email, password) VALUES ("' . $username . '", "' . $email . '", "' . $password . '")');
                    $return = "Inscription réussie.";
                }
            
            }
        }
    } else {
        $return = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <?php include 'star.php'; ?>
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
<div class="form-container">
    <h1>Bienvenue</h1>
    <div class="inscription-form">
        <?php if (!empty($return)): ?>
            <div class="message"><?php echo $return; ?></div>
        <?php endif; ?>
<form class="inscription-form" action="inscription.php" method="post">
        <label for="password">Email:</label>
        <input type="text" id="mail" name="email">

        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username">

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password">

        <P>Déja un compte? <a href="connexion.php">Connecte-toi</a></P>
        <input type="submit" name="inscription" value="S'incrire">
    </form>
</body>
</html>