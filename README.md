# README

The PHP library to access and manage **Subiekt GT Sfera**

## Requirements

- PHP >= 5.2.4
- COM extension

## Installation

### Composer (recommended)

```bash
$ composer require zoondo/subiekt-sfera
```

### Manually

```bash
$ git clone https://github.com/zoondo/subiekt-sfera.git
```

or just [download zip archive](https://github.com/zoondo/subiekt-sfera/archive/master.zip)

## Basic usage

```php
/**
 * Used namespaces
 */
use Zoondo\Sfera\GT;
use Zoondo\Sfera\Application\Subiekt;

// Creating an instance of GT
$gt = new GT('(local)\INSERTGT', 'Test', 'sa', '', 'Szef', 'password123');

// We are going to run Subiekt GT
$subiekt = new Subiekt($gt);

// We are now accessing Subiekt Sfera GT
$subiekt->TowaryManager->Wczytaj(1);
```

## Unit testing

To run unit tests just execute the following command

```bash
$ php phpunit.phar ./tests
```

## Authors

- Maciej Strączkowski - <m.straczkowski@gmail.com>

## License

The files in this archive are released under the [MIT LICENSE](LICENSE).
