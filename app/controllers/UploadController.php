<?php

class UploadController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('oauth', array('on' => 'postIndex'));
	}

	public function postIndex()
	{
		Log::info(Input::all());

		// Settings
		$tmpDir = storage_path().'/uploads/tmp'.DIRECTORY_SEPARATOR;

		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 106000; // Temp file age in seconds
		$postData = Input::all();
		$chunkTotal = (Input::get('chunk_total') - 1);
		$chunkSize = Input::get('chunk_size');
		$chunkID = Input::get('chunk_id');
		$fileSize = Input::get('total_size');
		$fileEnding = Input::get('file_ext');
		$outputPathCount = 1;
		$recordLimit = true;	
		$filename = $postData['filename'].$postData['file_ext'];

		Log::info("Receiving chunk upload", $postData);

		$outputDir = storage_path().'/uploads';
		switch($postData['file_ext']) {
			case '.mp3':
				$outputDir = storage_path().'/uploads/';
				break;
			default:
				return Response::make('Invalid MIME type.', 406);
				break;

		}

		$outputPath = realpath($outputDir).DIRECTORY_SEPARATOR.$filename;
		if($postData['chunk_id'] == 0){
			Log::info('It\'s the first chunk');
			$sermons = Sermon::all()->toArray();
			if (count($sermons) >= 4 && $recordLimit == true) {
				Log::info('Need to clean house a bit...');
				if (unlink(storage_path().'/uploads/'.basename($sermons[0]['filename']))) {
					$id = $sermons[0]['id'];
					$sermon = Sermon::find($id);
					Log::info($sermon->delete());
				}
			}


			while(file_exists($outputPath)){
				$outputPath = realpath($outputDir).DIRECTORY_SEPARATOR.$filename.$outputPathCount.$postData['file_ext'];
				$outputPathCount++;
				Log::info('output-path: '.$outputPath);
			}
		}

		if (!file_exists($tmpDir)) {
			Log::info('Making tmp Directory');
			@mkdir($tmpDir);
		}

		$filePath = $tmpDir . DIRECTORY_SEPARATOR . $filename;

		Log::info('streaming chunk '.$chunkID.' to '.$outputPath);
		$out = fopen($outputPath, "ab");
		$in = fopen($_FILES["file_data"]["tmp_name"],'rb');
		$buff = fread($in,$postData['chunk_size']);
		fwrite($out,$buff);

		$CLI_MODE = true;

		if($CLI_MODE){
			if($postData['chunk_id'] == 0){
				echo "\tUploaded:       ";
			}

			$perc = number_format((($postData['chunk_id']/$postData['chunk_total']) * 100),1);
			$num = strlen($perc) + 2;
			Log::info('Upload '.$perc.'%'.' complete...');
			echo "\033[".$num."D".str_pad($perc.'%', 3, ' ',STR_PAD_LEFT) . ' ';
		}
	}
}