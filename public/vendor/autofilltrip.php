<?php

require_once __DIR__ . '/../config/connect.php';

$couriers = $pdo->query('SELECT * FROM couriers')->fetchAll(PDO::FETCH_ASSOC);
$regions = $pdo->query('SELECT * FROM regions')->fetchAll(PDO::FETCH_ASSOC);

function autoFillTrips($pdo, $couriers, $regions, $selectedRegionId, $selectedCourierId, $startDate, $months = 3)
{
    if (empty($couriers) || empty($regions)) {
        throw new Exception('Couriers or regions not found.');
    }

    $courier = array_filter($couriers, function ($c) use ($selectedCourierId) {
        return $c['id'] == $selectedCourierId;
    });

    $region = array_filter($regions, function ($r) use ($selectedRegionId) {
        return $r['id'] == $selectedRegionId;
    });

    if (empty($courier) || empty($region)) {
        throw new Exception('Courier or region not found.');
    }

    $courier = array_shift($courier);
    $region = array_shift($region);

    $endDate = date('Y-m-d', strtotime("+$months months", strtotime($startDate)));
    $currentDate = $startDate;

    while (strtotime($currentDate) < strtotime($endDate)) {
        
            $courier_id = $courier['id'];
            $region_id = $region['id'];
            $departure_date = $currentDate;

            $check_courier = $pdo->prepare("SELECT arrival_date FROM trips WHERE courier_id = ? ORDER BY arrival_date DESC LIMIT 1");
            $check_courier->execute([$courier_id]);
            $current_courier = $check_courier->fetch(PDO::FETCH_ASSOC);
            if ($current_courier && $current_courier['arrival_date'] > $departure_date) {
                echo "Курьер занят, выберите свободного курьера.";
                die();
            }

            if (!$current_courier || strtotime($current_courier['arrival_date']) <= strtotime($departure_date)) {
                $travel_time = $pdo->query("SELECT travel_time FROM regions WHERE id = $region_id")->fetchColumn();
                $arrival_date = date('Y-m-d', strtotime($departure_date . " +$travel_time days"));

                $stmt = $pdo->prepare('INSERT INTO trips (courier_id, region_id, departure_date, arrival_date) VALUES (?, ?, ?, ?)');
                $stmt->execute([$courier_id, $region_id, $departure_date, $arrival_date]);
            }
        
        $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
    }
}


$courier_id = $_POST['courier_id'];
$region_id = $_POST['region_id'];
$departure_date = $_POST['departure_date'];
autoFillTrips($pdo, $couriers, $regions, $region_id, $courier_id, $departure_date);
header('Location: /views/add.trip.php');
exit();

