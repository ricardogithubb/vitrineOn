<?php  session_start();
	   
	   require("../PHPMailer/src/PHPMailer.php");
	   require("../PHPMailer/src/SMTP.php");	   
	   require("../PHPMailer/src/Exception.php");

	   $mail = new PHPMailer\PHPMailer\PHPMailer();

	   $mail->IsSMTP(); 
       $mail->IsHTML(true);
       $mail->Port = 587 ; 
       $mail->Host       = "smtps.uhserver.com";
	   $mail->SMTPAuth = true; 
	   $mail->Username = 'vitrineondigital@apps-hibridos.online'; 
	   $mail->Password = 'Rick8040@'; 
	   $mail->SetFrom("vitrineondigital@apps-hibridos.online");
	   $mail->AddAddress('ricardoal.tim@gmail.com');
	//    $mail->AddAddress('musicaatendimento@gmail.com');
       
	   $emails = array("ricardoal.tim@gmail.com","ricardoal.tim@gmail.com");
	   $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);
	   
       $message = 'Vitrine On';
	   $mail->Subject = 'Vitrine On';
	   $mail->Body = $message;	

	   if(!$mail->Send()) {
			$result = "Erro ao enviar e-mail: " . $mail->ErrorInfo;
	   } else {
			$result = "Email enviado para: ".$result;
	   }

   

?>