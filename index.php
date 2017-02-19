<?php
try
{
    $polaczenie = new mysqli('localhost','root','','toczyto');
    if($polaczenie->connect_errno!=0)
    {
        throw new Expection(mysqli_connect_errno());
    }
    else
    {
        $zapytanie = $polaczenie->query("SELECT * FROM pytania");
        $ile = $zapytanie->num_rows;
    }
}
catch(Expection $ex)
{
    echo "ERROR ".$ex;
}
?>
<!DOCTYPE HTML>
<html lang="pl">
    
<head>
    <title>ToCzyTo?</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="description" content="Sprawdź swoją wiedzę, baw się, ucz się, rozwijaj się, rywalizuj i pomóż tworzyć serwis!">
    <meta name="keywords" content="gra,game,quiz,zagadki,łamigłówki,logiczne,krzyżówki,pytania,wiedza,rozum,iq">
    <meta name="author" content="Corleone">
    <link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cousine:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
</head>

<body>
    <div id="main">
        <div id="header">
            <a href="index.php">To czy To?</a>
        </div>
        <div id="menu">
        <a href="gra.php"><div class="option">Graj!</div></a>
        <a href="index.php#jakgrac"><div class="option">Jak grać?</div></a>
        <a href="index.php#oprojekcie"><div class="option">O projekcie</div></a>
        <a href="index.php#dodajpytanie"><div class="option">Dodaj pytanie!</div></a>
        <a href="index.php#kontakt"><div class="option">Kontakt</div></a>
        <div style="clear: both;"></div>
        </div>
        <div id="content">
            <div class="chapter" id="jakgrac">
            W NASZEJ BAZIE ZNAJDUJE SIĘ JUŻ <?php echo $ile; ?> PYTAŃ!<br><br>
            WYBIERZ JEDNĄ Z DWÓCH PODANYCH ODPOWIEDZI<br><br>
            MASZ 8 SEKUND<br><br>
            <a id="agraj" href="gra.php">GRAJ</a>
            </div>
            <div class="chapter" id="oprojekcie">
            Serwis został stworzony dla czystej zabawy, z przyjemności, którą czerpię z tworzenia stron WWW :D<br><br><br>
            Użyłem: HTML5 - CSS3 - JS - PHP - MySQL<br><br><br>
            </div>
            <div class="chapter" id="dodajpytanie">
            DODAJ PYTANIE<br><br>
                <form name="dodawanie" action="dodawanie.php" class="dodawanie">
                Treść pytania<br>
                    <textarea class="pole" name="pytanie" placeholder="Jakiego koloru jest czerwony maluch?"></textarea><br>
                Poprawna odpowiedź<br>
                    <input type="text" class="pole" name="pop_odp" placeholder="Czerwonego"/><br>
                Druga odpowiedź<br>
                    <input type="text" class="pole" name="druga_odp" placeholder="Słoń"/><br>
                Imię<br>
                    <input type="text" class="pole" name="imie" placeholder="Staszek"/><br><br>
                    <input type="submit" id="button" value="Wyślij">
                </form>
            </div>
            <div class="chapter" id="kontakt">
            KONTAKT<br><br><br>
            kontakt@toczyto.pl<br><br>
            facebook.com/toczyto<br><br>
            
            </div>
        <div id="footer">
            Wszelkie prawa zastrzeżone &copy 2017
        </div>
    </div>
</body>
</html>