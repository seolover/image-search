<?php

namespace Redeye\Providers;

use Illuminate\Support\ServiceProvider;
use Redeye\Services\ImageSearchService;
use Redeye\Services\ImageSearchServiceInterface;
use Redeye\Repositories\ImageRepository;
use Redeye\Services\ImageHashService;
use Redeye\Services\ImageHashServiceInterface;
use Redeye\Services\ImageStorageService;
use Redeye\Services\ImageStorageServiceInterface;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(ImageStorageServiceInterface::class, function () {
			return new ImageStorageService(new ImageRepository());
		});

		$this->app->singleton(ImageHashServiceInterface::class, function () {
			return new ImageHashService();
		});

		$this->app->singleton(ImageSearchServiceInterface::class, function() {
			return new ImageSearchService(new ImageRepository());
		});
	}
}
