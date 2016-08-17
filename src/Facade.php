<?php
/**
 * Simple JSON settings for Laravel
 * 
 * @author   Kirill Calkin <hello@nonamez.name>
 * @license  Beerware
 */

namespace NoNamez\Laravel\Settings;

class Facade extends \Illuminate\Support\Facades\Facade
{
	protected static function getFacadeAccessor()
	{
		return 'NoNamez\Laravel\Settings\Settings';
	}
}
