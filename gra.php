
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
    
    if($_SESSION['zycia']==2)
        $zycia = '♥♥';
    if($_SESSION['zycia']==1)
        $zycia = '♥';
    if($_SESSION['zycia']==0)
        $zycia = 'END';
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
    <script type="text/javascript">
    function odliczanie()
        {
            var start = document.getElementById('zegar').innerHTML;
            var tresc = document.getElementById('pytanie').innerHTML.trim();
            if(tresc!='UPS, POMYŁKA.. KONIEC GRY')
            {
            if(start=='start')
                document.getElementById('zegar').innerHTML = 8;
            else
            {
                var sekunda = document.getElementById('zegar').innerHTML;
                sekunda--;
                if(sekunda>0)
                {
                    document.getElementById('zegar').innerHTML=sekunda;
                }
                else if(sekunda==0)
                {   
                    document.getElementById('zegar').innerHTML = '0';
                    
                    document.getElementById('odpa').value = 'od nowa';
                    document.getElementById('odpb').value = 'dodaj pytanie';
                    document.getElementById('pytanie').innerHTML = 'ups..koniec czasu';
                    
                    document.getElementById('odpa').style = 'border: 2px solid red;';
                    document.getElementById('odpb').style = 'border: 2px solid red;';
                    document.getElementById('pytanie').style = 'border: 2px solid red;';
                }
            }
            setTimeout("odliczanie()",1000);
            }
            else
                document.getElementById('zegar').innerHTML = 0;
        }
        
        
    function sprawdz(x)
    {
        var odpowiedz = document.getElementById(x).value;
        if(odpowiedz!='od nowa' && odpowiedz!='dodaj pytanie')
        {
        odpowiedz = odpowiedz.trim();
        var odppop = '<?php echo $odppop; ?>';
        odppop = odppop.trim();
        if(odpowiedz==odppop) 
        {
            document.getElementById(x).style = 'border: 2px solid green;';
            document.getElementById('punkty').style = 'color: green;';
        }
        else
            {
            document.getElementById(x).style = 'border: 2px solid red;';
            document.getElementById('zycia').style = 'color: red;;';
            }
        
        }
    }    
        
    function load()
    {
        odliczanie();
        document.getElementById('odpa').addEventListener("click",function(){sprawdz('odpa');},false);
        document.getElementById('odpb').addEventListener("click",function(){sprawdz('odpb');},false)
    }
        
    </script>
</head>

<body onload="load();">
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
            <div class="statystyki" id='punkty'><?php echo $punkty; ?></div>
            <div class="statystyki" id='zegar'>start</div>
            <div class="statystyki" style="color: firebrick;" id='zycia'><?php echo $zycia; ?></div>
            <div style="clear:both;"></div>
            <div id="pytanie" <?php
                    if(isset($_SESSION['graj'])) echo 'style="border: 3px solid red;"';
                                ?>><?php echo $tresc; ?>
            </div>
        <form action="sprawdz_i_wylosuj_nowy_nr.php" method="post">
            <input type="submit" name="a" class="odp" id="odpa" 
                <?php if(isset($_SESSION['graj'])) echo 'style="border: 2px solid red;"'; ?> 
                   value="<?php 
                          if(isset($_SESSION['graj']))
                          {
                            $odpa = $_SESSION['graj'];
                            unset($_SESSION['graj']);
                          }echo $odpa; ?>"
            >
            <div id="czy">czy</div>
            <input type="submit" name="b" class="odp" id="odpb"
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