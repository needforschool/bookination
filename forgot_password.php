<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

$errors = [];
$sent = false;

if (!empty($_POST['submit'])) {
    $mail  = checkXss($_POST['mail']);

    $errors = checkEmail($errors, $mail, 'mail');
    $checkUsedEmail = select($pdo, 'bn_users', 'mail', 'mail', $mail);
    if (empty($checkUsedEmail)) $errors['mail'] = 'Email introuvable';
    else {
        if (count($errors) == 0) {
            //TODO: Envoie du mail
            $sent = true;
        }
    }
}

$title = 'Récupération de mot de passe- Bookination';
include('src/template/header.php');
?>

<section id="forgot_password">
    <div class="wrap-fluid">
        <div class="forgot-form" id="forgot-form">
            <form action="" method="POST">
                <input type="email" name="mail" placeholder="Votre email" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                    ?>">
                <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                <?php if ($sent == false) : ?>
                    <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
                <?php else : ?>
                    <input type="submit" class="btn btn-success" value="Bien reçu !" disabled>
                <?php endif; ?>
            </form>
        </div>
        <div class="forgot-image">
            <img src="assets\img\undraw_forgot_password_gi2d.svg" alt="Image forgot">
        </div>
</section>

<?php include('src/template/footer.php');
