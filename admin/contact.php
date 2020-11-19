<?php
require('../src/inc/pdo.php');
require('../src/inc/functions.php');

session_start();

if (!isAdmin()) {
    header('Location: ./../error.php?e=403');
    die();
}

if (!empty($_GET['delete']) && is_numeric($_GET['delete']) && !empty(select($pdo, 'bn_contact', '*', 'id', $_GET['delete']))) delete($pdo, 'bn_contact', 'id', $_GET['delete']);

$contact = selectAll($pdo, 'bn_contact', '*', null, null, 'created_at', 'DESC');

include('src/template/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Messages</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Prises de contact</h3>

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
                            <th style="width: 10%">
                                Mail
                            </th>
                            <th style="width: 10%">
                                Prénom
                            </th>
                            <th style="width: 10%">
                                Nom
                            </th>
                            <th style="width: 10%">
                                Sujet
                            </th>
                            <th style="width: 38%">
                                Message
                            </th>
                            <th style="width: 10%">
                                Création
                            </th>
                            <th style="width: 10%">

                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contact as $message) : ?>
                            <tr id="item-<?= $user['id'] ?>">
                                <td>
                                    <?= $message['id'] ?>
                                </td>
                                <td>
                                    <?= $message['mail'] ?>
                                </td>
                                <td>
                                    <?= $message['firstname'] ?>
                                </td>
                                <td>
                                    <?= $message['lastname'] ?>
                                </td>
                                <td>
                                    <?= $message['subject'] ?>
                                </td>
                                <td style="max-width: 38%">
                                    <?= $message['message'] ?>
                                </td>
                                <td>
                                    <?= $message['created_at'] ?>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-danger btn-sm" href="?delete=<?= $message['id'] ?>">
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