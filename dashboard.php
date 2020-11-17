<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

if (isLogged()) {
    $user = select($pdo, 'bn_users', '*', 'id', $_SESSION['user']['id']);
} else {
    // TODO: Redirect to error.php
    header('Location: ./error.php');
    die();
}

if (!empty($_POST['logout'])) logout();

$errors = [];

if (!empty($_POST['save'])) {

    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $gender = checkXss($_POST['gender']);
    $birthdate = checkXss($_POST['birthdate']);
    $mail = checkXss($_POST['mail']);

    $errors = checkField($errors, $firstname, 'firstname', 2, 80);
    $errors = checkField($errors, $lastname, 'lastname', 2, 80);
    $errors = checkField($errors, $gender, 'gender', 4, 20);
    $errors = checkField($errors, $birthdate, 'birthdate', 7, 10);
    $errors = checkEmail($errors, $mail, 'mail');
    $errors = checkField($errors, $mail, 'mail', 6, 160);

    if (count($errors) == 0) {
        // TODO: update session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'mail' => $mail,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'birthdate' => $birthdate,
            'gender' => $gender,
            'role'   => $user['role'],
            'ip'     => $_SERVER['REMOTE_ADDR']
        ];
        // TODO: update bdd
        update($pdo, 'bn_users', [
            'mail = "' . $mail . '"',
            'firstname = "' . $firstname . '"',
            'lastname = "' . $lastname . '"',
            'birthdate = "' . $birthdate . '"',
            'gender = "' . $gender . '"',
            'updated_at = "' . now() . '"',
        ], 'id', $user['id']);
        $user = select($pdo, 'bn_users', '*', 'id', $_SESSION['user']['id']);
    }
}

// TODO: Button logout
if (!empty($_POST['logout'])) logout();

$title = 'Tableau de bord - Bookination';
include('src/template/header.php');
?>
<section id="dashboard">
    <div class="wrap-fluid">
        <div class="container">
            <form action="" class="profile-card" method="POST">
                <div class="profile">
                    <div class="profile-container">
                        <div class="profile-avatar">
                            <?php if ($user['gender'] == 'homme') : ?>
                                <img src="assets/img/man.png" alt="Photo ID">
                            <?php else : ?>
                                <img src="assets/img/woman.png" alt="Photo ID">
                            <?php endif; ?>
                        </div>
                        <div class="profile-details">
                            <input type="text" name="firstname" value="<?= $user['firstname'] ?>">
                            <input type="text" name="lastname" value="<?= $user['lastname'] ?>">
                            <p><?= calculateAge($user['birthdate']) ?> ans</p>
                        </div>
                    </div>
                    <div class="profile-container">
                        <div class="profile-item">
                            <h3>Rappels</h3>
                            <p>8</p>
                        </div>
                    </div>
                </div>
                <div class="profile-tags">
                    <div class="profile-container">
                        <div class="profile-item">
                            <h3>Email</h3>
                            <input type="email" name="mail" value="<?= $user['mail'] ?>">
                        </div>
                        <div class="profile-item">
                            <h3>Date de naissance</h3>
                            <input type="date" name="birthdate" value="<?= $user['birthdate'] ?>">
                        </div>
                        <div class="profile-item">
                            <h3>Mot de passe</h3>
                            <a href="./recovery.php?mail=<?= $user['mail'] ?>&token=<?= $user['token'] ?>">Modifier</a>
                        </div>
                    </div>
                    <div class="profile-container">
                        <div class="profile-item">
                            <h3>Genre</h3>
                            <select name="gender" value="<?= $user['gender'] ?>">
                                <option value="femme" <?= ($user['gender'] == 'femme') ? 'selected' : '' ?>>Femme</option>
                                <option value="homme" <?= ($user['gender'] == 'homme') ? 'selected' : '' ?>>Homme</option>
                                <option value="non-binaire" <?= ($user['gender'] == 'non-binaire') ? 'selected' : '' ?>>Non-binaire</option>
                                <option value="non-specifie" <?= ($user['gender'] == 'non-specifie') ? 'selected' : '' ?>>Non-specifié</option>
                            </select>
                        </div>
                        <input type="submit" name="save" class="btn btn-purple" value="Sauvegarder">
                    </div>
                </div>
            </form>
            <div class="reminders-card">
                <table>
                    <tr>
                        <th>Vaccin</th>
                        <th>Description</th>
                        <th>Nécessaire</th>
                        <th>Dernière injection</th>
                        <th>Prochaine injection</th>
                    </tr>
                    <tr>
                        <td>Lorem</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, excepturi!</td>
                        <td>Oui</td>
                        <td>10/10/2010</td>
                        <td>10/10/2010</td>
                    </tr>
                    <tr>
                        <td>Lorem</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, excepturi!</td>
                        <td>Non</td>
                        <td>10/10/2010</td>
                        <td>10/10/2010</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="sidebar">
            <div class="prescription">
                <h3>Ajouter une injection</h3>
                <a class="btn btn-purple" href="#"></a>
            </div>
            <form action="" method="POST">
                <input type="submit" name="logout" class="btn btn-purple logout" value="1"></input>
            </form>
        </div>
    </div>
</section>
<?php include('src/template/footer.php');
