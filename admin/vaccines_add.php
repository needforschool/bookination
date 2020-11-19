<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');

session_start();

if (!isAdmin()) {
    header('Location: ./../error.php?e=403');
    die();
}

$errors = [];

if (!empty($_POST['submit'])) {
    if (empty($_POST['mandatory'])) $_POST['mandatory'] = 0;

    $name = checkXss($_POST['name']);
    $frequency = checkXss($_POST['frequency']);
    $mandatory = checkXss($_POST['mandatory']);
    $errors = checkField($errors, $name, 'name', 6, 100);
    $errors = checkField($errors, $frequency, 'frequency', 6, 255);

    if (count($errors) == 0) {
        insert(
            $pdo,
            'bn_vaccines',
            [
                'name',
                'mandatory',
                'frequency',
                'created_at',
                'updated_at'
            ],
            [
                $name,
                $mandatory,
                $frequency,
                now(),
                now()
            ]
        );
        header('Location: ./vaccines.php');
        die();
    }
}

include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ajouter un vaccin</h1>
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
                        <h3 class="card-title">Formulaire d'ajout</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="card-body" method="POST" action="">
                        <div class="form-group">
                            <label for="name">Nom du vaccin</label>
                            <input type="text" name="name" class="form-control" value="<?= (!empty($_POST['name'])) ? $_POST['name'] : '' ?>">
                            <span class="error"><?= (!empty($errors['name'])) ? $errors['name'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="frequency">Fréquence</label>
                            <textarea id="frequency" class="form-control" rows="4" name="frequency"><?= (!empty($_POST['frequency'])) ? $_POST['frequency'] : '' ?></textarea>
                            <span class="error"><?= (!empty($errors['frequency'])) ? $errors['frequency'] : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="mandat">Obligatoire</label>
                            <select class="form-control custom-select" name="mandatory">
                                <option value="1" <?= (!empty($_POST['mandatory']) && $_POST['mandatory'] == 1) ? ' selected' : '' ?>>Oui</option>
                                <option value="0" <?= (isset($_POST['mandatory']) && $_POST['mandatory'] == 0) ? ' selected' : '' ?>>Non</option>
                                <span class="error"><?= (!empty($errors['mandatory'])) ? $errors['mandatory'] : '' ?></span>
                            </select>
                        </div>
                        <div class="col-12">
                            <a href="vaccines_add.php" class="btn btn-secondary">Annuler</a>
                            <input type="submit" value="Ajouter" class="btn btn-success float-right" name="submit">
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