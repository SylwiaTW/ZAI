<?php
function wydarzenia_new($id, $nazwa, $data, $czas_od, $czas_do, $zdjecie, $opis) {
    $wydarzenie = "
    <form method=\"post\" action=\"dodaj.php\">
    <div class=\"wydarzenie\">
        <div class=\"row wpis\">
            <div class=\"col-12 col-sm-4\"> 
                <input type=\"text\" name=\"zdjecie\" value=\"$zdjecie\">
            </div>
            <div class=\"col-12 col-sm-8 d-flex align-items-center\"> 
                <dl>
                    <dt>
                        data: <input type=\"date\" name=\"data\" value=\"$data\">
                        od godz: <input type=\"time\" name=\"czas_od\" value=\"$czas_od\">
                        do godz: <input type=\"time\" name=\"czas_do\" value=\"$czas_do\">
                        <br/>
                    </dt>
                    <dd>
                        <input type=\"text\" name=\"nazwa\" value=\"$nazwa\" style=\"width: 100%;\">
                    </dd>
                    <dd>
                        <textarea name=\"opis\" style=\"width: 100%; height: 150px;\">$opis</textarea>
                    </dd>
					Kategorie: 
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"1\">  DZIECI  
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"2\">  DOROSLI
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"3\">  NAUKA
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"4\">  PLASTYCZNE
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"5\">  MUZYCZNE
					<input type=\"checkbox\" name=\"id_kat[]\" value=\"6\">  ONLINE
					
                    <input type=\"submit\" name=\"update\" value=\"Dodaj\">
                </dl>
            </div>
        </div>
    </div>
    </form>";
    echo $wydarzenie;
}
?>
