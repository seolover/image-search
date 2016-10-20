<?php namespace Redeye\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Redeye\Http\Facades\ImageHashService;
use Redeye\Models\Image;
use Redeye\Repositories\ImageRepositoryInterface;

class ImageStorageService implements ImageStorageServiceInterface
{
	private $imageRepository;

	/**
	 * ImageStorageService constructor.
	 * @param $imageRepository
	 */
	public function __construct(ImageRepositoryInterface $imageRepository)
	{
		$this->imageRepository = $imageRepository;
	}

	public function saveToFile($content)
	{
		$result = null;

		$uniqFileName = uniqid(); // enough for test task
		Storage::disk('local')->put($uniqFileName, $content);
		$fileName = storage_path("app/$uniqFileName");
		$result = $fileName;

		list($width, $height) = getimagesize($fileName);

		$hash = ImageHashService::hash($fileName);

		//Magic bit count. Try to find the same image in file store to eliminate duplicates
		$similarImage = $this->imageRepository->getSimilarImage($hash, $width, $height, 2);

		if (!empty($similarImage)) {
			File::delete($fileName);
			$existingFileUUID = $similarImage->uuid;
			$result = storage_path("app/$existingFileUUID");
		} else {
			// Not a duplicate. Save
			$imageEntity = new Image([
				'width' => $width,
				'height' => $height,
				'hash' => $hash,
				'uuid' => $uniqFileName
			]);

			$this->imageRepository->save($imageEntity);
		}

		return $result;
	}
}