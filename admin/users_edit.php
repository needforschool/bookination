<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');


session_start();

if (!isAdmin()) {
    header('Location: ./../error.php?e=403');
    die();
}

$errors = [];

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $user = select($pdo, 'bn_users', '*', 'id', $_GET['id']);
    if (!empty($user)) {
        if (!empty($_POST['submit'])) {
            $mail = checkXss($_POST['mail']);
            $firstname = checkXss($_POST['firstname']);
            $lastname = checkXss($_POST['lastname']);
            $birthdate = checkXss($_POST['birthdate']);
            $gender = checkXss($_POST['gender']);
            $role = checkXss($_POST['role']);

            $errors = checkEmail($errors, $mail, 'mail');
            $errors = checkField($errors, $mail, 'mail', 6, 160);
            $errors = checkField($errors, $firstname, 'firstname', 2, 80);
            $errors = checkField($errors, $lastname, 'lastname', 2, 80);
            $errors = checkField($errors, $gender, 'gender', 4, 20);
            $errors = checkField($errors, $birthdate, 'birthdate', 7, 10);

            if (count($errors) == 0) {
                update($pdo, 'bn_users', [
                    'mail = "' . $mail . '"',
                    'firstname = "' . $firstname . '"',
                    'lastname = "' . $lastname . '"',
                    'birthdate = "' . $birthdate . '"',
                    'gender = "' . $gender . '"',
                    'role = "' . $role . '"',
                    'updated_at = "' . now() . '"'
                ], 'id', $user['id']);
                header('Location: ./users.php#item-' . $user['id']);
                die();
            }
        }
    } else {
        header('Location: ./../error.php');
        die();
    }
} else {
    header('Location: ./../error.php');
    die();
}
include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Modifier les données de <?= $user['firstname'] . ' ' .  $user['lastname'] ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulaire d'édition</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="card-body" method="POST" action="">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="mail" id="mail" class="form-control" name="mail" value="<?= $user['mail'] ?>">
                            <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <p style="font-weight: 700;">Mot de passe</p>
                            <a href="./../recovery.php?mail=<?= $user['mail'] ?>&token=<?= $user['token'] ?>" target="_blank">Changer le mot de passe</a>
                            <span class="error"><?= (!empty($errors['password'])) ? $errors['password'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" class="form-control" name="firstname" value="<?= $user['firstname'] ?>">
                            <span class="error"><?= (!empty($errors['firstname'])) ? $errors['firstname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" class="form-control" name="lastname" value="<?= $user['lastname'] ?>">
                            <span class="error"><?= (!empty($errors['lastname'])) ? $errors['lastname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date de naissance</label>
                            <input type="date" id="birthdate" class="form-control" name="birthdate" value="<?= $user['birthdate'] ?>">
                            <span class="error"><?= (!empty($errors['birthdate'])) ? $errors['birthdate'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Genre</label>
                            <select class="form-control custom-select" name="gender">
                                <option value="femme" <?= ($user['gender'] == 'femme') ? 'selected' : '' ?>>Femme</option>
                                <option value="homme" <?= ($user['gender'] == 'homme') ? 'selected' : '' ?>>Homme</option>
                                <option value="non-binaire" <?= ($user['gender'] == 'non-binaire') ? 'selected' : '' ?>>Non-binaire</option>
                                <option value="non-specifie" <?= ($user['gender'] == 'non-specifie') ? 'selected' : '' ?>>Non-specifié</option>
                            </select>
                            <span class="error"><?= (!empty($errors['gender'])) ? $errors['gender'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control custom-select" name="role">
                                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>User</option>
                                <span class="error"><?= (!empty($errors['role'])) ? $errors['role'] : '' ?></span>
                            </select>
                        </div>
                        <div class="col-12">
                            <a href="users.php" class="btn btn-secondary">Annuler</a>
                            <input type="submit" value="Modifier" class="btn btn-success float-right" name="submit">
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard3.js"></script>
</body>

</html>