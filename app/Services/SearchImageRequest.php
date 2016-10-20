<?php namespace Redeye\Services;

class SearchImageRequest
{
	private $image;
	private $height;
	private $width;
	private $mode;

	/**
	 * SearchImageRequest constructor.
	 * @param $image
	 * @param $height
	 * @param $width
	 * @param $mode
	 */
	public function __construct($image, $height, $width, $mode)
	{
		$this->image = $image;
		$this->height = $height;
		$this->width = $width;
		$this->mode = $mode;
	}

	/**
	 * @return mixed
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @return mixed
	 */
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * @return mixed
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * @return mixed
	 */
	public function getMode()
	{
		return $this->mode;
	}
}