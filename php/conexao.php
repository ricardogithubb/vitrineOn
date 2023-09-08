<?php
    
    $base = 'uolhost';

    if($base == 'uolhost'){
    
        header("Access-Control-Allow-Origin: *");
            
        $url = "vitrineon.mysql.uhserver.com";
        $user = "vitrineon";
        $senha = "rick8000@";
        $bd = "vitrineon";

    } else {        
           
        $url = "localhost";
        $user = "root";
        $senha = "";
        $bd = "vitrineon";

    }

    $con = mysqli_connect($url, $user, $senha, $bd);   
    
    if (!$con){
        echo '-1';
    }

    mysqli_query($con,"SET NAMES 'utf8'");
	mysqli_query($con,'SET character_set_connection=utf8');
	mysqli_query($con,'SET character_set_client=utf8');
	mysqli_query($con,'SET character_set_results=utf8');

?>