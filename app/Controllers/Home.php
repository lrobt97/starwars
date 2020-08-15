<?php namespace App\Controllers;
use App\Models\StarwarsModel;
use App\Models\FileDownloadModel;

class Home extends BaseController
{
	public function view($index = 1)
	{
		$model = new StarwarsModel();
		$data['characters'] = $model->getStarWarsCharacters($index);
		$data['page'] = $index;
		echo view('charactersview', $data);
	}

	public function main()
	{
		$model = new StarwarsModel();
		$model->initialiseSessionData();
		$data['pagecount'] = $model->getNumberOfPages();
		$data['page'] = 1;
		echo view('main', $data);
	}

	public function download()
	{
		$download = new FileDownloadModel();
		$data['info'] = $download->getRequestedData();
		$name ="characters".date('YmdHis').".csv";
		$download->downloadAsCsv($name);
	}
}
