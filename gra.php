<?php
session_start();

if(!isset($_SESSION['nr']))
{
   $_SESSION['pierwsze'] = true;
   header ("Location: sprawdz_i_wylosuj_nowy_nr.php");
}
else
{
    $nr = $_SESSION['nr'];
    $tresc = $_SESSION['tresc'];
    $odpa = $_SESSION['odpa'];
    $odpb = $_SESSION['odpb'];
    $odppop = $_SESSION['odppop'];

    $punkty = $_SESSION['punkty'];
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
            To czy To?
        </div>
        <div id="menu">
        <a href="gra.php"><div class="option">Graj!</div></a>
        <a href="index.html#jakgrac"><div class="option">Jak grać?</div></a>
        <a href="index.html#oprojekcie"><div class="option">O projekcie</div></a>
        <a href="index.html#dodajpytanie"><div class="option">Dodaj pytanie!</div></a>
        <a href="index.html#kontakt"><div class="option">Kontakt</div></a>
        <div style="clear: both;"></div>
        </div>
        <div id="content">
            <div class="statystyki"><?php echo $punkty; ?></div>
            <div class="statystyki">08:00</div>
            <div class="statystyki" style="color: firebrick;">♥♥♥</div>
            <div style="clear:both;"></div>
            <div id="pytanie" <?php
                    if(isset($_SESSION['graj'])) echo 'style="border: 3px solid red;"';
                                ?>><?php echo $tresc; ?>
            </div>
        <form action="sprawdz_i_wylosuj_nowy_nr.php" method="post">
            <input type="submit" name="a" class="odp" 
                <?php if(isset($_SESSION['graj'])) echo 'style="border: 2px solid red;"'; ?> 
                   value="<?php 
                          if(isset($_SESSION['graj']))
                          {
                            $odpa = $_SESSION['graj'];
                            unset($_SESSION['graj']);
                          }echo $odpa; ?>"
            >
            <div id="czy">czy</div>
            <input type="submit" name="b" class="odp"
            <?php if(isset($_SESSION['dodaj'])) echo 'style="border: 3px solid red;"'; ?> 
            value="<?php
                   if(isset($_SESSION['dodaj']))
                   {
                       $odpb = $_SESSION['dodaj'];
                       unset($_SESSION['dodaj']);
                   }echo $odpb; ?>">
        </form>
            <div style="clear: both;"></div>
        </div>
        <div id="footer">
            Wszelkie prawa zastrzeżone &copy 2017
        </div>
    </div>
</body>
</html>
<?php

unset($_SESSION['nr']);
unset($_SESSION['tresc']);
unset($_SESSION['odpa']);
unset($_SESSION['odpb']);
unset($_SESSION['odppop']);

?>