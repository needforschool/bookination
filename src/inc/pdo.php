<?php

use Symfony\Component\Dotenv\Dotenv;

$basepath = realpath(dirname(__FILE__) . '/../..');

require $basepath . '/vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load($basepath . '/.env');

try {
    $pdo = new PDO('mysql:host=' . $_ENV['DB_SERVER'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ]);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
