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
    <h1>Lorem Ipsum</h1>
    <div class="inscription-form">
<form class="inscription-form" action="traitement-inscription.php" method="post">
        <label for="password">Email:</label>
        <input type="text" id="mail" name="email">

        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username">

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>