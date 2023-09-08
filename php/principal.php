<?php

    include 'conexao.php';

    $userId    = $_POST['userId'];

    $data = date("d-m-Y");

    $matriz = array();

    $sql = "select * ";
    $sql .= " From (Select v.* ,";
    $sql .= " (select count(*) from videos_assistidos where video_id = v.video_id and usuario_id = {$userId}) visualizado,";
    $sql .= " (select if(count(*) = 0, 'N' , 'S') from videos_assistidos where video_id = v.video_id and usuario_id = {$userId} and date_format(data_play,\"%d-%m-%Y\")  = '{$data}') visualizado_hoje,";
    $sql .= " (select count(*) from videos_visualizados_tmp where video_id = v.video_id) reservado,";
    $sql .= " (v.quant_visualizacao - ((select count(*) from videos_assistidos where video_id = v.video_id)+
               (select count(*) from videos_visualizados_tmp where video_id = v.video_id and usuario_id <> {$userId}))) saldo ";
    $sql .= " from videos v where status = 1) x 
            order by x.visualizado_hoje,
                     x.saldo desc,
                     x.valor_unit desc,
                     x.visualizado,
                     x.video_id desc limit 15";

    $result = mysqli_query($con,$sql);

    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $matriz['videos'] = $rows;

    echo json_encode($matriz);

?>