<?php

        include 'conexao.php';

        $userId    = $_POST['userId'];
        $videoId   = $_POST['videoId'];

        $sql  = "insert into videos_visualizados (video_id,usuario_id)";
        $sql .= " values('{$videoId}','{$userId}')";

        $result = mysqli_query($con,$sql);
    
        if($result){
            echo 1;
        } else {
            echo -1;
        }


?>