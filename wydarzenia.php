<?php
function wydarzenia($id, $nazwa, $data, $czas_od, $czas_do, $zdjecie, $opis, $ikonasql){
    $ikony = array(); 

    // z mysqli_result na tablicę ikon
    while ($row = $ikonasql->fetch_assoc()) {
        $ikony[] = $row['ikona'];
    }

    $wydarzenie = "
    <form method=\"post\">
		<div class=\"timeline_item\">
			<div class=\"wydarzenie\">
				<div class=\"row wpis\">
					<div class=\"col-12 col-sm-4\"> 
						<img src=\"$zdjecie\">
					</div>
					<div class=\"col-12 col-sm-8 d-flex align-items-center\"> 
						<dl>
							<dt>$data od $czas_od do $czas_do</dt>
							<dd>$nazwa</dd>
							<dd>$opis</dd>
							
						<div class=\"d-flex flex-wrap\">";

    foreach ($ikony as $ikona) {
        $wydarzenie .= "<div class=\"tile2 d-flex p-2\"><i class=\"$ikona\"></i></div><br>";
    }

    $wydarzenie .= "
						</div>
					</dl>
					</div>
				</div>
			</div>
		</div>
    </form>";

    echo $wydarzenie;
}
?>
