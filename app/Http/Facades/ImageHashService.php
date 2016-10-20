<?php namespace Redeye\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Redeye\Services\ImageHashServiceInterface;

class ImageHashService extends Facade
{
	protected static function getFacadeAccessor()
	{
		return ImageHashServiceInterface::class;
	}
}