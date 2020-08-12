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
	//	$this->cachePage(60);
	}

	public function main()
	{
		$data['page'] = 1;
		echo view('main', $data);
	//	$this->cachePage(60);
	}

	public function download()
	{
		$download = new FileDownloadModel();
		$data['info'] = $download->getRequestedData();
		$name ="characters".date('Y-m-dHis').".csv";
		$download->downloadAsCsv($name);
		//echo view('download', $data);
	}
}
