<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/img/logo/logo-square-bg-none.png" type="image/png">
</head>

<body>
    <header id="header">
        <div class="wrap-fluid">
            <div class="nav">
                <div class="navlogo">
                    <a href="./">
                        <img src="assets/img/logo/logo-white-bg-none.png" alt="Logo Bookination" class="navlogo-normal">
                        <img src="assets/img/logo/logo-square-bg-none.png" alt="Logo Bookination" class="navlogo-small">
                    </a>
                </div>
                <ul class="navbar">
                    <li><a href="./contact.php">Contact</a></li>
                </ul>
                <div class="profilebar">
                    <?php if (isAdmin()) : ?>
                        <a href="./admin" class="btn btn-login admin">Admin</a>
                    <?php endif; ?>
                    <a href="<?= (isLogged()) ? './dashboard.php' : './login.php' ?>" class="btn btn-login"><?= (isLogged()) ? 'Tableau de bord' : 'Se connecter' ?></a>
                </div>
            </div>
        </div>
    </header>