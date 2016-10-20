<?php namespace Redeye\Repositories;

interface ImageRepositoryInterface
{
	/**
	 * Returns similar image by hash and bit count threshold
	 * @param $hash
	 * @param $minWidth
	 * @param $minHeight
	 * @param int $bitCount
	 * @return mixed
	 */
	public function getSimilarImage($hash, $minWidth, $minHeight, $bitCount = 8);

	/**
	 * Returns similar images by hash and bit count threshold
	 * @param $hash
	 * @param $minWidth
	 * @param $minHeight
	 * @param int $bitCount
	 * @return mixed
	 */
	public function getSimilarImages($hash, $minWidth = null, $minHeight = null, $bitCount = 10);

	/**
	 * Save entity to db
	 * @param $entity
	 * @return mixed
	 */
	public function save($entity);
}