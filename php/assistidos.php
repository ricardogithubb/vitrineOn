<?php

    //Testando
    include 'conexao.php';

    $userId    = $_POST['userId'];

    $matriz = array();

    $sql = "Select *
                From (select v.video_id,v.path,v.capa,v.titulo,v.valor_unit,
                            max(data_visualizacao) data_visualizacao,
                            (select count(*) from videos_visualizados where video_id = v.video_id) qtd_visualizacoes,
                            (v.quant_visualizacao - ((select count(*) from videos_assistidos where video_id = v.video_id)+
                            (select count(*) from videos_visualizados_tmp where video_id = v.video_id and usuario_id <> {$userId}))) saldo
                        from videos v
                            , videos_visualizados va
                        where va.video_id = v.video_id
                        group by v.video_id,v.path,v.capa,v.titulo,v.valor_unit) x
                order by x.qtd_visualizacoes desc,x.data_visualizacao desc LIMIT 30";

    $result = mysqli_query($con,$sql);

    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $matriz['videos'] = $rows;

    echo json_encode($matriz);

?>