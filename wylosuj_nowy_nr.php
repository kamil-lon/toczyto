<?php
session_start();

if(isset($_SESSION['pierwsze']))
{
    $_SESSION['tablica'] = array();
    $_SESSION['i']=0;
    $_SESSION['punkty'] = -1;
    unset($_SESSION['pierwsze']);
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
             $zapytanie = $polaczenie->query("SELECT idpytania FROM pytania ORDER BY idpytania DESC LIMIT 1");
             $rezultat = $zapytanie->fetch_assoc();
             $ile_pytan = $rezultat['idpytania'];
            do
            {
                $ready=true;
                $nr = rand(1,$ile_pytan);
                $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");
                if($zapytanie->num_rows<1) 
                    $ready=false;
                
                for($j=0; $j<$_SESSION['i']; $j++)
                {
                    if($nr==$_SESSION['tablica'][$j]) 
                        $ready=false;
                }
                
                if($_SESSION['i']==$ile_pytan-1)
                    $_SESSION['koniec'] = "KONIEC PYTAŃ - WYGRAŁEŚ!";
            }
            while($ready==false);
            $_SESSION['tablica'][$_SESSION['i']] = $nr;
            
            $zapytanie = $polaczenie->query("SELECT * FROM pytania WHERE idpytania=$nr");

                $rezultat = $zapytanie->fetch_assoc();
            
                $_SESSION['nr'] = $nr;
                $_SESSION['tresc'] = $rezultat['tresc'];
                $_SESSION['odpa'] = $rezultat['odpa'];
                $_SESSION['odpb'] = $rezultat['odpb'];
                $_SESSION['odppop'] = $rezultat['odppop'];
                $_SESSION['punkty']++;
                header ("Location: gra.php");
        }

    }

    catch(Expection $ex)
    {
        echo "ERROR ".$ex;
    }
?>