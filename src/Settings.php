<?php
/**
 * Simple JSON settings for Laravel
 * 
 * @author   Kirill Calkin <hello@nonamez.name>
 * @license  Beerware
 */

namespace NoNameZ\Laravel\Settings;

use File;

use Illuminate\Foundation\Application;

class Settings
{
	private $_settings = array();
	
	private $_path;
	
	function __construct() {
		if (version_compare(Application::VERSION, '5.0', '>='))
			$this->_path = storage_path('/app/settings');
		else
			$this->_path = storage_path('/settings');
		
		if (is_dir($this->_path) == FALSE)
			mkdir($this->_path, 0777, TRUE);
		
		$files = glob($this->_path . '/*.json');
		
		foreach ($files as $file) {
			$key   = basename($file, '.json');
			
			$value = File::get($file);
			$value = json_decode($value, TRUE);
			$value = is_array($value) ? $value : array();
			
			$this->_settings[$key] = $value;
		}
	}
	
	function __call($name, $arguments)
	{
		$data = call_user_func_array(array($this, 'get'), $arguments);
		
		switch ($name) {
			case 'getInt':
				return (int) $data;
			break;
			case 'getFloat':
				return (float) $data;
			break;
			case 'getString':
				return (string) $data;
			break;
			case 'getBool':
				return (bool) $data;
			break;
			case 'getEmail':
				if (filter_var($data, FILTER_VALIDATE_EMAIL))
					return $data;
				return NULL;
			break;
			case 'getArray':
				if (is_array($data))
					return (array) $data;
				
				return array();
			break;
		}
		
		return $data;
	}
	
	public function get($path, $default = FALSE)
	{
		$settings = array_get($this->_settings, $path, $default);
		
		return $settings;
	}
	
	public function set($path, $value, $save = TRUE)
	{
		array_set($this->_settings, $path, $value);
		
		$keys = explode('.', $path);
		
		if ($save)
			$this->_saveFile($keys[0]);
	}
	
	public function getExcept($file, $except = FALSE)
	{
		return array_except($this->_settings[$file], (array) $except);
	}
	
	private function _saveFile($file)
	{
		$file_path = sprintf('%s/%s.json', $this->_path, $file);
		
		$settings = json_encode($this->_settings[$file]);
		
		File::put($file_path, $settings);
		
		unset($settings);
	}
}