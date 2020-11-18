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
                    <h1 class="m-0 text-dark">Modifier les informations d'un vaccin</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Vaccins</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nom du vaccin</label>
                                <input type="text" name="name" class="form-control" value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>">
                                <span class="error"><?= (!empty($errors['name'])) ? $errors['name'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="frequency">Description du vaccin</label>
                                <textarea id="frequency" class="form-control" rows="4"></textarea>
                                <span class="error"><?= (!empty($errors['frequency'])) ? $errors['frequency'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="mandat">Mendatory</label>
                                <select class="form-control custom-select" name="mandat">
                                    <option value="">-- choisir le type de vaccin --</option>
                                    <option value="vert">Obligatoire</option>
                                    <option value="jaune">Non-obligatoire</option>
                                    <span class="error"><?= (!empty($errors['mandat'])) ? $errors['mandat'] : '' ?></span>
                                </select>
                            </div>
                            <div class="col-12">
                                <a href="vaccines.php" class="btn btn-secondary">Annuler</a>
                                <input type="submit" value="Modifier" class="btn btn-success float-right">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>