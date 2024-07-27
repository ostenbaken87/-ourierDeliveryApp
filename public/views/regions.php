<?php
require_once __DIR__ . '../../config/connect.php';

$regions = $pdo->query('SELECT * FROM regions')->fetchAll(PDO::FETCH_ASSOC);

require_once '../components/header.php';
?>

<div class="container">

    <h1>Список регионов</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Время в пути ( д.)</th>
            <th colspan="2">Действия</th>
        </tr>
        <?php foreach ($regions as $region) { ?>
            <tr>
                <td><?= $region['id'] ?></td>
                <td><?= $region['name'] ?></td>
                <td><?= $region['travel_time'] ?></td>
                <td>
                    <a href="/views/edit.region.php?id=<?= $region['id'] ?>">Изменить</a>
                </td>
                <td>
                    <a href="../../vendor/regions/delete_region.php?id=<?= $region['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Добавить регион</h3>
    
    <form class="add_region" action="../../vendor/regions/add_region.php" method="post">

        <label for="name">Название региона: </label>
        <input type="text" name="name" required>

        <label for="travel_time">Время в пути: </label>
        <input type="number" min="0" max="10" name="travel_time" required>

        <button class="btn-add" type="submit">Добавить</button>
    </form>

</div>

<?php require_once '../components/footer.php';
