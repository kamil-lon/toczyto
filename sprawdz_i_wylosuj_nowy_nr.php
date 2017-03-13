<?php
session_start();
function wylosuj()
{
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

             $zapytanie = $polaczenie->query("SELECT idpytania FROM pytania ORDER BY idpytania DESC LIMIT 1");
             $rezultat = $zapytanie->fetch_assoc();
             $ile_pytan = $rezultat['idpytania'];
            do
            {
                $ready=true;
                $nr = rand(1,$ile_pytan);
                $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");
                if($zapytanie->num_rows<1) $ready=false;
                
                for($j=0; $j<$_SESSION['i']; $j++)
                {
                    if($nr==$_SESSION['tablica'][$j]) 
                        $ready=false;
                }
                
                if($_SESSION['i']==$ile_pytan-1)
                {
                    $_SESSION['koniec'] = "KONIEC PYTAŃ - WYGRAŁEŚ!";
                    header ("Location: gra.php");
                    unset($_SESSION['tablica']);
                    unset($_SESSION['i']);
                    unset($_SESSION['wynik']);
                    //exit();
                }
            }
            while($ready==false);
            
            $_SESSION['tablica'][$_SESSION['i']] = $nr;
            $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");

                $rezultat = $zapytanie->fetch_assoc();
            
                $_SESSION['nr'] = $nr;
            
                $_SESSION['tresc'] = $rezultat['tresc'];
                    if(isset($_SESSION['koniec']))
                    {
                        $_SESSION['tresc'] = $_SESSION['koniec'];
                        $_SESSION['graj'] = 'od nowa';
                        $_SESSION['dodaj'] = 'dodaj pytanie';
                        unset($_SESSION['koniec']);
                    }
            
                    if(isset($_SESSION['przegrales']))
                    {
                        $_SESSION['tresc'] = $_SESSION['przegrales'];
                        unset($_SESSION['przegrales']);
                    }
            
                $_SESSION['odpa'] = $rezultat['odpa'];
            
                $_SESSION['odpb'] = $rezultat['odpb'];
        
                $_SESSION['odppop'] = $rezultat['odppop'];
									usleep(300000);
                header ("Location: gra.php");
        }

    }

    catch(Expection $ex)
    {
        echo "ERROR ".$ex;
    }
}
//------------------------------------------------------------

if(isset($_SESSION['pierwsze']))
{
    $_SESSION['tablica'] = array();
    $_SESSION['i']=0;
    $_SESSION['punkty'] = 0;
    $_SESSION['zycia'] = 2;
    wylosuj();
    unset($_SESSION['pierwsze']);
}

 //---------------------------------------------------------------   
    
if(isset($_POST['a']))
{
    $odpowiedz = $_POST['a'];
    if($odpowiedz=='od nowa')
    {
        header("Location: gra.php");
        exit();
    }
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
            if($odpowiedz==$odppop)
            {
                $_SESSION['punkty']++;
            }
            else 
            {
                $_SESSION['zycia']--;
                if($_SESSION['zycia']==0)
                {
                    $_SESSION['przegrales'] = "UPS, POMYŁKA.. KONIEC GRY";
                    $_SESSION['graj'] = 'od nowa';
                    $_SESSION['dodaj'] = 'dodaj pytanie';
                }
            }
            $_SESSION['i']++;
            unset($_POST['a']);
            wylosuj();
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
    if($odpowiedz=='dodaj pytanie')
    {
        header("Location: index.php#dodajpytanie");
        exit();
    }
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
            if($odpowiedz==$odppop)
            {
                $_SESSION['punkty']++;
            }
            else 
            {
                $_SESSION['zycia']--;
                if($_SESSION['zycia']==0)
                {
                    $_SESSION['przegrales'] = "UPS, POMYŁKA.. KONIEC GRY";
                    $_SESSION['graj'] = 'od nowa';
                    $_SESSION['dodaj'] = 'dodaj pytanie';
                }
            }
            $_SESSION['i']++;
            unset($_POST['b']);
            wylosuj();
        }
    }
    catch(Expection $ex)
    {
        echo "ERROR ".$ex;
    }
}
?>