<?php

$title = 'Inscription - Bookination';
include('src/template/header.php');


?>

<section id="register">

    <div class="wrap-fluid">
        <div class="register-form" id="register-form">
            <form action="" method="POST">

                <div class="inputs-container">
                    <input type="text" name="lastname" placeholder="Votre nom"></input>
                    <span class="error"></span>
                    <input type="text" name="firstname" placeholder="Votre prénom"></input>
                    <span class="error"></span>
                </div>
                <div class="inputs-container">
                    <select id="gender" name="gender" form="register-form">
                        <option value="" disabled selected hidden>Votre genre</option>
                        <option value="homme">Femme</option>
                        <option value="femme">Homme</option>
                        <option value="non-binaire">Non-binaire</option>
                        <option value="non-specifie">Non-specifié</option>
                    </select>
                    <input type="date" name="date">
                    <span class="error"></span>
                </div>
                <input type="email" name="mail" placeholder="Votre email"></input>
                <span class="error"></span>
                <div class="inputs-container">
                    <input type="password" name="password" placeholder="Votre mot de passe"></input>
                    <span class="error"></span>
                    <input type="password" name="password-confirm" placeholder="Confirmation de votre mot de passe"></input>
                    <span class="error"></span>
                </div>
                <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
            </form>
        </div>
        <div class="register-image">
            <img src="assets/img/undraw_sign_in_e6hj.svg" alt="Image inscription">
        </div>
</section>

<?php include('src/template/footer.php') ?>