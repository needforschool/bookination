<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');


$title = 'Se connecter - Bookination';
include('src/template/header.php'); ?>

<section id="login">
    <div class="wrap-fluid">
        <div class="login-form" id="login-form">
            <form action="" method="POST">
                <input type="email" name="mail" placeholder="Votre email"></input>
                <span class="error"></span>
                <input type="password" name="password" placeholder="Votre mot de passe"></input>
                <span class="error"></span>
                <input type="submit" name="submit" class="btn btn-purple" value="Se connecter">
                <a href="./forgot_password.php" class="forgot-password">Mot de passe oublié</a>
                <a href="./register.php" class="btn btn-purple">S'inscrire</a>
            </form>
        </div>
        <div class="login-image">
            <img src="assets/img/login.svg" alt="Image login">
        </div>
</section>
<?php include('src/template/footer.php');