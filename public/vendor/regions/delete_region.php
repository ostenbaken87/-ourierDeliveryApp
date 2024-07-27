<?php

require_once __DIR__ . '/../../config/connect.php';

$region = $pdo->query('SELECT * FROM regions WHERE id = ' . $_GET['id'])->fetch(PDO::FETCH_ASSOC);

$query = $pdo->prepare('DELETE FROM regions WHERE id = ?');
$query->execute([$region['id']]);

header('Location: /views/regions.php');
exit();