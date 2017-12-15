<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summation extends Model
{
    /*
     * Atributos de la clase
     */
    
    public $x;   //  Array de coordenadas en X
    public $y;   //  Array de coordenadas en Y
    public $z;   //  Array de coordenadas en Z
    
    public $T;   //  Numero de casos de prueba
    public $N;   //  Tamano del array 3-D
    public $M;   //  Numero de operaciones
    
    /*
     *  Constructor de la clase
     */
    public function __construct() {
        $this->x = array();
        $this->y = array();
        $this->z = array();
    }


    public function buildScenario($T, $T_options) {
        
        $this->T = $T;
        $this->N = $N;
        $this->M = $M;
        
    }

    
}
