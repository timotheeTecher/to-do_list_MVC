<?php 
    $title = "Inscription";
    ob_start();
?>

<div class="sign-container">
    <h2 class="sign-title">Register now</h2>
    <form class="sign-form" action="/inscription" method="POST">
        <input class="sign-input" type="text" placeholder="Nom" name="last_name">
        <input class="sign-input" type="text" placeholder="Prénom" name="first_name">
        <input class="sign-input" type="email" placeholder="Adresse mail" name="email">
        <input class="sign-input" type="password" placeholder="Mot de passe" name="password">
        <input class="sign-submit" type="submit" value="Sign Up">
    </form>
    <p class="sign-link"><a href="/connexion">Vous êtes déjà inscrit ? Connectez-vous</a></p>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');
?>