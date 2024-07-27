<?php

require_once __DIR__ . '/../../config/connect.php';

$id = $_GET['id'];

$pdo->query("DELETE FROM couriers WHERE id = $id");

header('Location: /views/couriers.php');
exit();
