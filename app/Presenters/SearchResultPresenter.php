<?php namespace Redeye\Presenters;

class SearchResultPresenter implements PresenterInterface
{
	private $result;

	/**
	 * SearchResultPresenter constructor.
	 * @param $result
	 */
	public function __construct($result)
	{
		$this->result = $result;
	}


	public function present()
	{
		if (empty($this->result)) {
			return [];
		}

		$result = [];
		foreach ($this->result as $item) {
			$value['url'] = action('ApiController@getImage', ['fileUUID' => $item->uuid]);
			$value['height'] = $item->height;
			$value['width'] = $item->width;
			$result[] = $value;
		}


		return $result;
	}
}