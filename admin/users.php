<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');

session_start();

if (!isAdmin()) {
    header('Location: ./../error.php?e=403');
    die();
}

$users=selectAll($pdo, 'bn_users');

if (!empty($_GET['delete']) && is_numeric($_GET['delete']) && select($pdo, 'bn_users', '*', 'id', $_GET['delete'])) delete($pdo, 'bn_users', 'id', $_GET['delete']);

include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Utilisateurs</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
     <!-- Main content -->
     <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Liste complete</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 2%">
                    #
                </th>
                <th style="width: 15%">
                    e-mail
                </th>
                <th style="width: 10%">
                    Firstname
                </th>
                <th style="width: 10%">
                    Lastname
                </th>
                <th style="width: 10%">
                     Date de naissance
                </th>
                <th style="width: 10%">
                    Genre
                </th>
                <th style="width: 10%">
                    Date de création
                </th>
                <th style="width: 10%">
                    Date de màj
                </th>
                <th style="width: 8%" class="text-center">
                    Rôle
                </th>
                <th style="width: 15%">

                </th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user):?>
            <tr>
                <td>
                    <?= $user['id'] ?>
                </td>
                <td>
                    <?= $user['mail'] ?>
                </td>
                <td>
                    <?= $user['firstname'] ?>
                </td>
                <td>
                    <?= $user['lastname'] ?>  
                </td>
                <td>
                    <?= $user['birthdate'] ?>
                </td>
                <td>
                    <?= $user['gender'] ?>
                </td>
                <td>
                    <?= $user['created_at'] ?>
                </td>
                <td>
                    <?= $user['updated_at'] ?>
                </td>
                <td class="project-state">
                    <?= $user['role'] ?>
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-info btn-sm" href="users_edit.php">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Editer
                    </a>
                    <a class="btn btn-danger btn-sm" href="?delete=<?= $user['id'] ?>">
                        <i class="fas fa-trash">
                        </i>
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

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