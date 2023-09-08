<?php

    include 'conexao.php';

    $min = 1000;
    $max = 9999;

    $email = $_POST['email'];
    $evento = $_POST['evento'];

    $user = mysqli_query($con, "SELECT * FROM usuarios where email = '{$email}'");

    if(mysqli_num_rows($user) == 1){

        if($evento == 'gerarCodigo'){

            $codigo = rand($min,$max);
            
            $sql = "update usuarios set codigo = {$codigo} where email = '{$email}'";

            $result = mysqli_query($con,$sql);
        
            if($result){
                enviar($codigo);
                // echo 'validarCodigo';
            } else {
                echo -1;
            }

        } elseif ($evento == 'validarCodigo') {
            
            $codigo = $_POST['codigo'];

            $confirma = mysqli_query($con, "SELECT * FROM usuarios where email = '{$email}' and codigo = {$codigo}");

            if(mysqli_num_rows($confirma) == 1){                
                echo 'alterarSenha';
            } else{
                echo -1; 
            }

        } elseif ($evento == 'alterarSenha') {

            $senha = md5($_POST['senha']);
            
            $sql = "update usuarios set senha = '{$senha}' where email = '{$email}'";

            $result = mysqli_query($con,$sql);
        
            if($result){
                echo 1;
            } else {
                echo -1;
            }

        }

        

    } else {
        echo 0;
    }



    function enviar($codigo){

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
        
        $message = 'Codigo: '.$codigo;
        $mail->Subject = 'Vitrine On';
        $mail->Body = $message;	
 
        if(!$mail->Send()) {
            echo 'erroGerarCodigo';
        } else {
            echo 'validarCodigo';
        }

    }

?>