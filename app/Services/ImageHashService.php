<?php namespace Redeye\Services;

use InvalidArgumentException;

class ImageHashService implements ImageHashServiceInterface
{
	public function hash($image, $size = 8)
	{
		$result = '';

		list($w, $h, $t) = getimagesize($image);

		$degradedHigh = $size;
		$degradedWidth = $size + 1;

		$resizedImage = imagecreatetruecolor($degradedWidth, $degradedHigh);
		imagefilter($resizedImage, IMG_FILTER_GRAYSCALE);
		switch($t) {
			case 1:
				$outputImage = imagecreatefromgif($image);
				break;
			case 2:
				$outputImage = imagecreatefromjpeg($image);
				break;
			case 3:
				$outputImage = imagecreatefrompng($image);
				break;
			default:
				$outputImage = null;
		}

		if(empty($outputImage)) {
			throw new InvalidArgumentException('Invalid image format.');
		}

		imagecopyresampled($resizedImage, $outputImage, 0, 0, 0, 0, $degradedWidth, $degradedHigh, $w, $h);
		imagedestroy($outputImage);

		for ($y = 0; $y < $size; $y++) {
			$val = 0;
			for ($x = 0; $x < $size; $x++) {
				$curr = imagecolorat($resizedImage, $x, $y);
				$next = imagecolorat($resizedImage, $x + 1, $y);
				$val .= ($curr > $next) ? 1 : 0;
			}
			$result .= str_pad(dechex(bindec($val)), 2, 0, STR_PAD_LEFT);
		}
		imagedestroy($resizedImage);

		return $result;
	}
}