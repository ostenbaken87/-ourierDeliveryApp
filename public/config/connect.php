<?php

$pdo = new PDO('mysql:host=mysql;dbname=testbd', 'user', 'secret');

if (!$pdo) {
    die('Error connect to database');
}

