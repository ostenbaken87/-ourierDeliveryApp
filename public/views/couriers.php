<?php

require_once __DIR__ . '../../config/connect.php';

$couriers = $pdo->query('SELECT * FROM couriers')->fetchAll(PDO::FETCH_ASSOC);

require_once '../components/header.php';
?>

<div class="container">
    <h1>Список курьеров</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th colspan="2">Действия</th>
        </tr>
        <?php foreach ($couriers as $courier) { ?>
            <tr>
                <td><?= $courier['id'] ?></td>
                <td><?= $courier['name'] ?></td>
                <td>
                    <a href="/views/edit.courier.php?id=<?= $courier['id'] ?>">Изменить</a>
                </td>
                <td>
                    <a href="../../vendor/couriers/delete_courier.php?id=<?= $courier['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Добавить курьера</h3>
    
    <form class="add_region" action="../../vendor/couriers/add_courier.php" method="post">
        <label for="name">ФИО: </label>
        <input type="text" name="name" required>
        <p>Например: Иванов Иван Иванович</p>

        <button class="btn-add" type="submit">Добавить</button>
    </form>
    
</div>
<?php require_once '../components/footer.php';?>