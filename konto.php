<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PROJEKT 1 - ZAI</title>

    <meta name="description" content="PROJEKT 1 - ZAI">
    <meta name="keywords" content="PROJEKT, ZAI">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/css/fontello.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

    <script src="zegar.js"></script>

</head>

<body onload="dataczas();">

<div class="container">

    <div class="row wpis">
        <?php

        echo "<p>Witaj " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'] . "! Twój login: " . $_SESSION['login'];

        echo "<br/><a href=\"wyloguj.php\"> [ Wyloguj ] </a> <br/><br/>";

        require_once "polaczenie.php";
        require_once "wydarzenia_edit.php";
        $conn = @new mysqli($host, $db_user, $db_password, $db_name);

        if (isset($_SESSION['success_message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }

        $wydarzenie = $conn->query("SELECT * FROM wydarzenia ORDER BY data");
        foreach ($wydarzenie as $wiersz) {
				
            wydarzenia_edit($wiersz['id'], $wiersz['nazwa'], $wiersz['data'], $wiersz['czas_od'], $wiersz['czas_do'], $wiersz['zdjecie'], $wiersz['opis']);
        }
        require_once "wydarzenie_new.php";
		echo "Dodaj nowe wydarzenie: <br/> <br/>";
        wydarzenia_new(NULL, "Wpisz nazwę", "2023-10-25", "12:00", "14:00", "sciezka/do/zdjecia.jpg", "Wpisz opis");
        ?>
    </div>

    <?php
    include "myfooter.php";
    ?>

</div>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
