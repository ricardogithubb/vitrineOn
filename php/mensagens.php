<?php

    include 'conexao.php';

    $acao    = $_POST['acao'];
    
    $matriz = array();

    function matriz($con,$userId){

        $sql  = "Select * From mensagens where usuario_id = {$userId} and excluida = 0 order by 1 desc";
    
        $result = mysqli_query($con,$sql);
    
        $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
        $matriz['mensagem'] = $rows;
    
        // $sql  = "Select * From mensagens where usuario_id = {$userId} and visualizada = 1 and excluida = 0 order by 1 desc";
    
        // $result = mysqli_query($con,$sql);
    
        // $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
        // $matriz['msg_acessada'] = $rows;
    
        echo json_encode($matriz);

    }


    if ($acao == 'Listar') {

        $userId    = $_POST['userId'];

        matriz($con,$userId);
    
        
    } elseif ($acao == 'Ler'){

        $msgId    = $_POST['msgId'];

        $sql  = "Update mensagens set visualizada = 1 where mensagem_id = {$msgId}";

        $result = mysqli_query($con,$sql);

        if ($result) {
            echo 1;
        } else {
            echo -1;
        }


    } elseif ($acao == 'Lixo'){

        $msgId    = $_POST['msgId'];

        $sql  = "Update mensagens set excluida = 1 where mensagem_id = {$msgId}";

        $result = mysqli_query($con,$sql);

        if ($result) {
            echo 1;
        } else {
            echo -1;
        }

    }


?>