<?php

   include 'conexao.php';
   
   $usuario_id = $_POST['usuario_id'];

   $matriz = array();

   $data = date("d-m-Y");

   $sql = "Select * 
                from usuarios 
                  Where user_id = {$usuario_id}";
   
   $result = mysqli_query($con,$sql);

   $dados = mysqli_fetch_all($result,MYSQLI_ASSOC);


   $matriz['dados'] = $dados;
   

   $sql = "Select * 
                from estados";
   
   $result = mysqli_query($con,$sql);

   $estados = mysqli_fetch_all($result,MYSQLI_ASSOC);


   $matriz['estados'] = $estados;
   

   $sql = "Select * 
                from cidades";
   
   $result = mysqli_query($con,$sql);

   $cidades = mysqli_fetch_all($result,MYSQLI_ASSOC);


   $matriz['cidades'] = $cidades;
   

   $sql = "Select * 
                from bancos";
   
   $result = mysqli_query($con,$sql);

   $bancos = mysqli_fetch_all($result,MYSQLI_ASSOC);


   $matriz['bancos'] = $bancos;

   echo json_encode($matriz);


?>