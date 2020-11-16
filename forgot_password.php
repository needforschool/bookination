<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');
$title = 'Récupération de mot de passe- Bookination';
include('src/template/header.php');
?>
<section id="forgot_password">
    <div class="wrap-fluid">
        <div class="forgot-form" id="forgot-form">
            <form action="forgot_password_recovery.php" method="POST">
                <input type="email" name="mail" placeholder="Votre email" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                    ?>">
                <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                <input type="submit" name="submit" class="btn btn-purple" value="Se connecter">
            </form>
        </div>
        <div class="forgot-image">
            <img src="assets\img\undraw_forgot_password_gi2d.svg" alt="Image forgot">
        </div>
</section>


