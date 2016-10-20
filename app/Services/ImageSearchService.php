<?php namespace Redeye\Services;

use Illuminate\Support\Facades\File;
use Redeye\Http\Facades\ImageHashService;
use Redeye\Http\Facades\ImageStorageService;
use Redeye\Repositories\ImageRepositoryInterface;

class ImageSearchService implements ImageSearchServiceInterface
{
	private $imageRepository;

	/**
	 * ImageSearchService constructor.
	 * @param $imageRepository
	 */
	public function __construct(ImageRepositoryInterface $imageRepository)
	{
		$this->imageRepository = $imageRepository;
	}

	public function search(SearchImageRequest $searchImageRequest)
	{
		$image = $searchImageRequest->getImage();

		if(empty($image)) {
			return [];
		}

		if(is_string($image)) {
			$content = file_get_contents($image);
		} else {
			$content = File::get($image);
		}

		$fileName = ImageStorageService::saveToFile($content);

		$imageHash = ImageHashService::hash($fileName);

		$images =  $this->imageRepository->getSimilarImages($imageHash, $searchImageRequest->getWidth(), $searchImageRequest->getHeight());

		return $images;
	}
}