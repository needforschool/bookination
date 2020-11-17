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
                    <h1 class="m-0 text-dark">Vaccins</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
            <form action="" method="POST">

                <input type="text" name="name" placeholder="Nom du vaccin" value="<?php if (!empty($_POST['name'])) echo $_POST['name'];?>">
                <span class="error"><?= (!empty($errors['name'])) ? $errors['name'] : '' ?></span> 

                <select name="mandat" value="<?php if (!empty($_POST['mandatory'])) echo $_POST['mandatory'];?>">
                    <option value="">-- choisir le type de vaccin --</option>
                    <option value="vert">Obligatoire</option>
                    <option value="jaune">Non-obligatoire</option>
                </select>
                <span class="error"><?= (!empty($errors['mandatory'])) ? $errors['mandatory'] : '' ?></span>
    
                <input type="text" name="frequency" placeholder="Fréquence de vaccination" value="<?php if (!empty($_POST['frequency'])) echo $_POST['frequency'];?>">
                <span class="error"><?= (!empty($errors['frequency'])) ? $errors['frequency'] : '' ?></span>

                <input type="submit" name="submitted" placeholder="Ajouter">
        
            </form>