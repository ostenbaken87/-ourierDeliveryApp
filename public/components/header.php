<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestTask</title>
    <link rel="stylesheet" href="/assets/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#add_trip").on('submit', function(event) {
                event.preventDefault();
                $.post("/vendor/trip.php", $(this).serialize(), function(data) {

                });
            });
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="logo">
                <a href="/">TestTask</a>
            </div>

            <nav>
                <ul>
                    <li><a href="/views/search.trips.php">Найти поездку</a></li>
                </ul>
                <ul>
                    <li><a href="/views/add.trip.php">Добавить поездку</a></li>
                </ul>
                <ul>
                    <li><a href="/views/couriers.php">Список курьеров</a></li>
                </ul>
                <ul>
                    <li><a href="/views/regions.php">Список регионов</a></li>
                </ul>
            </nav>

        </header>
        <main>