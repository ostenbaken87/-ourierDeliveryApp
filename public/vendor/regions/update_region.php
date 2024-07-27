<?php

require_once __DIR__ . '/../../config/connect.php';

$name = $_POST['name'];
$travel_time = $_POST['travel_time'];

$stmt = $pdo->prepare("INSERT INTO regions (name, travel_time) VALUES (?, ?)");
$stmt->execute([$name, $travel_time]);

header('Location: /views/regions.php');
exit();