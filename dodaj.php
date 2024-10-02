<?php
session_start();

if (isset($_POST['update'])) {
    $data = $_POST['data'];
	$czas_od = $_POST['czas_od'];
	$czas_do = $_POST['czas_do'];
    $nazwa = $_POST['nazwa'];
	$zdjecie = $_POST['zdjecie'];
    $opis = $_POST['opis'];
	$nowaKat = $_POST['id_kat'];

    // łączenie z bazą
    require_once "polaczenie.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    // czy udało się połączyć
    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }


    $sql = "INSERT INTO wydarzenia (nazwa, data, czas_od, czas_do, zdjecie, opis) VALUES ('$nazwa', '$data', '$czas_od', '$czas_do', '$zdjecie', '$opis')";

    if ($conn->query($sql) === TRUE) {
		$id = mysqli_insert_id($conn);
		$_SESSION['success_message'] = "Dane zostały dodane pomyślnie.";
		header('Location: konto.php');
	} else {
		echo "Błąd dodawania danych: " . $conn->error;
	}
	
	foreach ($nowaKat as $kat) {    
     $wstaw_kat	 = "INSERT INTO kat_wyd (id_wyd, id_kat) VALUES ($id, $kat)";
     $conn->query($wstaw_kat);
    }


    $conn->close();
}
?>


