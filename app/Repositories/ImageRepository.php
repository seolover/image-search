<?php namespace Redeye\Repositories;

use Redeye\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
	public function getSimilarImage($hash, $minWidth = null, $minHeight = null, $bitCount = 10)
	{
		return $this->getSimilarImageQuery($hash, $minWidth, $minHeight, $bitCount)->first();
	}

	public function getSimilarImages($hash, $minWidth = null, $minHeight = null, $bitCount = 10)
	{
		return $this->getSimilarImageQuery($hash, $minWidth, $minHeight, $bitCount)->get();
	}

	private function getSimilarImageQuery($hash, $minWidth, $minHeight, $bitCount)
	{
		$query = Image::whereRaw("BIT_COUNT(hash ^ ?) <= ?", [$hash, $bitCount]);


		if (isset($minWidth)) {
			$query->where('width', '>=', $minWidth);
		}

		if (isset($minHeight)) {
			$query->where('height', '>=', $minHeight);
		}

		return $query;
	}

	public function save($entity)
	{
		// For convention
		return $entity->save();
	}
}