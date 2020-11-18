<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

if (!empty($_POST['submit'])) {

    $password = checkXss($_POST['password']);
    $passwordConfirm = checkXss($_POST['password-confirm']);
    die('ok');
    $errors = [];
    //vérifier longeur des mots de passes
    $errors = checkField($errors, $password, 'password', 6, 100);
    $errors = checkField($errors, $passwordConfirm, 'password', 6, 100);
    if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';
    debug($errors[]);
    //verification $errors
    //if (count($errors) == 0) {envoi de formulaire?}

    // $user = select($pdo, 'bn_users', '*', 'mail', $mail); faire la même avec les password?

    //copié, à comprendre
//     if (count($errors) == 0) {
//         if (!empty($user)) {
//             if (password_verify($password, $user['password'])) {
//                 $_SESSION['user'] = [
//                     'id'     => $user['id'],
//                     'mail' => $user['mail'],
//                     'firstname' => $user['firstname'],
//                     'lastname' => $user['lastname'],
//                     'birthdate' => $user['birthdate'],
//                     'gender' => $user['gender'],
//                     'role'   => $user['role'],
//                     'ip'     => $_SERVER['REMOTE_ADDR']
//                 ];
//                 header('Location: ./dashboard.php');
//                 die();
//             } else {
//                 $errors['password'] = 'Mot de passe incorrect';
//             }
//         } else {
//             $_SESSION['visitor'] = [
//                 'mail' => $mail
//             ];
//             header('Location: ./register.php');
//             die();
//         }
//     }
// }










$title = 'Changement de mot de passe- Bookination';
include('src/template/header.php');
?>



<section id="recovery_password">
    <div class="wrap-fluid">
        <div class="recovery-form" id="recovery-form">
            <form action="" method="POST">
            <input type="password" name="password" placeholder="Nouveau mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                <span class="error"></span>
                <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" value="<?= (!empty($_POST['password-confirm'])) ? $_POST['password-confirm'] : '' ?>">
                <span class="error"></span>
                <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
            </form>
        </div>
        <div class="recovery-image">
            <img src="assets\img\undraw_secure_login_pdn4.svg" alt="Image recovery">
        </div>
</section>