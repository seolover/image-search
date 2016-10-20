<?php namespace Redeye\Models;

use \Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = 'images';

	protected $guarded = ['id'];
}