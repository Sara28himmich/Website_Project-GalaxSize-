<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=Galaxsize;charset=utf8', 'root', 'julesVERNE2!');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['connexion'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (!empty($username) && !empty($password)) {
        $stmt = $bdd->prepare('SELECT id, password FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $username;
                $return = "Connexion réussie.";
            } else {
                $return = "Le mot de passe est incorrect.";
            }
        } else {
            $return = "Le nom d'utilisateur n'existe pas.";
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
    <title>Connexion</title>
    <?php include 'star.php'; ?>
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
<div class="form-container">
    <h1>Bon retour!</h1>
    <?php if (isset($return)): ?>
        <p><?php echo $return; ?></p>
    <?php endif; ?>
    <div class="connexion-form">
        <form class="connexion-form" action="connexion.php" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username">

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">

            <p>Mot de passe oublié ?<a href="reset_password.php"> Cliquez ici</a></p>
            <p>Nouveau sur le site ? <a href="inscription.php">Inscrit-toi</a></p>
            <input type="submit" name="connexion" value="Connexion">
        </form>
    </div>
</div>
</body>
</html>

