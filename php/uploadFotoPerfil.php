<?php

   include 'conexao.php';

   require __DIR__."/../../vendor/autoload.php";

   use Spatie\Image\Image;

   $id = $_POST['userId'];

   $dir = '../perfil/';    

   if(!is_dir($dir)){

   	    mkdir($dir);
        mkdir($dir.$id.'/');

   } else {

        if(!is_dir($dir.$id.'/')){
            mkdir($dir.$id.'/');
        }
    
   }
   

   if(isset($_FILES['fileUpload'])){

        try {

            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
        
            $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo

            $new_name = 'foto_'.$id.$ext;

            move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$id.'/'.$new_name); //Fazer upload do arquivo
            
            $pathToImage = $dir.$id.'/'.$new_name;
            
            try {
               Image::load($pathToImage)
                    ->height(125)
                    ->save($dir.$id.'/'.$new_name);
                    
               echo 'perfil/'.$id.'/'.$new_name;

            } catch (\Throwable $th) {
               echo 'perfil/'.$id.'/'.$new_name;
               sleep(3);
            }

            

            sleep(3);
            

        } catch (\Throwable $th) {
            
            echo 'perfil/default/profile.png';

        }        

   } else {
    
        echo 'perfil/default/profile.png';

   }

?>