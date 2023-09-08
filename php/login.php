<?php

include 'conexao.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);    

$user = mysqli_query($con, "SELECT user_id,nome FROM usuarios where email = '{$email}' and senha = '{$senha}'");

if(mysqli_num_rows($user) == 1){

    $res = mysqli_fetch_row($user);

    $dir = '../perfil/';    

   if(!is_file($dir.$res[0].'/foto_'.$res[0].'.png')){

        echo $res[0].'|'.$res[1].'|perfil/default/profile.png';

   } else {

        echo $res[0].'|'.$res[1].'|perfil/'.$res[0].'/foto_'.$res[0].'.png';
    
   }
    

} else {
    echo '-1|Usuario não cadastrado';
}


?>