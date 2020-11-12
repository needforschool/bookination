<?php

$title = 'Contact - Bookination';
include('src/template/header.php');
?>
<section id="contact">
    <div class="wrap-fluid">
        <div class="contact-form">
            <form action="" method="POST">

                <div class="inputs-container">
                    <!-- mail -->
                    <input type="email" name="mail" placeholder="Votre email"></input>
                    <span class="error"></span>
                    <!-- prénom -->
                    <input type="text" name="firstname" placeholder="Votre prénom"></input>
                    <span class="error"></span>
                </div>
                <div class="inputs-container">
                    <!-- nom -->
                    <input type="text" name="lastname" placeholder="Votre nom"></input>
                    <span class="error"></span>
                    <!-- sujet -->
                    <input type="text" name="sujbect" placeholder="Votre motif">
                    <span class="error"></span>
                </div>
                <!-- message -->
                <textarea name="message" placeholder="Votre message"></textarea>
                <span class="error"></span>
                <!-- submit -->
                <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
            </form>
        </div>
        <div class="contact-image">
            <img src="assets/img/contact_us.svg" alt="Image de contact">
        </div>
    </div>
</section>

<?php include('src/template/footer.php') ?>