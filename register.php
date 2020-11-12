<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

$errors = [];

session_start();

if (!empty($_POST['submit'])) {
    if (empty($_POST['gender'])) $_POST['gender'] = 'non-specifie';

    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $gender = checkXss($_POST['gender']);
    $birthdate = checkXss($_POST['birthdate']);
    $mail = checkXss($_POST['mail']);
    $password = checkXss($_POST['password']);
    $passwordConfirm = checkXss($_POST['password-confirm']);

    $errors = checkField($errors, $firstname, 'firstname', 2, 80);
    $errors = checkField($errors, $lastname, 'lastname', 2, 80);
    $errors = checkField($errors, $gender, 'gender', 4, 20);
    $errors = checkField($errors, $birthdate, 'birthdate', 7, 10);
    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);
    $errors = checkField($errors, $password, 'password', 6, 200);
    $errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 200);

    if ($password != $passwordConfirm) $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';

    if (count($errors) == 0) {
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $token = generateRandomString(200);

        $checkUsedToken = select($pdo, 'bn_users', 'token', 'token', $token);
        if ($token == $checkUsedToken) {
            while ($token == $checkUsedToken) {
                $token = generateRandomString(200);
            }
        }

        $checkUsedEmail = select($pdo, 'bn_users', 'mail', 'mail', $mail);
        if (empty($checkUsedEmail)) {
            insert(
                $pdo,
                'bn_users',
                [
                    'mail',
                    'password',
                    'token',
                    'firstname',
                    'lastname',
                    'birthdate',
                    'gender',
                    'created_at',
                    'updated_at',
                    'role'
                ],
                [
                    $mail,
                    $passwordHashed,
                    $token,
                    $firstname,
                    $lastname,
                    $birthdate,
                    $gender,
                    now(),
                    now(),
                    'user'
                ]
            );
            $user = select($pdo, 'bn_users', '*', 'mail', $mail);
            if (!empty($user)) {
                $_SESSION['user'] = [
                    'id'     => $user['id'],
                    'mail' => $user['mail'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'role'   => $user['role'],
                    'ip'     => $_SERVER['REMOTE_ADDR']
                ];
            }
            header('Location: ./dashboard.php');
        } else {
            header('Location: ./login.php');
            // TODO: Auto Login
        }
        die();
    }
}

$title = 'Inscription - Bookination';
include('src/template/header.php');
?>

<section id="register">

    <div class="wrap-fluid">
        <div class="register-form" id="register-form">
            <form action="" method="POST">

                <div class="inputs-container">
                    <input type="text" name="lastname" placeholder="Votre nom" value="<?= (!empty($_POST['lastname'])) ? $_POST['lastname'] : '' ?>">
                    <span class="error"><?= (!empty($errors['lastname'])) ? $errors['lastname'] : '' ?></span>
                    <input type="text" name="firstname" placeholder="Votre prénom" value="<?= (!empty($_POST['firstname'])) ? $_POST['firstname'] : '' ?>">
                    <span class="error"><?= (!empty($errors['firstname'])) ? $errors['firstname'] : '' ?></span>
                </div>
                <div class="inputs-container">
                    <select name="gender" value="<?= (!empty($_POST['gender'])) ? $_POST['gender'] : '' ?>">
                        <option value="" disabled <?= (!empty($_POST['gender'])) ? '' : 'selected' ?> hidden>Votre genre</option>
                        <option value="femme" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'femme') ? 'selected' : '' ?>>Femme</option>
                        <option value="homme" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'homme') ? 'selected' : '' ?>>Homme</option>
                        <option value="non-binaire" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'non-binaire') ? 'selected' : '' ?>>Non-binaire</option>
                        <option value="non-specifie" <?= (!empty($_POST['gender']) && $_POST['gender'] == 'non-specifie') ? 'selected' : '' ?>>Non-specifié</option>
                    </select>
                    <input type="date" name="birthdate" value="<?= (!empty($_POST['birthdate'])) ? $_POST['birthdate'] : '' ?>">
                    <span class="error"><?= (!empty($errors['birthdate'])) ? $errors['birthdate'] : '' ?></span>
                </div>
                <input type="email" name="mail" placeholder="Votre email" value="<?php
                                                                                    if (!empty($_POST['mail'])) {
                                                                                        echo $_POST['mail'];
                                                                                    } elseif (!empty($_SESSION['mail'])) {
                                                                                        echo $_SESSION['mail'];
                                                                                    }
                                                                                    ?>">
                <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                <div class="inputs-container">
                    <input type="password" name="password" placeholder="Votre mot de passe" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>">
                    <span class="error"><?= (!empty($errors['password'])) ? $errors['password'] : '' ?></span>
                    <input type="password" name="password-confirm" placeholder="Confirmation du mot de passe" value="<?= (!empty($_POST['password-confirm'])) ? $_POST['password-confirm'] : '' ?>">
                    <span class="error"><?= (!empty($errors['password-confirm'])) ? $errors['password-confirm'] : '' ?></span>
                </div>
                <input type="submit" name="submit" class="btn btn-purple" value="S'inscrire">
            </form>
        </div>
        <div class="register-image">
            <img src="assets/img/undraw_sign_in_e6hj.svg" alt="Image inscription">
        </div>
</section>

<?php include('src/template/footer.php') ?>