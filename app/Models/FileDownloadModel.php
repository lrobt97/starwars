<?php namespace App\Models;

use CodeIgniter\Model;
use SWAPI\SWAPI;
use SWAPI\Model\Character;
class FileDownloadModel extends Model
{
    public function getRequestedData()
    {
        $swapi = new SWAPI;
        $charDataArray = array();
        $items = json_decode($_COOKIE['items']);
        foreach($items as $item)
        {
            array_push($charDataArray, $this->characterParser($swapi->getFromUri($item->url)));
        }
        return $charDataArray;
    }

    // converts character properties to string array
    public function characterParser($character)
    {
        $swapi = new SWAPI;
        $homeplanet="";
        $films="";
        $speciesnames="";
        $starships="";
        $vehicles="";
        if(!is_null($character->homeworld->url))
        {
            $homeplanet=$swapi->getFromUri($character->homeworld->url)->name;
        }
        if(!is_null($character->films))
        {
            foreach($character->films as $film)
            {
                $films .=$swapi->getFromUri($film->url)->title."|";
            }
            $films = substr($films, 0, -1);
        }
        if(!is_null($character->species))
        {
            foreach($character->species as $species)
            {
                $speciesnames .=$swapi->getFromUri($species->url)->name."|";
            }
            $speciesnames = substr($speciesnames, 0, -1);
        }
        if(!is_null($character->starships))
        {
            foreach($character->starships as $starship)
            {
                $starships .=$swapi->getFromUri($starship->url)->name."|";
            }
            $starships = substr($starships, 0, -1);
        }
        if(!is_null($character->vehicles))
        {
            foreach($character->vehicles as $vehicle)
            {
                $vehicles .=$swapi->getFromUri($vehicle->url)->name."|";
            }
            $vehicles = substr($vehicles, 0, -1);
        }
        
        return Array
        (
            "name" => $character->name,
            "birthyear" => $character->birth_year,
            "eyecolour" => $character->eye_color,
            "gender" => $character->gender,
            "haircolour" => $character->hair_color,
            "height(cm)" => (string) $character->height,
            "weight(kg)" => (string) $character->mass,
            "skincolour" => $character->skin_color,
            "homeplanet" => $homeplanet,
            "films" => $films,
            "species" => $speciesnames,
            "starships" => $starships,
            "vehicles" => $vehicles,
        );
    }

    public function downloadAsCsv($filename)
    {
        $data = $this->getRequestedData();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='. $filename);
        ob_end_clean();
        $outstream = fopen("php://output", "w"); 
        // generate csv headers
        fputcsv($outstream, array_keys($data[0]));
        try
        {
            foreach($data as $characterInfo)
            {
                fputcsv($outstream, $characterInfo); 
            } 
        }
        catch (\Exception $e)
        {
             die($e->getMessage());
        }
        //readfile($filename);
        echo $outstream;
        exit();
    }
}
?>