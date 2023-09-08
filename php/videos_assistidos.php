<?php

        include 'conexao.php';

        $userId    = $_POST['userId'];
        $videoId   = $_POST['videoId'];
        $avaliacao = $_POST['avaliacao'];

        $sql = "select Count(*) completo
                    from usuarios 
                        where user_id = {$userId}
                          and length(data_nascimento) > 0
                          and length(sexo) > 0
                          and length(cpf) > 0
                          and length(pais) > 0
                          and length(estado) > 0
                          and length(cidade) > 0
                          and length(banco) > 0
                          and length(tipo_conta) > 0
                          and length(agencia) > 0
                          and length(conta) > 0";
        
        $result = mysqli_query($con,$sql);

        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    

        $sql  = "Select count(*) visualizado,";
        $sql .= "(select quant_visualizacao from videos where video_id = {$videoId}) visualizacoes";
        $sql .= " from videos_assistidos s where video_id = {$videoId}";

        $result = mysqli_query($con,$sql);

        $reg = mysqli_fetch_array($result,MYSQLI_ASSOC);

        if($reg['visualizado']<$reg['visualizacoes']){

            if($user['completo'] == 1){

                $sql  = "insert into videos_assistidos (video_id,usuario_id,avaliacao)";
                $sql .= " values('{$videoId}','{$userId}','{$avaliacao}')";
    
                // echo $sql;
    
                $result = mysqli_query($con,$sql);
            
                if($result){
                    $sql = "Delete From videos_visualizados_tmp where video_id = {$videoId} and usuario_id = {$userId}";
                    $result = mysqli_query($con,$sql);
                    echo 1;
                } else {
                    echo -1;
                }

            } else {
                echo -2;
            }

        } else {
            echo 0; //Quantidade de visualização já alcançada
        }

        


?>