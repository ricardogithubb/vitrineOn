<?php

        include 'conexao.php';

        $userId    = $_POST['userId'];
        $videoId   = $_POST['videoId'];

        $sql = "Delete From videos_visualizados_tmp where video_id = {$videoId} and usuario_id = {$userId}";

        $result = mysqli_query($con,$sql);

        $sql  = "insert into videos_visualizados_tmp (video_id,usuario_id)";
        $sql .= " values('{$videoId}','{$userId}')";

        $result = mysqli_query($con,$sql);
    
        if($result){
            echo 1;
        } else {
            echo -1;
        }


?>