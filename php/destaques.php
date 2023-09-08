<?php

    include 'conexao.php';

    $qtd = $_POST['qtd'];
    $userId    = $_POST['userId'];

    $matriz = array();

    $sql = "Select *
                From (select v.video_id,v.path,v.capa,v.titulo,v.valor_unit,
                            max(data_visualizacao) data_visualizacao,
                            count(*) vizualizacoes,
                            (v.quant_visualizacao - ((select count(*) from videos_assistidos where video_id = v.video_id)+
                            (select count(*) from videos_visualizados_tmp where video_id = v.video_id and usuario_id <> {$userId}))) saldo    
                        from videos v
                            , videos_visualizados va
                        where va.video_id = v.video_id
                        group by v.video_id,v.path,v.capa,v.titulo,v.valor_unit) x
                order by x.saldo desc,x.valor_unit desc,x.vizualizacoes desc
            limit 6";

    $result = mysqli_query($con,$sql);

    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $matriz['videos'] = $rows;

    echo json_encode($matriz);

?>