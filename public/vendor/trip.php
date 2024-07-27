<?php

require_once __DIR__ . '/../config/connect.php';

$couriers = $pdo->query('SELECT * FROM couriers')->fetchAll(PDO::FETCH_ASSOC);
$regions = $pdo->query('SELECT * FROM regions')->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courier_id = $_POST['courier_id'];
    $region_id = $_POST['region_id'];
    $departure_date = $_POST['departure_date'];

    // Проверка, что курьер не занят
    $check_courier = $pdo->prepare("SELECT arrival_date FROM trips WHERE courier_id = ? ORDER BY arrival_date DESC LIMIT 1");
    $check_courier->execute([$courier_id]);
    $current_courier = $check_courier->fetch();

    if ($current_courier && $current_courier['arrival_date'] > $departure_date) {
        echo "Курьер занят, выберите свободного курьера.";
    } else {
        // Расчет даты прибытия
        $travel_time = $pdo->query("SELECT travel_time FROM regions WHERE id = $region_id")->fetchColumn();
        $arrival_date = date('Y-m-d', strtotime($departure_date . ' +' . $travel_time . ' days'));

        // Вставка записи в БД
        $stmt = $pdo->prepare('INSERT INTO trips (courier_id, region_id, departure_date, arrival_date) VALUES (?, ?, ?, ?)');
        $stmt->execute([$courier_id, $region_id, $departure_date, $arrival_date]);
        header('Location: /views/add.trip.php');
        exit();
    }
}
