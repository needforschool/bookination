<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

require('vendor/autoload.php');
require('src/inc/pdo.php');
require('src/inc/functions.php');

$dotenv = new Dotenv();
$dotenv->load('.env');

session_start();

$errors = [];
$sent = false;

if (!empty($_POST['submit'])) {
    $mail  = checkXss($_POST['mail']);

    $errors = checkEmail($errors, $mail, 'mail');
    $user = select($pdo, 'bn_users', '*', 'mail', $mail);
    if (empty($user)) $errors['mail'] = 'Email introuvable';
    else {
        if (count($errors) == 0) {
            $currentLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $recoveryLink = str_replace(basename(__FILE__), 'recovery.php', $currentLink);

            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            try {
                $mail->isSMTP();
                $mail->Host       = $_ENV['SMTP_HOST'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['SMTP_USERNAME'];
                $mail->Password   = $_ENV['SMTP_PASSWORD'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $_ENV['SMTP_PORT'];

                $mail->setFrom('contact@onruntime.com', 'Rescue - Bookination');
                $mail->addAddress($user['mail'], $user['firstname'] . ' ' . $user['lastname']);

                $mail->isHTML(true);
                $mail->Subject = 'Récupération de mot de passe';
                $mail->Body    = '<div style="text-align: center;"><h3>Récupération de mot de passe</h3><a href="' . $recoveryLink . '?mail=' . $user["mail"] . '&token=' . $user["token"] . '" style="color: #ff6b6b; text-decoration: none">Cliquez ici pour changez votre mot de passe</a></div>';
                $mail->AltBody = 'Cliquez sur le lien pour récupérer votre mot de passe: ' . $recoveryLink . '?mail=' . $user["mail"] . '&token=' . $user["token"];

                $mail->send();
                $sent = true;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}

$title = 'Récupération de mot de passe - Bookination';
include('src/template/header.php');
?>

<section id="forgot_password">
    <div class="wrap-fluid">
        <div class="forgot-form" id="forgot-form">
            <form action="" method="POST">
                <input type="email" name="mail" placeholder="Votre email" value="<?php if (!empty($_POST['mail'])) $_POST['mail'];
                                                                                    elseif (!empty($_SESSION['user']['mail'])) echo $_SESSION['user']['mail'];
                                                                                    elseif (!empty($_SESSION['visitor']['mail'])) echo $_SESSION['visitor']['mail']; ?>">
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
