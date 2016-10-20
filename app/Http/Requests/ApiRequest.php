<?php namespace Redeye\Http\Requests;

class ApiRequest extends Request
{

	public function getImageSource()
	{
		$result = $this->input('url');
		if ($this->hasFile('file')) {
			$result = $this->file('file');
		}

		return $result;
	}

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'url' => 'sometimes',
			'file' => 'sometimes|image'
		];
	}
}