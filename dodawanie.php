<?php
session_start();
if(isset($_POST['pytanie']))
{   
    $ok=true;
    if((!isset($_POST['pytanie'])) || (!isset($_POST['pop_odp'])) || (!isset($_POST['druga_odp'])) || (!isset($_POST['imie'])) || (!isset($_POST['email'])))
        $ok=false;
    
    if($ok==true)
    {
        $tresc = $_POST['pytanie'];
        $odppop = $_POST['pop_odp'];
        $druga_odp = $_POST['druga_odp'];
        $imie = $_POST['imie'];

        $to = 'dodaj-pytanie@to-czy-to.pl';
        $email = $_POST['email'];
        $subject = 'Nowe pytanie od kochanego użytkownika';
        $message = 'Pytanie: '.$tresc.'\n Odpowiedź poprawna: '.$odppop.'\n Druga: '.$druga_odp.'\n\n\n'.$imie;
        $headers = 'From: '.$email.'\r\n'.'Reply-To'.$email.'\r\n'.'X-Mailer: PHP/'.phpversion();

        $subject_r = 'Dziękuję za pytanie!';
        $message_r = 'Dziękuję za pytanie kochany użytkowniku! :)';
        $headers_r = 'From: dodaj-pytanie@to-czy-to.pl'.'\r\n'.'Reply-To: kontakt@to-czy-to.pl.'.'\r\n'.'X-Mailer: PHP/'.phpversion();

        mail($to,$subject,$message,$headers);
        mail($email,$subject_r,$message_r,$headers_r);
        $_SESSION['dziekuje'] = '<span style="color: green; font-size: 35px; margin-left: 50px;">Dziękuję za pytanie :)</span>';
    }
    else
        $_SESSION['wypelnij'] = '<span style="color: white; font-size: 35px; margin-left: 50px;">Wypełnij wszystkie pola :(</span>';
    
    header("Location: index.php#dodajpytanie");
}

else
{
    $_SESSION['wypelnij'] = '<span style="color: white; font-size: 35px; margin-left: 50px;">Wypełnij wszystkie pola</span>';
    header("Location: index.php#dodajpytanie");
}



?>