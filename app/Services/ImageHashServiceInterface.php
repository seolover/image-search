<?php namespace Redeye\Services;

interface ImageHashServiceInterface
{
	public function hash($image, $size = 8);
}