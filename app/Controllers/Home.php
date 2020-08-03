<?php namespace App\Controllers;
use App\Models\StarwarsModel;

class Home extends BaseController
{
	public function view($index = 1)
	{
		$model = new StarwarsModel();
		$data['characters'] = $model->getStarWarsCharacters($index);
		$data['page'] = $index;
		echo view('charactersview', $data);
		echo view('navbar', $data);
	}
}
