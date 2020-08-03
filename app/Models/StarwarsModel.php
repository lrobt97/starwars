<?php namespace App\Models;

use CodeIgniter\Model;
use SWAPI\SWAPI;
class StarwarsModel extends Model
{
    public function getStarWarsCharacters($index){
        $swapi = new SWAPI;
        return $swapi->characters()->index($index);
    }
}