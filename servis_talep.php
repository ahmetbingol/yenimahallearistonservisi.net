<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<meta http-equiv="Refresh" content="5;URL=/iletisim.html" />


<?php

if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "namco_80@hotmail.com";
	
	$email_subject = "Yenimahalle Başvuru";
	
	
	function died($error) {
		// your error code can go here
		echo "İletişim formun gödneremediniz lütfen aşşağıdaki hataları kontrol ediniz.<br /><br />";
		echo $error."<br /><br />";
		echo "<br /><br />";
		die();
	}
	
	// validation expected data exists
	if(!isset($_POST['first_name']) ||
		!isset($_POST['tel']) ||
		!isset($_POST['model']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['comments'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');		
	}
	
	$first_name = $_POST['first_name']; // required
	$tel = $_POST['tel']; // required
	$model = $_POST['model']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
  	$error_message .= 'Eposta hatalı.<br />';
  }
	$string_exp = "/^[A-Za-z .'-ığüşöç]+$/";
  if(!preg_match($string_exp,$first_name)) {
  	$error_message .= 'Adınız hatalı.<br />';
  }
  if(strlen($comments) < 2) {
  	$error_message .= 'Bilgileri kontrol ederek tekrar deneyin!<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$email_message = "Keçiören Başvuru.\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Adı Soyadı: ".clean_string($first_name)."\n";
	$email_message .= "Tel: ".clean_string($tel)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Model: ".clean_string($model)."\n";
	$email_message .= "Adres: ".clean_string($telephone)."\n";
	$email_message .= "Açıklama: ".clean_string($comments)."\n";
	
	
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>

<!-- place your own success html below -->

Mesajınız başarılı Bir şekilde iletilmiştir.
<?php
}
die();

?>


