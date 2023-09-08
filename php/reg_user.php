<?php

    include 'conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $user = mysqli_query($con, "SELECT * FROM usuarios where email = '{$email}'");

    if(mysqli_num_rows($user) == 0){

        $sql = "Insert into usuarios (nome,email,senha) values('{$nome}','{$email}','{$senha}')";
    
        $result = mysqli_query($con,$sql);
    
        if($result){
            echo 1;
        } else {
            echo -1;
        }

    } else {
        echo 0;
    }

    mysqli_close($con);    

?>