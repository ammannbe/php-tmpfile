# PHP TmpFile

Simple library for **real** temp files and folders

# Prerequisites

- PHP >=7.3
- Linux with command `mktemp`

# Install library

```
composer require ammannbe/tmp-file
```

# Contributing

## Installation

PR's are welcome :-)

```bash
git clone https://github.com/ammannbe/php-tmpfile.git
cd php-tmpfile
composer install
```

## Documentation

Documentation with [phpDocumentor](https://phpdoc.org/)

```bash
composer run docs
```

## Static Code Analysis

[PHPStan](https://phpstan.org/)

```bash
composer run phpstan
```

## Testing

[PHPUnit](https://phpunit.de/)

```bash
composer run tests
```

## Code quality

[PHP Coding Standards Fixer](https://cs.symfony.com/)

```bash
composer run php-cs-fixer
```