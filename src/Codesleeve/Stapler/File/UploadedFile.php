<?php namespace Codesleeve\Stapler\File;

use Illuminate\Support\Facades\Config as Config;

class UploadedFile extends \Symfony\Component\HttpFoundation\File\UploadedFile
{
	public function canManipulate()
	{
		return ($this->image() || $this->isVide() || $this->isPdf());
	}

	public function isMimeType($extensions)
	{
		$mimes = Config::get('stapler:mimes');
		$mime = $this->getMimeType();
		
		// The MIME configuration file contains an array of file extensions and
		// their associated MIME types.  We will loop through each extension and look for the MIME type.
		foreach ($extensions as $extension)
		{
			if (isset($mimes[$extension]) and in_array($mime, (array) $mimes[$extension]))
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Utility method for detecing whether a given file upload is an image.
	 *
	 * @return bool
	 */
	public function isImage()
	{
		$extensions = ['jpg', 'jpeg', 'gif', 'png'];
		return $this->isMimeType($extensions);
	}
	
	public function isVideo()
	{
		$extensions = ['mpeg', 'mpg', 'mpe', 'qt', 'mov', 'avi', 'movie', 'mp4'];
		return $this->isMimeType($extensions);
	}	

}
