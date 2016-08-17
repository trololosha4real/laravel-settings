<?php
/**
 * Simple JSON settings for Laravel
 * 
 * @author   Kirill Calkin <hello@nonamez.name>
 * @license  Beerware
 */

namespace NoNameZ\Laravel\Settings;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
	protected $defer = true;

	public function register()
	{
		$this->app->bindShared('NoNameZ\Laravel\Settings\Settings', function($app) {
			return new Settings($app);
		});
	}

	public function provides()
	{
		return array(
			'NoNameZ\Laravel\Settings\Settings',
		);
	}
}
