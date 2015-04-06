<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
	// the code was incorrect
	// you should handle the error so that the form processor doesn't continue
	
	// or you can use the following code if there is no validation or you do not know how
	/*echo "The security code entered was incorrect.<br /><br />";
	echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	exit;*/
	$extra = "reservation_problem.html";
}
else {

	// L'INDIRIZZO DEL DESTINATARIO DELLA MAIL
	$to = "feriencasalavanda@gmail.com";
	
	// IL SOGGETTO DELLA MAIL
	$subject = "Reservation from casadilavanda.com";
	
	$name = trim(stripslashes($_POST["name"]));
	$surname = trim(stripslashes($_POST["surname"]));
	$email = trim(stripslashes($_POST["email"]));
	
	// COSTRUZIONE DEL CORPO DEL MESSAGGIO
	$body = "New Reservation Request from casadilavanda.com; \n";
	$body .= "Name: " . $name . "\n";
	$body .= "Surname: " . $surname . "\n";
	$body .= "City: " . trim(stripslashes($_POST["city"])) . "\n";
	$body .= "Country: " . trim(stripslashes($_POST["country"])) . "\n";
	$body .= "State: " . trim(stripslashes($_POST["state"])) . "\n";
	$body .= "Telephone: " . trim(stripslashes($_POST["telephone"])) . "\n";
	$body .= "E-Mail: " . $email . "\n";
	$body .= "Arrival on: " . trim(stripslashes($_POST["arrival"])) . "\n";
	$body .= "Departure on: " . trim(stripslashes($_POST["departure"])) . "\n";
	$body .= "Number of night(s): " . trim(stripslashes($_POST["numnights"])) . "\n";
	$body .= "Number of person(s): " . trim(stripslashes($_POST["numpersons"])) . "\n";
	$body .= "Number of children: " . trim(stripslashes($_POST["numchildren"])) . "\n";
	$body .= "Message: " . trim(stripslashes($_POST["message"])) . "\n";
	
	// INTESTAZIONI SUPPLEMENTARI
	$headers = "From: " . $name . " " . $urname . " <" . $email . ">";
	
	// INVIO DELLA MAIL
	if(@mail($to, $subject, $body, $headers)) { // SE L'INOLTRO E' ANDATO A BUON FINE...
	
		//echo "La mail &egrave; stata inoltrata con successo.";
		$extra = "reservation_ok.html";
	
	} else {// ALTRIMENTI...
	
		//echo "Si sono verificati dei problemi nell'invio della mail.";
		$extra = "reservation_problem.html";
	}
}

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//$extra = 'mypage.php';
header("Location: http://$host$uri/$extra");
exit;
?>