<header>
    <div class="row">
        <?php
        session_start();

        if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true) {
            header('Location: konto.php');
            exit();
        }

        if (isset($_POST['submit'])) {
            $walidacja = true;

            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $login = $_POST['login1'];
            $haslo = $_POST['haslo'];
            $haslo2 = $_POST['haslo2'];
            $mailik = $_POST['mailik'];
			
			
			$imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
			$nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
			$haslo2 = htmlentities($haslo2, ENT_QUOTES, "UTF-8");
			$mailik = htmlentities($mailik, ENT_QUOTES, "UTF-8");
			
			

            if (ctype_alpha($imie) == false) {
                $walidacja = false;
                $_SESSION['error_imie'] = "Imię może zawierać wyłącznie litery, bez polskich znaków";
            }

            if (ctype_alpha($nazwisko) == false) {
                $walidacja = false;
                $_SESSION['error_nazwisko'] = "Nazwisko może zawierać wyłącznie litery, bez polskich znaków";
            }

            if ((strlen($login) < 4) || (strlen($login) > 11)) {
                $walidacja = false;
                $_SESSION['error_login'] = "Nieprawidłowa liczba znaków (login musi posiadać od 4 do 11 znaków)";
            }

            if (ctype_alnum($login) == false) {
                $walidacja = false;
                $_SESSION['error_login'] = "Login może zawierać tylko cyfry i litery, bez polskich znaków";
            }

            if ((strlen($haslo) < 4) || (strlen($haslo) > 11)) {
                $walidacja = false;
                $_SESSION['error_haslo'] = "Nieprawidłowa liczba znaków (hasło musi posiadać od 4 do 11 znaków)";
            }

            if ($haslo != $haslo2) {
                $walidacja = false;
                $_SESSION['error_haslo'] = "Podane hasła nie są takie same";
            }
			
			$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

            require_once "polaczenie.php";
            $conn = @new mysqli($host, $db_user, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Błąd połączenia z bazą danych: " . $conn->connect_error);
            }

            if ($wynik1 = $conn->query("SELECT id FROM uzytkownicy WHERE mail='$mailik'")) {
                $mailexist = $wynik1->num_rows;
                if ($mailexist > 0) {
                    $walidacja = false;
                    $_SESSION['error_mail'] = "E-mail już istnieje w bazie";
                }
            }

            if ($wynik2 = $conn->query("SELECT id FROM uzytkownicy WHERE login='$login'")) {
                $loginexist = $wynik2->num_rows;
                if ($loginexist > 0) {
                    $walidacja = false;
                    $_SESSION['error_login'] = "Login już istnieje w bazie";
                }
            }

            if ($walidacja == true) {
                $last_id = $conn->query("SELECT MAX(id) FROM uzytkownicy");
                while ($id = $last_id->fetch_assoc()) {
                    $new_id = implode($id) + 1;
                }

                $sql = "INSERT INTO uzytkownicy (id, imie, nazwisko, login, haslo, mail) VALUES ('$new_id', '$imie', '$nazwisko', '$login', '$haslo_hash', '$mailik')";

                if ($conn->query($sql) === true) {
                    echo "Nowe Konto zostało utworzone. Zaloguj się, używając podanych danych.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        }
        ?>
        <div class="col-12" id="zegar"></div>

        <div class="col-12 col-xl-6" id="opis">
            <h1> Opis </h1>
Prezentowana strona internetowa to prosty system "pamiętnikowy" stworzony w ramach projektu "Zaawansowane Aplikacje Internetowe." Główną cechą strony jest możliwość przeglądania wydarzeń w porządku chronologicznym, dzięki czemu użytkownicy mogą łatwo śledzić i zarządzać swoimi planami. Strona oferuje filtrowanie wydarzeń na podstawie różnych kategorii, w tym "Dla dzieci," "Dla dorosłych," "Nauka," "Plastyczne," "Muzyczne" i "Online." Gdy użytkownicy klikną na jedną z ikon reprezentujących kategorie wydarzeń strona automatycznie ogranicza wyświetlane wydarzenia do tej konkretnej kategorii. Filtrowanie to jest intuicyjne i proste w obsłudze, z możliwością łatwego wyczyszczenia filtra po kliknięciu na ikonę "X." Co więcej, po najechaniu kursorem na ikonę kategorii, użytkownicy otrzymują dodatkowe informacje w postaci opisu kategorii. Strona umożliwia edycję wydarzeń po zalogowaniu. W przypadku braku danych do logowania można zarejestrować nowego użytkownika.

		<br />
		</div>

        <div class="col-sm-12 col-md-6 col-xl-3 d-flex justify-content-center">
            <div class="d-flex flex-column">
                <h1> Logowanie </h1>
                <form action="zaloguj.php" method="post">
                    Login: <br />
                    <input type="text" name="login"/>
                    <br />
                    Hasło: <br />
                    <input type="password" name="haslo"/>
                    <br /> <br/>
                    <input type="submit" value="Zaloguj się" />
                    <?php
                    if (isset($_SESSION['error_logowanie'])) {
                        echo '<div class="error">' . $_SESSION['error_logowanie'] . '</div>';
                        unset($_SESSION['error_logowanie']);
                    }
                    ?>
                </form>
                <br /><br />
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-3 d-flex justify-content-center">
            <div class="d-flex flex-column">
                <h1> Rejestracja</h1>
                <form method="post">
                    Imię: <br />
                    <input type="text" name="imie"/>
                    <br />
                    <?php
                    if (isset($_SESSION['error_imie'])) {
                        echo '<div class="error">' . $_SESSION['error_imie'] . '</div>';
                        unset($_SESSION['error_imie']);
                    }
                    ?>
                    Nazwisko: <br />
                    <input type="text" name="nazwisko" />
                    <br />
                    <?php
                    if (isset($_SESSION['error_nazwisko'])) {
                        echo '<div class="error">' . $_SESSION['error_nazwisko'] . '</div>';
                        unset($_SESSION['error_nazwisko']);
                    }
                    ?>
                    Login: <br />
                    <input type="text" name="login1"/>
                    <br />
                    <?php
                    if (isset($_SESSION['error_login'])) {
                        echo '<div class="error">' . $_SESSION['error_login'] . '</div>';
                        unset($_SESSION['error_login']);
                    }
                    ?>
                    Hasło: <br />
                    <input type="password" name="haslo"/>
                    <br />
                    <?php
                    if (isset($_SESSION['error_haslo'])) {
                        echo '<div class="error">' . $_SESSION['error_haslo'] . '</div>';
                        unset($_SESSION['error_haslo']);
                    }
                    ?>
                    Powtórz hasło: <br />
                    <input type="password" name="haslo2"/>
                    <br />
                    E-mail: <br />
                    <input type="email" name="mailik"/>
                    <br />
                    <?php
                    if (isset($_SESSION['error_mail'])) {
                        echo '<div class="error">' . $_SESSION['error_mail'] . '</div>';
                        unset($_SESSION['error_mail']);
                    }
                    ?>
                    <br />
                    <input type="submit" name="submit" value="Zarejestruj dane" />
					<br /><br />
                </form>
            </div>
        </div>
    </div>
</header>