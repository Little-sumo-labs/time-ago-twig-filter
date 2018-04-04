Get Relative Time in Twig
=============

[![Build Status](https://travis-ci.org/Little-sumo-labs/time-ago-twig-filter.svg?branch=master)](https://travis-ci.org/Little-sumo-labs/time-ago-twig-filter)
[![Coverage Status](https://coveralls.io/repos/github/Little-sumo-labs/time-ago-twig-filter/badge.svg?branch=master)](https://coveralls.io/github/Little-sumo-labs/time-ago-twig-filter?branch=master)

Extensions for Twig, giving a date in a more understandable format (e.g. '1 hour ago', 'yesterday', 'tomorrow', 'in 2 weeks')

## Installation
```bash
composer require little-sumo-labs/time-ago-twig-filter
```

## How to Use it
### Import the filter namespace 
```php
use littlesumolabs\timeago\relativeTimerFilter as relativeTimer;
```

### initializing the filter for Twig
```php
$twig->addExtension(new relativeTimer());
```
Or 
```php
$twig->addExtension(new relativeTimer('America/Chicago'));
```

### Creation of 'date' variable, which is injected into the Twig view
```php
echo $twig->render('index.twig', [
    'date'		=> date("d M Y H:i:s"),
    'timer'     => date('d M Y H:i:s', strtotime('-1 hour', strtotime('now'))),
    'timer2'    => date("d M Y H:i:s", strtotime('+1 day', strtotime('now')))
]);
```

### Using the filter in the Twig view
```php
{{ date|relativetimer }} <br />
{{ timer|relativetimer }} <br />
{{ timer2|relativetimer }}
```

### Example of use
[page d'exemple](index.php)

## future developments
* Adding translations for different languages (French, English, Spanish, etc ...)
* ...

## Useful links
### Articles divers
* [Timer relatif](https://www.grafikart.fr/tutoriels/javascript/timer-relatif-800)
* [Créer une date relative en PHP](https://www.dewep.net/realisations/creer-une-date-relative-en-php)
* [Formats supportés de temps et de dates](http://www.php.net/manual/fr/datetime.formats.php)
* [Liste des Fuseaux Horaires Supportés en PHP](http://php.net/manual/fr/timezones.php)

### Documentation Twig
* [Twig for Developers](https://twig.symfony.com/doc/2.x/api.html)
* [Extending Twig](https://twig.symfony.com/doc/2.x/advanced.html)
* [The i18n Extension](http://twig-extensions.readthedocs.io/en/latest/i18n.html)