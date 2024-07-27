<?php

require_once __DIR__ . '../../config/connect.php';

$id = $_GET['id'];
$courier = $pdo->query("SELECT * FROM couriers WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

require_once '../components/header.php';
?>

<div class="container">

    <h1>Редактирование курьера</h1>

    <form class="add_region" action="/vendor/couriers/update_courier.php" method="post">
        <input type="hidden" name="id" value="<?= $courier['id'] ?>">

        <label for="name">ФИО: </label>
        <input type="text" name="name" value="<?= $courier['name'] ?>">


        <button class="btn-add" type="submit">Изменить</button>

    </form>

</div>

<?php require_once '../components/footer.php';?>