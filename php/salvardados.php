<?php

    include 'conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $datanasc = $_POST['datanasc'];
    $sexo = $_POST['sexo'];
    $cpf = $_POST['cpf'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $banco = $_POST['banco'];
    $tipoconta = $_POST['tipoconta'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];

    $sql = "Update usuarios set ";
    $sql .= "nome = '{$nome}',";
    $sql .= "data_nascimento = '{$datanasc}',";
    $sql .= "sexo = '{$sexo}',";
    $sql .= "cpf = '{$cpf}',";
    $sql .= "pais = '{$pais}',";
    $sql .= "estado = '{$estado}',";
    $sql .= "cidade = '{$cidade}',";
    $sql .= "banco = '{$banco}',";
    $sql .= "tipo_conta = '{$tipoconta}',";
    $sql .= "agencia = '{$agencia}',";
    $sql .= "conta = '{$conta}'";
    $sql .= " where email = '{$email}'";
    
    $result = mysqli_query($con,$sql);
    
    if($result){
        echo 1;
    } else {
        echo -1;
    }

    mysqli_close($con);    

?>