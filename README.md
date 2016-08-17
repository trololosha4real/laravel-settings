# Laravel Settings

Simple way to save settings in JSON for Laravel. This repo was made for personal use so no support provided.

## Installation

1. [Install through composer using git repo](https://getcomposer.org/doc/05-repositories.md#git-alternatives)
2. Add `NoNamez\LaravelSettings\ServiceProvider::class` to the array of providers in `config/app.php`.
3. Add `'Setting' => NoNamez\LaravelSettings\Facade::class` to the array of aliases in `config/app.php`.

## Usage

Have in mind that the first element of dotted notation specifies the file name in which it will be stored. For example `Setting::set('foo.bar', 'test');` will create file `foo.json` with `{"bar": "test"}` data.

### Methods

```php
<?php
Setting::set('foo', 'bar');
Setting::get('foo.bar', 'default');
Setting::getInt('foo.bar'); // Type of Integer
Setting::getFloat('foo.bar'); // Type of Float
Setting::getString('foo.bar'); // Type of String
Setting::getBool('foo.bar'); // Type of Bool
Setting::getArray('foo.bar'); // Type of Array
Setting::getEmail('foo.bar'); // Uses "filter_var" t check email. On FALSE return NULL
Setting::getExcept('foo', 'bar'); // Returns everything except "bar"
?>
```

## License

The contents of this repository is released under the "Beerware" license. 

## Contributing

Feel free to do whatever you want as long as you do it in fork. 
