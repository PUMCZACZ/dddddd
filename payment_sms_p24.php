<?php 

// Odebranie informacji od Przelewy24, o wys³anym SMSie

$smsId = $_POST['p24_sms_id'];  // Unikalny ID dla ka¿dego SMSa - zapobiega przyjêciu wielokrotnie informacji o tym samym SMS
$tresc = $_POST['p24_info'];    // treœæ SMSa wys³ana przez Klienta
$tel   = $_POST['p24_telefon']; // numer telefonu Klienta
$kwota = $_POST['p24_kwota'];   // kwota SMSa w groszach - mo¿liwe wartoœci: 122, 244, 366, 488, 610, 732, 1098, 2318, 3050
$smsc  = $_POST['p24_smsc'];    // numer SMS premium, na który zosta³ wys³any SMS

// Sprawdzenie w lokalnej bazie, czy dane odebrane zgadzaj¹ siê 
// w szczególnoœci KWOTA i TREŒÆ



// Ewentualny zapis do bazy danych lokalnej informacji o tym SMSie i podjêcie odpowiednich dzia³añ



// Wys³anie odpowiedzi do Klienta na komórkê 
// UWAGA:  Przy wyslaniu wiadomosci do Klienta prosimy o NIE U¯YWANIE polskich znaków. 

echo "Twoje konto zostalo zasilone.";
exit;

?>