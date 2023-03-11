<?php

//Note: This file should be included first in every php page.
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
require_once 'helpers/helpers.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

try {
    $pdo = new PDO('mysql:dbname=easy_recipes;host=localhost:3306', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {
    echo "Connection failed" . $e->getMessage();
}
