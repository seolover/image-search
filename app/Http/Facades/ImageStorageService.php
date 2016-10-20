<?php namespace Redeye\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Redeye\Services\ImageStorageServiceInterface;

class ImageStorageService extends Facade
{
	protected static function getFacadeAccessor()
	{
		return ImageStorageServiceInterface::class;
	}

}