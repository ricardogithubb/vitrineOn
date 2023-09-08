<?php

   include 'conexao.php';
   
   $usuario_id = $_POST['usuario_id'];

   $matriz = array();

   $data = date("d-m-Y");

   $sql = "Select date_format(va.data_play,\"%d-%m-%Y\") data,
                  Sum(v.valor_unit) valor_unit,
                  case when va.creditado = 'N' then 'Pendente' else date_format(va.data_play,\"%d-%m-%y\") end data_credito 
                from videos_assistidos va
                  inner join videos v 
                     on va.video_id = v.video_id and va.usuario_id = {$usuario_id}
                group by date_format(va.data_play,\"%d-%m-%Y\")
                    , va.creditado
                order by va.data_play desc";

   
   $result = mysqli_query($con,$sql);

   $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

   $matriz['registros'] = $rows;

   echo json_encode($matriz);


?>