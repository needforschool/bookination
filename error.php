<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

$error = '404';
$title = 'Erreur '.$error.' - Bookination';


include('src/template/header.php');
?>

<section id="error">
    <div class="wrap-fluid">
        <div class="error-text">
            <h1>Erreur 403</h1>
            <p>Accès interdit !</p>
        </div>
        <div class="error-image">
            <img src="assets/img/errors.gif" alt="erreur">
        </div>
    </div>
</section>


<?php include('src/template/footer.php');
