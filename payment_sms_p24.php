<?php 

// Odebranie informacji od Przelewy24, o wys�anym SMSie

$smsId = $_POST['p24_sms_id'];  // Unikalny ID dla ka�dego SMSa - zapobiega przyj�ciu wielokrotnie informacji o tym samym SMS
$tresc = $_POST['p24_info'];    // tre�� SMSa wys�ana przez Klienta
$tel   = $_POST['p24_telefon']; // numer telefonu Klienta
$kwota = $_POST['p24_kwota'];   // kwota SMSa w groszach - mo�liwe warto�ci: 122, 244, 366, 488, 610, 732, 1098, 2318, 3050
$smsc  = $_POST['p24_smsc'];    // numer SMS premium, na kt�ry zosta� wys�any SMS

// Sprawdzenie w lokalnej bazie, czy dane odebrane zgadzaj� si� 
// w szczeg�lno�ci KWOTA i TRE��



// Ewentualny zapis do bazy danych lokalnej informacji o tym SMSie i podj�cie odpowiednich dzia�a�



// Wys�anie odpowiedzi do Klienta na kom�rk� 
// UWAGA:  Przy wyslaniu wiadomosci do Klienta prosimy o NIE U�YWANIE polskich znak�w. 

echo "Twoje konto zostalo zasilone.";
exit;

?>