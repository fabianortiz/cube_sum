<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summation extends Model
{
    /*
     * Atributos de la clase
     */
    
    public $input_str;
    public $response_str;
    
    /*
     *  Constructor de la clase
     */
    public function __construct() 
    {
        $this->input_str = "";
        $this->response_str = "";
    }

    public function getResponseStr()
    {
        return $this->response_str;
    }
    
    public function getInputStr()
    {
        return $this->input_str;
    }

    /*
     * Metodo que procesa el input text para realizar las sumas
     */
    public function makeSummation($input_data) 
    {
        $this->input_str = $input_data;
        $response = "";
        
        //  1.  Convert input to array 
        $arr_rows = $this->_convertInputToArray($input_data);
        //dd($arr_rows);
        
        //  2.  Get test cases number from input array
        $T = $this->_getTestCases($arr_rows);
        
        if(!$T)
        {
            $this->response_str = "Error: The first line must contains a number between 1 and 50.";
            return false;
        }
        
        //  3.  Process Test Cases
        $next_case_i = 1;
        $test_case_counter = 1;
        $arr_test_cases = array();
        
        while($test_case_counter <= $T)
        {
            if(!array_key_exists($next_case_i, $arr_rows))
            {
                $this->response_str = "Error: Faltan Casos de Prueba ($T definidos)";
                return false;
            }
            
            $response .= "<h3>Test Case $test_case_counter</h3>";
            $n_m = explode(" ", $arr_rows[$next_case_i]);

            //  Validate 'N M' format for each test case
            if(count($n_m) != 2)
            {
                $this->response_str = "Error Test Case #$test_case_counter: Los par&ametros del caso de prueba no cumplen con el formato 'N M'";
                return false;
                
            }
            //  Validate if 1 <= N <= 100 
            elseif(!is_numeric($n_m[0]) || !($n_m[0] >= 1 && $n_m[0] <= 100)) 
            {
                $this->response_str = "Error Test Case #$test_case_counter: N debe ser un numero entre 1 y 100";
                return false;
            }
            //  Validate if 1 <= M <= 1000
            elseif(!is_numeric($n_m[1]) || !($n_m[1] >= 1 && $n_m[1] <= 100)) 
            {
                $this->response_str = "Error Test Case #$test_case_counter: M debe ser un numero entre 1 y 1000";
                return false;
            }
            else
            {
                $N = $n_m[0];   //  Array size
                $M = $n_m[1];   //  Number of operations
                
                $response .= "<b>Matrix Size:</b> $N <b> &nbsp; Operations:</b> $M<br/>";
                
                $matrix_3d = $this->_create3DArray($N);  //  3D Matrix
                
                //  Validating operations
                $j = $next_case_i+1;
                $arr_case_operations = array();

                while($j <= $next_case_i+$M)
                {   
                    if(!array_key_exists($j, $arr_rows))
                    {
                        $this->response_str = "Error Test Case #$test_case_counter: Faltan operaciones ($M definidas)";
                        return false;
                    }
                    $operacion = explode(" ",$arr_rows[$j]);
                    $summation = 0;
                    
                    if(count($operacion) < 1){
                        $this->response_str = "Error Test Case #$test_case_counter: No es posible determinar la operacion";
                        return false;
                    }

                    //  Validate Case UPDATE
                    if(strtoupper($operacion[0]) == "UPDATE")
                    {
                        if(count($operacion) != 5){
                            $this->response_str = "Error Test Case #$test_case_counter: La operacion UPDATE debe tener exactamete 4 par&aacute;metros";
                            return false;
                        }

                        if((!is_numeric($operacion[1]) || !($operacion[1] >= 1 && $operacion[1] <= $N)) ||
                           (!is_numeric($operacion[2]) || !($operacion[2] >= 1 && $operacion[2] <= $N)) ||
                           (!is_numeric($operacion[3]) || !($operacion[3] >= 1 && $operacion[3] <= $N)) ||
                           (!is_numeric($operacion[4]) || !($operacion[4] >= -1000000000 && $operacion[4] <= 1000000000)))

                        {
                            $this->response_str = "Error Test Case #$test_case_counter: Par&aacute;metros de UPDATE incorrectos";
                            return false;
                        }

                        $x = $operacion[1];
                        $y = $operacion[2];
                        $z = $operacion[3];
                        $W = $operacion[4];
                        
                        //  Update the matrix with W
                        $matrix_3d[0][$x-1] = $W;
                        $matrix_3d[1][$y-1] = $W;
                        $matrix_3d[2][$z-1] = $W;
                        
                    }
                    //  Validate Case QUERY
                    elseif(strtoupper($operacion[0]) == "QUERY")
                    {
                        if(count($operacion) != 7){
                            $this->response_str = "Error Test Case #$test_case_counter: La operacion QUERY debe tener exactamete 6 par&aacute;metros";
                            return false;
                        }

                        if((!is_numeric($operacion[1]) || !($operacion[1] >= 1 && $operacion[1] <= $N)) ||
                           (!is_numeric($operacion[2]) || !($operacion[2] >= 1 && $operacion[2] <= $N)) ||
                           (!is_numeric($operacion[3]) || !($operacion[3] >= 1 && $operacion[3] <= $N)) ||
                           (!is_numeric($operacion[4]) || !($operacion[4] >= 1 && $operacion[4] <= $N)) ||
                           (!is_numeric($operacion[5]) || !($operacion[5] >= 1 && $operacion[5] <= $N)) ||
                           (!is_numeric($operacion[6]) || !($operacion[6] >= 1 && $operacion[6] <= $N)) )

                        {
                            $this->response_str = "Error Test Case #$test_case_counter: Par&aacute;metros de QUERY incorrectos";
                            return false;
                        }

                        $tipo_operacion = $operacion[0];
                        $x1 = $operacion[1];
                        $y1 = $operacion[2];
                        $z1 = $operacion[3];
                        $x2 = $operacion[4];
                        $y2 = $operacion[5];
                        $z2 = $operacion[6];
                        
                        $init_i = $x1-1;
                        $end_i = $x2-1;
                        
                        //  Getting values from X
                        for($i=$init_i;$i<=$end_i;$i++) 
                        {
                            $summation += $matrix_3d[0][$i];
                        }
                        
                        $response .= "$summation<br>";

                    }
                    //  Invalid Operation
                    else
                    {
                        $this->response_str = "Error Test Case #$test_case_counter: Operaci&oacute;n no v&aacute;lida: '".strtoupper($operacion[0]."'");
                        return false;
                    }
                    $j++;
                }
                
                // Increment the Test Case Index
                $next_case_i += $M+1;
            }
            
            // Increment the Test Case Counter
            $test_case_counter++;
        }
        
        $this->response_str = $response;
        return true;
        
    }
        
       
    
    /*
     * PRIVATE METHODS
     */
    
    private function _convertInputToArray($data){
        
        //  Removing "\r" from textarea input
        $data = str_replace("\r\n","\n",$data);

        //   Extracting input rows
        $arr_rows = explode(PHP_EOL, $data);
        return $arr_rows;
        
    }
    
    private function _getTestCases($arr_rows){
    
        //   Validating minimum number of rows (3: T, N M, UPDATE/QUERY)
        if(count($arr_rows) < 3)
        {
            $this->response_str = "Error: La entrada debe indicar como m&iacute;nimo 3 l&iacute;neas.";
            return false;
        }   

        $T = trim($arr_rows[0]);    // Number of test Cases

        //  Validate if T is a number between 1 and 50
        if (!is_numeric($T) || !($T >= 1 && $T <= 50)) 
        {
            $this->response_str = "Error: La primera l&iacute;nea debe ser u n&uacute;mero entre 1 y 50.";
            return false;
        }
        
        return $T;
        
    }
    
    private function _create3DArray($N)
    {
        $x = array();
        $y = array();
        $z = array();
        
        for($i=0;$i<$N;$i++)
        {
            array_push($x, 0);
            array_push($y, 0);
            array_push($z, 0);
        }
        
        $array_3d = array($x,$y,$z);
        return $array_3d;
    }
        
}
