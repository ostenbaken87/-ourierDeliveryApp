<?php

require_once __DIR__ . '/../../config/connect.php';

$name = $_POST['name'];

$stmt = $pdo->prepare("INSERT INTO couriers (name) VALUES (?)");
$stmt->execute([$name]);

header('Location: /views/couriers.php');
exit();