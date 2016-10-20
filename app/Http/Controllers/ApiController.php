<?php namespace Redeye\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Redeye\Http\Facades\ImageSearchService;
use Redeye\Http\Requests\ApiRequest;
use Redeye\Models\ResponseMode;
use Redeye\Presenters\SearchResultPresenter;
use Redeye\Services\SearchImageRequest;

class ApiController extends Controller
{
	public function searchImage(ApiRequest $request)
	{
		$mode = $request->input('mode', ResponseMode::SYNC);
		$minWidth = $request->input('minWidth', 100);
		$minHeight = $request->input('minHeight', 100);

		$result = new SearchResultPresenter(ImageSearchService::search(new SearchImageRequest($request->getImageSource(), $minHeight, $minWidth, $mode)));

		return response($result->present());
	}

	public function getImage($fileUUID)
	{
		$path = storage_path("app/$fileUUID");

		return Response::download($path);
	}
}