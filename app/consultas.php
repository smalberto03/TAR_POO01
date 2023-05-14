<?php
    class Consultas{

        //$consulta = 'SELECT * FROM jesuita';

        //Aqui creo el atributo de la clase num_filas
        public $numfilas;

        public $filasafectadas;

        //public $error;


        public function realizar_consulta_select($consulta)
        {
            $connect  = new Conexion(); //$connect es un objeto de de la clase Conexion (estamos instaciando el objeto) 
            
            $conexion1 = $connect->conectar();

            $datos = $conexion1->query($consulta); // or die('Hay un error con la consulta para esta base de datos'); //resultado


            $this->numfilas = $datos->num_rows;//Guardar informacion en el atributo num_filas

            //$this->error = mysqli_error($conexion1);


            if(!isset($datos))
            {
                return throw new Exception('Hay un error en su consulta');
            }
            else{
                return mysqli_fetch_all($datos, MYSQLI_ASSOC); //Verdadero o falso en una condiucon. tambien devuelve filas
            }                      
            
        }

        public function modificacion($update)
        {
            $connect  = new Conexion(); //$connect es un objeto de de la clase Conexion (estamos instaciando el objeto) 
            
            $conexion1 = $connect->conectar();

            //$datos = 
            $conexion1->query($update); //resultadoç

            $this->filasafectadas = $conexion1->affected_rows;
            //$this->filasafectadas = $connect->affected_rows;

            //return $this->filasafectadas; //No se devuelbe las filas afectadas 

        }

        /*public function realizar_update($consulta);
        {
            
        }*/

    }

?>