<?php
    namespace DAO;


    class ImageDAO implements IImageDAO
    {        
        public function Add($file)
        {
            try
            {
      
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
                $error =  $file["error"];               
                $filePath = UPLOADS_PATH.basename($fileName);            
                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                var_dump($type);


                if($error){
                    $message = "Ha ocurrido un error";
                    return $message;

                }
                else if($type != "image/jpg" && $type != "image/png" && $type != "image/gif" && $type != "image/jpeg" && $type != "image/jpg"){
                    $message = "Tipo de archivo no permitido, por favor seleccione un jpg/png/gif";
                    echo("la quede");
                    return $message;
                }
                else{
                    echo("lo subi");
                    move_uploaded_file($tempFileName, $filePath);
                }
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }

            return "ok";

        }   
    }
?>