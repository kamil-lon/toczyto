<?php
session_start();
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
                <span style="font-size: 70px;">LOSUJEMY PYTANIE SPOŚRÓD <?php echo $ile; ?> PYTAŃ Z BAZY,<br></span>
            WYBIERASZ JEDNĄ Z DWÓCH PODANYCH ODPOWIEDZI,<br>
            <span style="color: green; font-size: 70px;">WYBRAŁEŚ DOBRZE - PUNKT, <br></span>
                <span style="color: red; font-size: 70px;">WYBRAŁEŚ ŹLE - TRACISZ ♥<br></span>
            UTRATA DWÓCH ♥ LUB UPŁYW 8 SEKUND = KONIEC GRY<br><br>
            <a id="agraj" href="gra.php">GRAJ</a>
            </div>
            <div class="chapter" id="oprojekcie">
            Amatorska gra stworzona z zabawy dla zabawy, a nuż, może czegoś się nauczysz :p
                <br><span style="font-size: 40px;">Technologie użyte do stworzenia witryny<br>(od lewej wg poświęconego czasu malejąco):</span> <br>
                <div class="logo"><img src="loga/php.png" alt="php"></div>
                <div class="logo"><img src="loga/css.png" alt="php"></div>
                <div class="logo"><img src="loga/html.png" alt="php"></div>
                <div class="logo"><img src="loga/js.png" alt="php"></div>
                <div class="logo"><img src="loga/mysql.png" alt="php"></div>
                <div style="clear: both;"></div>
            </div>
            <div class="chapter" id="dodajpytanie">
            DODAJ PYTANIE<br>
                <form name="dodawanie" action="dodawanie.php" class="dodawanie" method="post">
                Treść pytania<br>
                    <textarea class="pole" name="pytanie" placeholder="Jakiego koloru jest czerwony maluch?"></textarea><br>
                Poprawna odpowiedź<br>
                    <input type="text" class="pole" name="pop_odp" placeholder="Czerwonego"/><br>
                Druga odpowiedź<br>
                    <input type="text" class="pole" name="druga_odp" placeholder="Słoń"/><br>
                E-mail
                    <input type="email" class="pole2" name="email" placeholder="jan-kowalski@xyz.pl"/>
                Imię
                    <input type="text" class="pole2" name="imie" placeholder="Jan"/><br><br>
                    <input type="submit" id="button" value="Wyślij">
                    <?php
                    if(isset($_SESSION['wypelnij']))
                    {
                        echo $_SESSION['wypelnij'];
                        unset($_SESSION['wypelnij']);
                    }
                    if(isset($_SESSION['dziekuje']))
                    {
                        echo $_SESSION['dziekuje'];
                        unset($_SESSION['dziekuje']);
                    }
                    ?>
                </form>
            </div>
            <div class="chapter" id="kontakt">
            <span style="font-size: 130px;"><br>kontakt@toczyto.pl<br><br></span>
            </div>
        <div id="footer">
            Wszelkie prawa zastrzeżone &copy 2017
        </div>
    </div>
</body>
</html>