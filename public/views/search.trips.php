<?php

require_once __DIR__ . '../../config/connect.php';

$trips = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['selected_date'])) {
    $selected_date = $_POST['selected_date'];

    if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $selected_date)) {
        $query = "SELECT t.*, c.name as courier_name, r.name as region_name FROM trips t JOIN couriers c ON t.courier_id = c.id JOIN regions r ON t.region_id = r.id WHERE departure_date = ?";
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([$selected_date])) {
            $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Ошибка выполнения запроса";
        }
    }
}

require_once '../components/header.php';
?>

<div class="container">

    <h1>Поиск поездок</h1>

    <form class="form_search" method="post">
        <label for="selected_date">Выберите дату: </label>
        <input type="date" name="selected_date">
        <button type="submit" class="btn_search" value="Показать поездки">Показать поездки</button>
    </form>

    <?php if ($trips) : ?>
        <div class="trips">
            <h3>Поездки на <?= htmlspecialchars($_POST['selected_date']) ?>:</h3>
            <ol>
                <?php foreach ($trips as $trip) : ?>
                    <li><?= htmlspecialchars($trip['courier_name']) ?> в <?= htmlspecialchars($trip['region_name']) ?> (<?= htmlspecialchars($trip['departure_date']) ?> - <?= htmlspecialchars($trip['arrival_date']) ?>)</li>
                <?php endforeach; ?>
            </ol>
        </div>

    <?php else : ?>
        <p class="trips">! Поездок на указанную дату не найдено !</p>
    <?php endif; ?>

</div>


<?php require_once '../components/footer.php'; ?>