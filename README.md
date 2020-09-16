# Cartie

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lpmatrix/cartie.svg?style=flat-square)](https://packagist.org/packages/lpmatrix/cartie)
[![Build Status](https://img.shields.io/travis/lpmatrix/cartie/master.svg?style=flat-square)](https://travis-ci.org/lpmatrix/cartie)
[![Quality Score](https://img.shields.io/scrutinizer/g/lpmatrix/cartie.svg?style=flat-square)](https://scrutinizer-ci.com/g/lpmatrix/cartie)
[![Total Downloads](https://img.shields.io/packagist/dt/lpmatrix/cartie.svg?style=flat-square)](https://packagist.org/packages/lpmatrix/cartie)
[![Made in Nigeria](https://img.shields.io/badge/made%20in-nigeria-008751.svg?style=flat-square)](https://github.com/acekyd/made-in-nigeria)

A clean shopping cart implementation for Laravel. This package uses PSR-4 standard

## Installation

You can install the package via composer:

```bash
composer require lpmatrix/cartie
```

## Usage

### Cartie::add()

``` php
Cartie::add(['id'=>1, 'name'=>'Airforce', 'price'=>150, 'quantity'=>1]);
```

### Cartie::update()

``` php
Cartie::update(['rowid'=>'c9f0f895fb98ab9159f51fd0297e236d', 'quantity'=>2]);
```

### Cartie::remove()

``` php
Cartie::remove('c9f0f895fb98ab9159f51fd0297e236d');
```

### Cartie::clear()

``` php
Cartie::clear();
```

### Cartie::contents()

``` php
Cartie::contents();
```

### Cartie::totalItems()

``` php
Cartie::totalItems();
```

### Cartie::totalPrice()

``` php
Cartie::totalPrice();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mubaraqsanusi908@gmail.com instead of using the issue tracker.

## Credits

- [Sanusi Mubaraq](https://github.com/lpmatrix)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
