<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');
$title = 'Changement de mot de passe- Bookination';
include('src/template/header.php');
?>



<section id="recovery_password">
    <div class="wrap-fluid">
        <div class="recovery-form" id="recovery-form">
            <form action="" method="POST">
            <input type="password" name="password" placeholder="Nouveau mot de passe"></input>
            <span class="error"></span>
            <input type="password" name="password2" placeholder="Confirmation du nouveau mot de passe"></input>
            <span class="error"></span>
                <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
            </form>
        </div>
        <div class="recovery-image">
            <img src="assets\img\undraw_secure_login_pdn4.svg" alt="Image recovery">
        </div>
</section>