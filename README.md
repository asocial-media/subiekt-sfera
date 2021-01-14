# README

The PHP library to access and manage **Subiekt GT and Navireo Sfera**

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

## Basic usage of GT (Subiekt GT, Rachmistrz GT, Rewizor GT, Gratyfikant GT, Mikro Gratyfikant GT, Gestor GT)

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

## Basic usage of Navireo

```php
/**
 * Used namespaces
 */
use AsocialMedia\Sfera\Navireo;

# Navireo is using *.iqa file instead of logging in
# You can create *.iqa file using "Pulpit Konfiguracyjny" application
# See: Users -> Select user for Sfera purposes -> Create start shortcut

// Creating new instance
$navireo = new Navireo('C:\your-iqa-file.iqa');

// We are now accessing Sfera and trying to load product with id 1
$navireo->TowaryManager->Wczytaj(1);
```

## Sfera Documentation

You can find diagrams, examples and documentation in *.chm file which is
located in Subiekt GT / Navireo installation directory.

```bash
C:\Program Files (x86)\InsERT\InsERT GT\Pomoc\gta.chm
C:\Program Files (x86)\InsERT\Navireo\Pomoc\gta.chm
```

## Authors

- Maciej Strączkowski - <biuro@asocial.media>

## License

The files in this archive are released under the [MIT LICENSE](LICENSE).
