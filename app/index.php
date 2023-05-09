<?php
    require_once('../config/configdb.php');
    require_once('consultas.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Formulario de consultas y actualizacion</title>
    </head>
    <body>
        <h2>Escriba una consulta select o de actualizacion y pulsa sobre el boton aceptar</h2>
        <form action="index.php" method="POST">
            <input type="text" name="input_consulta" id="consulta"><br><br>
            <input type="submit" name="btn" value="ACEPTAR">
        </form>

        <?php

            if(isset($_POST['btn']))
            {
                if(!empty($_POST['input_consulta']))
                {
                    $str0 = trim($_POST['input_consulta']);

                    $str = substr($str0, 0, 6); //Extrae caracteres de una cadena de caracteres
                    //echo($str.'<br>');

                    //$str = ltrim($str0);
                    //echo($str);
                    

                    if($str == 'SELECT')
                    {                    

                        try{



                                //En la variable $str se guarda los primeros carracteres de la consulta paravsaber qi etipo de consulta se esta haciendo 
                            //Con este dato preguntamos si empieza por uno o por otro que haga una cosa u otra, no controla que sea mayusculas o minusculas lo toma como cosas diferentes 
                            //echo('Es una consulta select');

                            $objeto_consulta = new Consultas(); //Instaciamo siun objeto de la clase Consultas

                            $consulta = $_POST['input_consulta']; //Guardamis la cinsulta que el usuario untroduce por teclado en una variable

                            $filas = $objeto_consulta->realizar_consulta_select($consulta); //Con el objeto llamamos a un metodo de la clase y le pasamos la consulta 

                            //if(!empty($objeto_consulta->error))
                            // {
                                    // echo('HAY UN ERROR EN LA CONSULTA');
                            // } 
                            //else{

                                echo('La consulta select se realizó con exito<br><br>');
                                echo('Las filas que ha devuelto esta consulta son: <b>'.$objeto_consulta->numfilas.'</b>.<br><br>'); //Escribimos un atributo de la clase mediante el objeto (Es propiedad del objeto) 
    
    
                                foreach($filas as $valores)
                                {
                                    foreach($valores as $valor)
                                    {
                                        echo('<span>'.$valor.'</span> &nbsp;&nbsp;&nbsp;&nbsp;');
                                    }
    
                                    echo('<br><br>');
                                }
    
                                //echo($objeto_consulta->numero_error);
    
                            // }  

                        }catch(Exception $e){
                            echo('Error con esta base de datos: '.$e->getMessage().'');
                        }
                              
                                                                    
                    }
                    else if($str == 'UPDATE' || $str == 'DELETE' || $str == 'INSERT')
                    {
                        try{

                            $objeto_update = new Consultas(); //Instaciamo siun objeto de la clase Consultas

                            $update = $_POST['input_consulta']; //Guardamis la cinsulta que el usuario untroduce por teclado en una variable

                            $rows = $objeto_update->modificacion($update); //rEALIZAMOS EL METODO DE LA CLASE 

                            echo('La consulta de actualizacion se realizó con exito<br><br>'); 
                            echo('<h2>Las filas afectadas por la consulta de modificacion son: <b>'.$objeto_update->filasafectadas.'</b></h2>'); //Mostramos el atributo filasafectadas de la clase Consultas 

                        }catch(Exception $e){
                            echo('Error con esta base de datos: '.$e->getMessage().'');
                        }
                        
                    }
                    else{
                        echo('<span id="rojo">ERROR DE SINTAXIS</span>');
                    }
                    
                }
                else{
                    echo('No ha rellenado la consulta');
                }
                
            }

        ?>


    </body>
</html>