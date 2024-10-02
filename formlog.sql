-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Paź 2023, 15:42
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `formlog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` char(11) NOT NULL,
  `ikona` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `ikona`) VALUES
(1, 'DZIECI', 'icon-puzzle'),
(2, 'DOROSLI', 'icon-users'),
(3, 'NAUKA', 'icon-graduation-cap'),
(4, 'PLASTYCZNE', 'icon-brush'),
(5, 'MUZYCZNE', 'icon-music'),
(6, 'ONLINE', 'icon-monitor');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kat_wyd`
--

CREATE TABLE `kat_wyd` (
  `kat_wyd_id` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `id_wyd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kat_wyd`
--

INSERT INTO `kat_wyd` (`kat_wyd_id`, `id_kat`, `id_wyd`) VALUES
(2, 2, 2),
(3, 1, 3),
(4, 1, 4),
(6, 4, 2),
(7, 6, 5),
(8, 4, 3),
(9, 3, 4),
(10, 2, 5),
(13, 1, 1),
(14, 3, 1),
(15, 4, 1),
(16, 1, 12),
(17, 5, 12),
(18, 2, 13),
(19, 4, 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `imie`, `nazwisko`, `login`, `haslo`, `mail`) VALUES
(1, 'Jan', 'Kowalski', 'admin', '$2y$10$NDLRiscfR9XQdsyfqcfeHeGxEDyQ31xfIbgsNHk.EUQUegcGRPJOy', 'admin@gmail.pl'),
(2, 'Jan', 'Kowalski', 'jkowal', '$2y$10$VANhrK.qsgjKsxdyVTHdaOZCgtinEQM/J0cFzCziPGs.P2mdvAR9i', 'jkowal@gmail.pl'),
(3, 'Anna', 'Nowak', 'anowak', '$2y$10$guby5PZ2q9u2egl0pAih0Oou7rd49lE0e9NcHvk20t1y9qK4aewq6', 'anowak@gmail.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydarzenia`
--

CREATE TABLE `wydarzenia` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `czas_od` time NOT NULL,
  `czas_do` time DEFAULT NULL,
  `nazwa` char(255) NOT NULL,
  `zdjecie` text DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wydarzenia`
--

INSERT INTO `wydarzenia` (`id`, `data`, `czas_od`, `czas_do`, `nazwa`, `zdjecie`, `opis`) VALUES
(1, '2023-10-25', '12:00:00', '14:00:00', 'WARSZTATY SLIME', 'http://centrum-animacji.pl/wp-content/uploads/2018/09/warsztaty-slime1.jpg', 'Slime to świetna zabawa, która skradła dziecięce serca. Wszyscy oszaleli na punkcie tej ciągnącej się mazi! Kolorowy glutek rozwija kreatywność i pobudza wyobraźnię. Do tego jest całkowicie bezpieczny i szybko można go zrobić samodzielnie w domu.'),
(2, '2023-11-17', '09:00:00', '10:00:00', 'OPROWADZANIE DLA DOROSŁYCH', 'https://zacheta.art.pl/public/upload/custom_grid/double_r/64d250ebd655f.jpg?1691506429', 'Ekspozycja obejmuje wybór słynnych realizacji oraz nieznanych prac, a także grupę rzeźb kameralnych, wchodzących w rezonans z zagadnieniami organiczności.'),
(3, '2023-10-31', '19:00:00', '21:00:00', 'WARSZTATY DYNIOWE', 'https://bi.im-g.pl/im/a1/39/19/z26448033IH,Wycinanie-dyni-na-Halloween-to-swietna-zabawa-dla-.jpg', 'Wycinanie dyni na Halloween to świetna zabawa dla całej rodziny. Nic tak nie tworzy klimatu Halloween, jak wesoły lampion z dyni. To miła tradycja i ciekawy pomysł na wspólnie spędzony czas. Sprawdź, jak zrobić lampion i wybierz najstraszniejszy motyw.'),
(4, '2023-11-11', '10:00:00', '11:00:00', 'RODZINNE NIEDZIELE', 'https://www.mnw.art.pl/gfx/muzeumnarodowe/_thumbs/pl/muzeumkalendarium/20/7304/1/rodzinne_niedziele_www,mXR5oa6vrGuYqcOKaaQ.png', 'Zapraszamy na wspólne odkrywanie Muzeum w każdą niedzielę! Te dni to czas dla rodziny, a Muzeum to świetne miejsce, w którym można ciekawie spędzić czas z najbliższymi: podziwiać dzieła sztuki, zadawać trudne pytania i szukać na nie odpowiedzi, a nawet trochę się pobawić. '),
(5, '2023-12-07', '12:00:00', '14:00:00', 'WARSZTATY GRZYBIARSKIE', 'https://balticmed.pl/wp-content/uploads/2020/09/8-7-Grzyby-strona.jpg', 'Opis opis'),
(12, '2024-01-03', '12:00:00', '14:00:00', 'GORDONKI', 'https://akademiapaniszafki.pl/wp-content/uploads/2020/09/Gordonki-marki-akademia-malucha-pani-szafki-strona.jpg', 'Zajęcia umuzykalniające dla dzieci.'),
(13, '2023-11-08', '18:00:00', '19:00:00', 'WYSTAWA PICASSO', 'https://th-thumbnailer.cdn-si-edu.com/d8lYuU-FaUiKvIQuUG35w0BkhyA=/1072x720/filters:no_upscale():focal(761x548:762x549)/https://tf-cmsv2-smithsonianmag-media.s3.amazonaws.com/filer/b6/e5/b6e53329-b6df-4539-8279-46451cf4dba0/picasso.png', 'Wystawa sztuki Picassa w Muzeum Narodowym');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kat_wyd`
--
ALTER TABLE `kat_wyd`
  ADD PRIMARY KEY (`kat_wyd_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `kat_wyd`
--
ALTER TABLE `kat_wyd`
  MODIFY `kat_wyd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `wydarzenia`
--
ALTER TABLE `wydarzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
