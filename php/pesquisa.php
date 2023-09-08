<?php

    include 'conexao.php';

    $titulo = $_POST['titulo'];

    $userId    = $_POST['userId'];

    $matriz = array();

    $sql  = "Select v.*,";
    $sql .= " (v.quant_visualizacao - ((select count(*) from videos_assistidos where video_id = v.video_id)+
               (select count(*) from videos_visualizados_tmp where video_id = v.video_id and usuario_id <> {$userId}))) saldo ";
    $sql .= "from videos v where titulo like '%".$titulo."%' and status = 1 order by titulo desc";

    $result = mysqli_query($con,$sql);

    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $matriz['videos'] = $rows;

    echo json_encode($matriz);


?>