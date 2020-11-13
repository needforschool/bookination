<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

$errors = [];

// TODO: rediriger vers la page dashboard si l'utilisateur est connecté
if (!empty($_POST['mail'])) {
    $mail = checkXss($_POST['mail']);

    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);

    $checkUsedEmail = select($pdo, 'bn_users', 'mail', 'mail', $mail);

    session_start();
    $_SESSION['visitor'] = [
        'mail' => $mail
    ];

    if (empty($checkUsedEmail)) {
        header('Location: ./register.php');
    } else {
        header('Location: ./login.php');
    }
    die();
}

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
                <input type="email" name="mail" placeholder="Votre email">
                <a class="btn btn-instant-login" onclick="this.closest('form').submit();return false;"></a>
            </form>
        </div>
        <div class="home-image">
            <img src="assets/img/doctors.svg" alt="Image de docteurs">
        </div>

    </div>
</section>
<?php include('src/template/footer.php') ?>