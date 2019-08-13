# PHP TmpFile
Simple library for **real** temp files and folders


# Prerequisites
 - PHP >=7.3.7
 - Linux with command `mktemp`


# Install library

```
composer require ammannbe/tmp-file
```


# Contributing

## Installation

PR's are welcome :-)

```
git clone https://github.com/ammannbe/php-tmpfile.git
cd php-tmpfile
composer install
```

## Documentation

Documentation with [phpDocumentor](https://phpdoc.org/)
```
wget http://phpdoc.org/phpDocumentor.phar
php phpDocumentor.phar run -d src
```


## Testing

Testing with [PHPUnit](https://phpunit.de/)

```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```
