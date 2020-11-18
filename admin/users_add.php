<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');



include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ajouter un utilisateur</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulaire d'ajout</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="mail" id="mail" class="form-control" value="<?php if (!empty($_POST['mail'])) echo $_POST['mail']; ?>">
                            <span class="error"><?= (!empty($errors['mail'])) ? $errors['mail'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="text" id="password" class="form-control" value="<?php if (!empty($_POST['password'])) echo $_POST['password']; ?>">
                            <span class="error"><?= (!empty($errors['password'])) ? $errors['password'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="token">Token</label>
                            <input type="text" id="token" class="form-control" value="<?php if (!empty($_POST['token'])) echo $_POST['token']; ?>">
                            <span class="error"><?= (!empty($errors['token'])) ? $errors['token'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Prénom</label>
                            <input type="text" id="firstname" class="form-control" value="<?php if (!empty($_POST['firstname'])) echo $_POST['firstname']; ?>">
                            <span class="error"><?= (!empty($errors['firstname'])) ? $errors['firstname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" id="lastname" class="form-control" value="<?php if (!empty($_POST['lastname'])) echo $_POST['lastname']; ?>">
                            <span class="error"><?= (!empty($errors['lastname'])) ? $errors['lastname'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date de naissance</label>
                            <input type="datetime" id="birthdate" class="form-control" value="<?php if (!empty($_POST['birthdate'])) echo $_POST['birthdate']; ?>">
                            <span class="error"><?= (!empty($errors['birthdate'])) ? $errors['birthdate'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Genre</label>
                            <input type="text" id="gender" class="form-control" value="<?php if (!empty($_POST['gender'])) echo $_POST['gender']; ?>">
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
                                <a href="users_add.php" class="btn btn-secondary">Annuler</a>
                                <input type="submit" value="Ajouter" class="btn btn-success float-right">
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>