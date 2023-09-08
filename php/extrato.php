<?php

   include 'conexao.php';
   
   $usuario_id = $_POST['usuario_id'];
   $mes = $_POST['mes'];
   $ano = $_POST['ano'];

   $matriz = array();

   $data = date("d-m-Y");

   $sql = "select *
               from (Select date_format(va.data_play,'%d/%m') data,
                           Sum(v.valor_unit) total,
                           'Credito' tipo
                        from videos_assistidos va
                           , videos v
                        where v.video_id = va.video_id
                        and va.usuario_id = {$usuario_id}
                        and date_format(va.data_play,'%m') = {$mes}
                        and date_format(va.data_play,'%Y') = {$ano}
                     group by date_format(va.data_play,'%d/%m')
                     union all
                     Select date_format(va.data_faturamento,'%d/%m') data,
                           Sum(v.valor_unit) total,
                           'Debito' tipo
                        from videos_assistidos va
                           , videos v
                        where v.video_id = va.video_id
                        and va.creditado = 'S'
                        and va.usuario_id = {$usuario_id}
                        and date_format(va.data_play,'%m') = {$mes}
                        and date_format(va.data_play,'%Y') = {$ano}
                     group by date_format(va.data_faturamento,'%d/%m')) x
                  order by x.data desc,x.tipo";
   
   // echo $sql;
   $result = mysqli_query($con,$sql);

   $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

   $matriz['registros'] = $rows;

   echo json_encode($matriz);


?>