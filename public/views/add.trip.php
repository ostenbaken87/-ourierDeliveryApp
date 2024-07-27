<?php

require_once __DIR__ . '../../config/connect.php';

$couriers = $pdo->query('SELECT * FROM couriers')->fetchAll(PDO::FETCH_ASSOC);
$regions = $pdo->query('SELECT * FROM regions')->fetchAll(PDO::FETCH_ASSOC);
$trips = $pdo->query('
    SELECT 
        trips.id,
        regions.name as region_name, 
        couriers.name as courier_name, 
        trips.departure_date, 
        trips.arrival_date
    FROM 
        trips
    INNER JOIN 
        regions ON trips.region_id = regions.id
    INNER JOIN 
        couriers ON trips.courier_id = couriers.id
')->fetchAll(PDO::FETCH_ASSOC);

require_once '../components/header.php';
?>

<div class="container">

    <h1>Добавить поездку</h1>

    <div class="add_trip_form">
        <h3>Форма создание поездки</h3>
        <form class="add_trip" action="../../vendor/trip.php" method="post">

            <label for="region_id">Регион: </label>
            <select name="region_id" required>
                <?php foreach ($regions as $region) { ?>
                    <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                <?php } ?>
            </select>

            <label for="departure_date">Дата выезда: </label>
            <input type="date" name="departure_date" min="<?= date('Y-m-d') ?>" required>

            <label for="courier_id">ФИО курьера: </label>
            <select name="courier_id" required>
                <?php foreach ($couriers as $courier) { ?>
                    <option value="<?= $courier['id'] ?>"><?= $courier['name'] ?></option>
                <?php } ?>
            </select>

            <button class="btn-add" type="submit">Добавить поездку</button>
            <p class="info">(выберите курьера, регион и дату для ручного заполнения)</p>

        </form>

        <form class="add_trip" action="../../vendor/autofilltrip.php" method="post">
            <label for="region_id">Регион: </label>
            <select name="region_id" required>
                <?php foreach ($regions as $region) { ?>
                    <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                <?php } ?>
            </select>

            <label for="departure_date">Дата выезда: </label>
            <input type="date" name="departure_date" min="<?= date('Y-m-d') ?>" required>

            <label for="courier_id">ФИО курьера: </label>
            <select name="courier_id" required>
                <?php foreach ($couriers as $courier) { ?>
                    <option value="<?= $courier['id'] ?>"><?= $courier['name'] ?></option>
                <?php } ?>
            </select>
            <button class="btn-addauto" type="submit">Автозаполнить</button>
            <p class="info">(выберите курьера, регион и дату от которой пройдет автозаполнение поездок на 3 месяца)</p>
        </form>

    </div>

    <h3>Список поездок</h3>

    <table id="trips_table">
        <tr>
            <th>ID</th>
            <th>Регион</th>
            <th>Курьер</th>
            <th>Дата выезда</th>
            <th>Дата прибытия</th>
        </tr>

        <?php foreach ($trips as $trip) { ?>
            <tr>
                <td><?= $trip['id'] ?></td>
                <td><?= $trip['region_name'] ?></td>
                <td><?= $trip['courier_name'] ?></td>
                <td><?= $trip['departure_date'] ?></td>
                <td><?= $trip['arrival_date'] ?></td>
            </tr>
        <?php } ?>
        </tr>
    </table>

</div>


<div class="container">

</div>


<?php require_once '../components/footer.php'; ?>