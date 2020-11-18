<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

if (isLogged()) {
    header('Location: ./dashboard.php');
    die();
}

$errors = [];

if (!empty($_POST['submit'])) {

    $mail = checkXss($_POST['mail']);
    $password = checkXss($_POST['password']);

    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);
    $errors = checkField($errors, $password, 'password', 6, 200);

    $user = select($pdo, 'bn_users', '*', 'mail', $mail);

    if (count($errors) == 0) {
        if (!empty($user)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'     => $user['id'],
                    'mail' => $user['mail'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'birthdate' => $user['birthdate'],
                    'gender' => $user['gender'],
                    'role'   => $user['role'],
                    'ip'     => $_SERVER['REMOTE_ADDR']
                ];
                header('Location: ./dashboard.php');
                die();
            } else {
                $errors['password'] = 'Mot de passe incorrect';
            }
        } else {
            $_SESSION['visitor'] = [
                'mail' => $mail
            ];
            header('Location: ./register.php');
            die();
        }
    }
}


$title = 'Se connecter - Bookination';
include('src/template/header.php'); ?>

<section id="login">
    <div class="wrap-fluid">
        <div class="login-form" id="login-form">
            <form action="" method="POST">
                <input type="email" name="mail" placeholder="Votre email" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail'];
                                                                                    elseif (!empty($_SESSION['visitor']['mail'])) echo $_SESSION['visitor']['mail']; ?>">
                <input type="password" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
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
