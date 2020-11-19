<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');


session_start();

if (!isAdmin()) {
    header('Location: ./../error.php?e=403');
    die();
}

if (!empty($_POST['users'])) { //à vérifier

    $mail = checkXss($_POST['mail']);
    $password = checkXss($_POST['password']);
    $token = checkXss($_POST['token']);
    $firstname = checkXss($_POST['firstname']);
    $lastname = checkXss($_POST['lastname']);
    $birthdate = checkXss($_POST['birthdate']);
    $gender = checkXss($_POST['gender']);
    $role = checkXss($_POST['role']);

    $mail = checkEmail($errors, $mail, 'mail', 6, 160);
    $password = checkField($errors, $password, 'password', 6, 250);
    $token = checkField($errors, $token, 'token', 4, 255);
    $firstname = checkField($errors, $firstname, 'firstname', 7, 100);
    $lastname = checkField($errors, $firstname, 'firstname', 7, 100);
    $birthdate = checkField($errors, $birthdate, 'birthdate', 7, 10);
    $gender = checkField($errors, $gender, 'gender', 4, 20);
    $role = checkField($errors, $role, 'role', 6, 10); //à vérifier


}
include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Modifier les données d'un utilisateur</h1>
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
                    <div class="card-body">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="mail" id="mail" class="form-control">
                            <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="text" id="password" class="form-control">
                            <span class="error"><?= (!empty($errors['password'])) ? $errors['password'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="token">Token</label>
                            <input type="text" id="inputName" class="form-control">
                            <span class="error"><?= (!empty($errors['token'])) ? $errors['token'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" class="form-control">
                            <span class="error"><?= (!empty($errors['firstname'])) ? $errors['firstname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" class="form-control">
                            <span class="error"><?= (!empty($errors['lastname'])) ? $errors['lastname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date de naissance</label>
                            <input type="datetime" id="birthdate" class="form-control">
                            <span class="error"><?= (!empty($errors['birthdate'])) ? $errors['birthdate'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Genre</label>
                            <input type="text" id="gender" class="form-control">
                            <span class="error"><?= (!empty($errors['gender'])) ? $errors['gender'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control custom-select" name="role">
                                <option selected disabled>--Choisissez une option --</option>
                                <option>Admin</option>
                                <option>Users</option>
                                <span class="error"><?= (!empty($errors['role'])) ? $errors['role'] : '' ?></span>
                            </select>
                        </div>
                        <div class="col-12">
                            <a href="users.php" class="btn btn-secondary">Annuler</a>
                            <input type="submit" value="Modifier" class="btn btn-success float-right">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>