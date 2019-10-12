# README

The PHP library to access and manage **Subiekt GT Sfera**

## Requirements

- PHP >= 5.2.4
- COM extension (Windows)

## Installation

### Composer (recommended)

```bash
$ composer require asocial-media/subiekt-sfera
```

### Manually

```bash
$ git clone https://github.com/asocial-media/subiekt-sfera.git
```

or just [download zip archive](https://github.com/asocial-media/subiekt-sfera/archive/master.zip)

## Basic usage

```php
/**
 * Used namespaces
 */
use AsocialMedia\Sfera\GT;
use AsocialMedia\Sfera\Program;

// Creating an instance of GT
$gt = new GT('(local)\INSERTGT', 'Test', 'sa', '', 'Szef', 'password123');

// We are going to run Subiekt GT
$subiekt = new Program(
    $gt, 
    Program::SUBIEKT_GT, 
    Program::ADJUST_OPERATOR, 
    Program::RUN_NORMAL
);

// You can also run program in background (no user interface)
$subiekt = new Program(
    $gt, 
    Program::SUBIEKT_GT, 
    Program::ADJUST_OPERATOR, 
    Program::RUN_IN_BACKGROUND
);

// We are now accessing Subiekt Sfera GT and trying to load product with id 1
$subiekt->TowaryManager->Wczytaj(1);

// Available programs:
// Program::SUBIEKT_GT, Program::RACHMISTRZ_GT, Program::REWIZOR_GT
// Program::GRATYFIKANT_GT, Program::MIKRO_GRATYFIKANT_GT, Program::GESTOR_GT, 

// Available adjust modes:
// Program::ADJUST_NORMAL, Program::ADJUST_USERNAME, Program::ADJUST_OPERATOR

// Available running modes:
// Program::RUN_NORMAL, Program::RUN_IF_NOT_BLOCKED, Program::RUN_IN_BACKGROUND
```

## Subiekt Sfera GT Documentation

You can find diagrams, examples and documentation in *.chm file which is
located in Subiekt GT installation directory.

```bash
C:\Program Files (x86)\InsERT\InsERT GT\Pomoc\gta.chm
```

## Authors

- Maciej Strączkowski - <m.straczkowski@gmail.com>

## License

The files in this archive are released under the [MIT LICENSE](LICENSE).
