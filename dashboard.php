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

if (!empty($_POST['add'])) {
    if (empty($_POST['vaccine'])) $_POST['vaccine'] = 1;

    $vaccine = checkXss($_POST['vaccine']);
    $lastInjection = checkXss($_POST['last_injection']);
    $nextInjection = checkXss($_POST['next_injection']);

    $errors = checkField($errors, $lastInjection, 'last_injection', 7, 10);
    $errors = checkField($errors, $nextInjection, 'next_injection', 7, 10);

    if (count($errors) == 0) {
        insert(
            $pdo,
            'bn_reminders',
            [
                'user_id',
                'vaccine_id',
                'last_injection',
                'reminder',
                'created_at',
                'updated_at'
            ],
            [
                $user['id'],
                $vaccine,
                $lastInjection,
                $nextInjection,
                now(),
                now()
            ]
        );
    }
}

if (!empty($_GET['delete']) && is_numeric($_GET['delete']) && select($pdo, 'bn_reminders', '*', 'id', $_GET['delete'])) delete($pdo, 'bn_reminders', 'id', $_GET['delete']);

$vaccines = selectAll($pdo, 'bn_vaccines');

$reminders = selectAll($pdo, 'bn_reminders', '*', 'user_id', $user['id'], 'last_injection', 'DESC');

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
                            <select name="gender">
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
                        <th>Fréquence</th>
                        <th style="padding: 0 15px">Obligatoire</th>
                        <th style="padding: 0 15px">Dernière injection</th>
                        <th>Prochaine injection</th>
                    </tr>
                    <?php foreach ($reminders as $r) : ?>
                        <tr>
                            <td><?= $vaccines[$r['vaccine_id']]['name'] ?></td>
                            <td><?= $vaccines[$r['vaccine_id']]['frequency'] ?></td>
                            <td><?= ($vaccines[$r['vaccine_id']]['mandatory']) ? 'Oui' : 'Non' ?></td>
                            <td><?= date("d/m/Y", strtotime($r['last_injection'])) ?></td>
                            <td><?= date("d/m/Y", strtotime($r['reminder'])) ?></td>
                            <td><a href="?delete=<?= $r['id'] ?>">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="sidebar">
            <?php if (empty($_POST['new'])) : ?>
                <div class="prescription">
                    <h3>Ajouter une injection</h3>
                    <form action="" method="POST">
                        <input type="submit" name="new" class="btn btn-purple" value="1"></input>
                    </form>
                </div>
            <?php else : ?>
                <form action="" method="POST" class="add">

                    <label for="vaccine">Vaccin</label>
                    <select name="vaccine">
                        <option value="" disabled selected hidden>Types de vaccins</option>
                        <?php foreach ($vaccines as $v) : ?>
                            <option value="<?= $v['id'] ?>" style="color: #000"><?= $v['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="last_injection">Dernière injection</label>
                    <input name="last_injection" type="date" value="<?= nowDate() ?>">

                    <label for="next_injection">Prochaine injection</label>
                    <input name="next_injection" type="date" value="<?= nowDate() ?>">

                    <input type="submit" name="add" class="btn btn-purple" value="1"></input>
                </form>
            <?php endif; ?>
            <form action="" method="POST" class="logout">
                <input type="submit" name="logout" class="btn btn-purple" value="1"></input>
            </form>
        </div>
    </div>
</section>
<?php include('src/template/footer.php');
