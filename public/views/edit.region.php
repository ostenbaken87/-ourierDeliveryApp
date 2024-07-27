<?php

require_once __DIR__ . '../../config/connect.php';

$region = $pdo->query('SELECT * FROM regions WHERE id = ' . $_GET['id'])->fetch(PDO::FETCH_ASSOC);

require_once '../components/header.php';
?>

<div class="container">

    <h3>Редактирование региона - <?= $region['name'] ?></h3>

    <form class="add_region" action="/vendor/regions/update_region.php" method="post">
        <input type="hidden" name="id" value="<?= $region['id'] ?>">

        <label for="name">Название региона: </label>
        <input type="text" name="name" value="<?= $region['name'] ?>">

        <label for="travel_time">Время в пути: </label>
        <input type="number" min="0" max="10" name="travel_time" value="<?= $region['travel_time'] ?>">

        <button class="btn-add" type="submit">Редактировать</button>
    </form>

</div>

<?php require_once '../components/footer.php';?>