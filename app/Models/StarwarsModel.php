<?php namespace App\Models;

use CodeIgniter\Model;
use SWAPI\SWAPI;

session_start();
class StarwarsModel extends Model
{
    public function getStarWarsCharacters($index)
    {
        $swapi = new SWAPI;
        // initialise array to read API
        $charDataArray = array();

        // Get all characters from API and store in the session data
        if(!isset($_SESSION['characterData']))
        {
            do {
                if (!isset($characters)) {
                    $characters = $swapi->characters()->index();
                } else {
                    // The getNext, getPrevious of Collection indicate whether more pages follow
                    $characters = $characters->getNext();
                }
            
                foreach ($characters as $character) 
                {
                    array_push($charDataArray, $character);
                }
            } while ($characters->hasNext());
            $_SESSION['characterData']=$charDataArray;
        }
        // initialise return data array
        $charArray = array();
        // iterate between the multiples of 9 corresponding to $index
        for ($iterator = 9*($index-1); $iterator < 9*$index; $iterator++ )
        {
            if(isset($_SESSION['characterData'][$iterator]))
            {
                array_push($charArray, $_SESSION['characterData'][$iterator]);
            }
            else
            {
                // no more data present in the session data so end for loop
                break;
            }
        }
        return $charArray;
    }
}
