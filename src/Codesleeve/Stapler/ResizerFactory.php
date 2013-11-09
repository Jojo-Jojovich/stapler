<?php namespace Codesleeve\Stapler;

use Codesleeve\Stapler\File\Image\Resizer as ImageResizer;
use Codesleeve\Stapler\File\Video\Resizer as VideoResizer;
use Codesleeve\Stapler\File\Pdf\Resizer as PdfResizer;
use Codesleeve\Stapler\File\Resizer;

use App;


/**
 * Class ResizerFactory
 * Handles File Uploads
 */
class ResizerFactory {

	/**
	 * [saveFile description]
	 *
	 * @return [type] [description]
	 */
	public static function getResizer($file, $imageProcessor) {
		if (!empty($file)) {
			// Need to first check mime type then if it's image or video just do below,
			// if it's application type, check the sub-type, i.e. pdf, to try to process
			// pdf files.  otherwise just return base FileProcessor
			$fileType = ucfirst(strstr($file->getMimeType(), '/', true));
			$resizer = "{$fileType}Resizer";
			var_dump($resizer);
			$dookie = new File\Image\Resizer;
			if (class_exists($resizer)) {
				die('lol');
				return new $resizer($file);
			}
		}
		die('lololol');
		return new File\Resizer($file);
	}
}
