<?php

require_once __DIR__ . '/../../config/connect.php';

$id = $_POST['id'];
$name = $_POST['name'];

$stmt = $pdo->prepare("UPDATE couriers SET name = ? WHERE id = ?");
$stmt->execute([$name, $id]);

header('Location: /views/couriers.php');
exit();