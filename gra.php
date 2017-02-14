<?php

try
{
    $polaczenie = new mysqli('localhost','root','','toczyto');
    $polaczenie->query('SET NAMES utf8');
    $polaczenie->set_charset('UTF-8');
    if($polaczenie->connect_errno!=0)
    {
        throw new Expection(mysqli_connect_errno());
    }
    else
    {

            $zapytanie = $polaczenie->query("SELECT * FROM pytania");
            $ile_pytan = $zapytanie->num_rows;
                    $nr=rand(1,$ile_pytan);
            $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");
        if($zapytanie->num_rows<1)
        {
            while($zapytanie->num_rows<1)
            {
                $nr+=1;
                $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");
            }
        }
            $rezultat = $zapytanie->fetch_assoc();
            $tresc = $rezultat['tresc'];
            $odpa = $rezultat['odpa'];
            $odpb = $rezultat['odpb'];
            $odppop = $rezultat['odppop'];
    }
  
}

catch(Expection $ex)
{
    echo "ERROR ".$ex;
}
    

if(isset($_POST['a']))
{
    $odpowiedz = $_POST['a'];
    try
    {
        $polaczenie = new mysqli('localhost','root','','toczyto');
        $polaczenie->query('SET NAMES utf8');
        $polaczenie->set_charset('UTF-8');
        if($polaczenie->connect_errno!=0)
        {
            throw new Expection(mysqli_connect_errno());
        }
        else
        {
            $odppop = $polaczenie->query("SELECT odppop FROM pytania WHERE odpa='$odpowiedz'");
            $rezultat = $odppop->fetch_assoc();
            $odppop = $rezultat['odppop'];
            if($_POST['a']==$odppop)
                echo "Dobrze";
            else echo "Źle";
            unset($_POST['a']);
        }
    }
    catch(Expection $ex)
    {
        echo "ERROR ".$ex;
    }
}

if(isset($_POST['b']))
{
    $odpowiedz = $_POST['b'];
    try
    {
        $polaczenie = new mysqli('localhost','root','','toczyto');
        $polaczenie->query('SET NAMES utf8');
        $polaczenie->set_charset('UTF-8');
        if($polaczenie->connect_errno!=0)
        {
            throw new Expection(mysqli_connect_errno());
        }
        else
        {
            $odppop = $polaczenie->query("SELECT odppop FROM pytania WHERE odpb='$odpowiedz'");
            $rezultat = $odppop->fetch_assoc();
            $odppop = $rezultat['odppop'];
            if($_POST['b']==$odppop)
                echo "Dobrze";
            else echo "Źle";
            unset($_POST['b']);
        }
    }
    catch(Expection $ex)
    {
        echo "ERROR ".$ex;
    }
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
        <div class="option">Graj!</div>
        <a href="index.html#jakgrac"><div class="option">Jak grać?</div></a>
        <a href="index.html#oprojekcie"><div class="option">O projekcie</div></a>
        <a href="index.html#dodajpytanie"><div class="option">Dodaj pytanie!</div></a>
        <a href="index.html#kontakt"><div class="option">Kontakt</div></a>
        <div style="clear: both;"></div>
        </div>
        <div id="content">
            <div class="statystyki">0</div>
            <div class="statystyki">08:00</div>
            <div class="statystyki" style="color: firebrick;">♥♥♥</div>
            <div style="clear:both;"></div>
            <div id="pytanie"><?php echo $tresc; ?></div>
        <form action="gra.php" method="post">
            <input type="submit" name="a" class="odp" value="<?php echo $odpa; ?>">
            <div id="czy">czy</div>
            <input type="submit" name="b" class="odp" value="<?php echo $odpb; ?>">
        </form>
            <div style="clear: both;"></div>
        </div>
        <div id="footer">
            Wszelkie prawa zastrzeżone &copy 2017
        </div>
    </div>
</body>
</html>