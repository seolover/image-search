<?php namespace Redeye\Http\Facades;

use Illuminate\Support\Facades\Facade;
use Redeye\Services\ImageSearchServiceInterface;

class ImageSearchService extends Facade
{
	protected static function getFacadeAccessor()
	{
		return ImageSearchServiceInterface::class;
	}
}