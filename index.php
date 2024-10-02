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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" </script>
	<![endif]-->
	
	<script src="zegar.js"></script>
	

</head>

<body onload="dataczas();">

	<div class= "container">
	
	
		<?php 
			include "myheader.php";
		?>
	
		<br />
		
		<h1> Wybierz kategorię wydarzenia: </h1>
		
		<form method="post"class="d-flex flex-row" id="ikony">
				<button class="tile p-2" title="Dla dzieci" type="submit" name="filtr" value="1"><i class="icon-puzzle"></i></button>
                <button class="tile p-2" title="Dla dorosłych" type="submit" name="filtr" value="2"><i class="icon-users"></i></button>
                <button class="tile p-2" title="Nauka" type="submit" name="filtr" value="3"><i class="icon-graduation-cap"></i></button>
                <button class="tile p-2" title="Plastyczne" type="submit" name="filtr" value="4"><i class="icon-brush"></i></button>
                <button class="tile p-2" title="Muzyczne" type="submit" name="filtr" value="5"><i class="icon-music"></i></button>
                <button class="tile p-2" title="Online" type="submit" name="filtr" value="6"><i class="icon-monitor"></i></button>
				<button class="tile p-2" title="Wyczyść" type="submit" name="filtr" value="0"><i class="icon-cancel-circled"></i></button>
		</form>
		


	<br />
		<br />
		
		<div class="row wpis">
		<div class="timeline_list">


			<?php

				require_once "polaczenie.php";
				require_once "wydarzenia.php";
				$conn= @new mysqli($host, $db_user, $db_password, $db_name);
				
				
				if (isset($_POST['filtr']) && $_POST['filtr'] > 0){
				$filtr = $_POST['filtr'];
				$wydarzenie = $conn->query("SELECT * FROM wydarzenia JOIN kat_wyd ON wydarzenia.id = kat_wyd.id_wyd WHERE kat_wyd.id_kat=$filtr ORDER BY wydarzenia.data");  

				foreach($wydarzenie as $wiersz) 
				{
					$id_wyd = $wiersz['id'];
					$ikona = $conn->query("SELECT kategorie.ikona FROM kategorie JOIN kat_wyd ON kategorie.id = kat_wyd.id_kat WHERE kat_wyd.id_wyd = $id_wyd");

					
					$czas_od = substr($wiersz['czas_od'], 0, 5); // obcina do normalnego formatu
					$czas_do = substr($wiersz['czas_do'], 0, 5);
					wydarzenia($id_wyd, $wiersz['nazwa'], $wiersz['data'], $czas_od, $czas_do, $wiersz['zdjecie'], $wiersz['opis'], $ikona);
					

				}
				}
				else{
				$wydarzenie = $conn->query("SELECT * FROM wydarzenia ORDER BY data");  

				foreach($wydarzenie as $wiersz) 
				{
					$id_wyd = $wiersz['id'];
					$ikona = $conn->query("SELECT kategorie.ikona FROM kategorie JOIN kat_wyd ON kategorie.id = kat_wyd.id_kat WHERE kat_wyd.id_wyd = $id_wyd");

					
					$czas_od = substr($wiersz['czas_od'], 0, 5); // obcina do normalnego formatu
					$czas_do = substr($wiersz['czas_do'], 0, 5);
					wydarzenia($id_wyd, $wiersz['nazwa'], $wiersz['data'], $czas_od, $czas_do, $wiersz['zdjecie'], $wiersz['opis'], $ikona);
					

				}
				}
				

			?>
			
		</div>
		</div>
		
	<?php 
		include "myfooter.php";
	?>
		
		
	</div>
	
	<script src="js/bootstrap.min.js"></script>
	



</body>
</html>