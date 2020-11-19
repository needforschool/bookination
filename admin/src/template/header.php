<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin - Bookination</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="shortcut icon" href="./../assets/img/logo/logo-square-bg-none.png" type="image/png">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./../" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #f5467b;">
            <!-- Brand Logo -->
            <a href="./" class="brand-link">
                <img src="../assets/img/logo/logo-square-bg-none.png" alt="Bookination Logo" class="brand-image img-circle elevation-3" style="opacity: 1">
                <span class="brand-text font-weight-light">Admin | Bookination</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if ($_SESSION['user']['gender'] == 'homme') : ?>
                            <img class="img-circle elevation-2" src="./../assets/img/man.png" alt="Photo ID">
                        <?php else : ?>
                            <img class="img-circle elevation-2" src="./../assets/img/woman.png" alt="Photo ID">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="../dashboard.php" class="d-block"><?= $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Tableau de côntrole</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users.php" class="nav-link">
                                <i class="nav-icon fas fa-id-card-alt"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="vaccines.php" class="nav-link">
                                <i class="nav-icon fas fa-syringe"></i>
                                <p>Vaccins</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="vaccines_add.php" class="nav-link">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Nouveau vaccin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>