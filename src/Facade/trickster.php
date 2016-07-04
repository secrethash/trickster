<?php

namespace Secrethash\Trickster\Facade;

use Illuminate\Support\Facades\Facade;

class Trickster extends Facade
{
	public static function getFacadeAccessor()
	{
		return "trickster";	
	}
}