<?php

   include 'conexao.php';
   
   $video_id = $_POST['video_id'];
   $usuario_id = $_POST['usuario_id'];

   $matriz = array();

   $data = date("d-m-Y");

   $sql = "Select v.*,case when va.video_detalhe_id is null then 'N' else 'S' end assistido,
                  (Select count(*) from videos_visualizados where video_id = v.video_id) visualizacoes,
                  (select count(*) from videos_assistidos where video_id = v.video_id) faturado,
                  (select count(*) from videos_visualizados_tmp where video_id = v.video_id) reservado,
                  (v.quant_visualizacao - ((select count(*) from videos_assistidos where video_id = v.video_id)+
                   (select count(*) from videos_visualizados_tmp where video_id = v.video_id and usuario_id <> {$usuario_id}))) saldo 
              from videos v 
                  left join videos_assistidos va 
                on v.video_id = va.video_id 
               and date_format(va.data_play,\"%d-%m-%Y\")  = '{$data}'
               and va.usuario_id = {$usuario_id}
            where v.video_id = ".$video_id;

   $result = mysqli_query($con,$sql);

   $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

   $matriz['videos'] = $rows;

   echo json_encode($matriz);


?>