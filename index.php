<?php
require('src/inc/pdo.php');

$title = 'Accueil - Bookination';
include('src/template/header.php');
?>
<section id="home">
    <div class="wrap-fluid">
        <div class="home-featured">
            <h1>Carnet<br>de vaccins</h1>
            <p>
                Bookination est un carnet de vaccins intelligent,<br>
                il vous rappelle la date de vos prochains rendez-vous.
            </p>
            <form action="" method="post">
                <input type="text" placeholder="Votre email">
                <a class="btn btn-instant-login" onclick="this.closest('form').submit();return false;"></a>
            </form>
        </div>
        <div class="home-image">
            <img src="assets/img/doctors.svg" alt="Image de docteurs">
        </div>

    </div>
</section>
<?php include('src/template/footer.php') ?>