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
	//	$this->cachePage(60);
	}

	public function main()
	{
		$data['page'] = 1;
		echo view('navbar', $data);
	//	$this->cachePage(60);
	}
}
