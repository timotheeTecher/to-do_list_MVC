<?php 
    $title = "Connexion";
    ob_start();
?>

<div class="sign-container signIn-container">
    <h2 class="sign-title">Log in</h2>
    <form class="sign-form" action="/connexion" method="POST">
        <input class="sign-input" type="email" placeholder="Adresse mail" name="email">
        <input class="sign-input" type="password" placeholder="Mot de passe" name="password">
        <input class="sign-submit" type="submit" value="Sign In">
    </form>
    <p class="sign-link"><a href="/inscription">Vous n'avez de compte ? Inscrivez-vous</a></p>
</div>

<?php
    $content = ob_get_clean();
    require('template.php');
?>