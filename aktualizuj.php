<?php
session_start();

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nowaData = $_POST['data'];
	$nowyCzas_od = $_POST['czas_od'];
	$nowyCzas_do = $_POST['czas_do'];
    $nowaNazwa = $_POST['nazwa'];
    $nowyOpis = $_POST['opis'];
	$nowaKat = $_POST['id_kat'];

    // łączenie z bazą
    require_once "polaczenie.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    // czy udało się połączyć
    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }
	
	

    // zaktulizuj bazę
	
	$sql = "UPDATE wydarzenia SET data='$nowaData', czas_od='$nowyCzas_od', czas_do='$nowyCzas_do', nazwa='$nowaNazwa', opis='$nowyOpis' WHERE id=$id";
	
	if ($conn->query($sql)  === TRUE) {
		$_SESSION['success_message'] = "Dane zostały zaktualizowane pomyślnie.";
		header('Location: konto.php');
	} else {
		echo "Błąd aktualizacji danych: " . $conn->error;
	}
	
	
	if (!empty($nowaKat)) {
    $usun_kat = "DELETE FROM kat_wyd WHERE id_wyd = $id";
    $conn->query($usun_kat);
    }

	
	foreach ($nowaKat as $kat) {
        
     $wstaw_kat	 = "INSERT INTO kat_wyd (id_wyd, id_kat) VALUES ($id, $kat)";
     $conn->query($wstaw_kat);

    }
	
	
	// koniec polaczenia
    $conn->close();
	
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    require_once "polaczenie.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    // czy udało się połączyć
    if ($conn->connect_error) {
        die("Błąd połączenia z bazą danych: " . $conn->connect_error);
    }

    $sql = "DELETE FROM wydarzenia WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Wydarzenie zostało usunięte pomyślnie.";
        header('Location: konto.php');
    } else {
        echo "Błąd usuwania wydarzenia: " . $conn->error;
    }

    // Zakończ połączenie z bazą danych
    $conn->close();
}

?>
