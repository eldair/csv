# CSV

Csv is a library to ease parsing, writing and filtering CSV in PHP.
The library goal is to be powerful while remaining lightweight,
by utilizing PHP native classes whenever possible.

## Highlights

-   Easy to use API
-   Read and Write to CSV documents in a memory efficient and scalable way
-   Support PHP stream filtering capabilities
-   Fully documented
-   Fully unit tested
-   Framework-agnostic

## System Requirements

You need the `ext-filter` extension to use `Csv` and the latest stable version of PHP is recommended.

Please find below the PHP support for `Csv` version 9.

| Min. Library Version | Min. PHP Version | Max. Supported PHP Version |
| -------------------- | ---------------- | -------------------------- |
| 9.9.0                | PHP 8.1.2        | PHP 8.x                    |

<!-- ## Install

Install `Csv` using Composer.

```bash
composer require league/csv:^9.0
``` -->

## Configuration

> [!TIP]
> If your CSV document was created or is read on a **Legacy Macintosh computer**, add the following lines before
> using the library to help [PHP detect line ending](http://php.net/manual/en/function.fgetcsv.php#refsect1-function.fgetcsv-returnvalues).

```php
if (!ini_get('auto_detect_line_endings')) {
    ini_set('auto_detect_line_endings', '1');
}
```

> [!WARNING] > **The ini setting is deprecated since PHP version 8.1 and will be removed in PHP 9.0**

## Testing

The library has:

-   a [PHPUnit](https://phpunit.de) test suite.
-   a coding style compliance test suite using [PHP CS Fixer](https://cs.symfony.com/).
-   a code analysis compliance test suite using [PHPStan](https://github.com/phpstan/phpstan).

To run the tests, run the following command from the project folder.

```bash
composer test
```

## Contributing

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](.github/CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email kristijan.novakovic@outlook.com instead of using the issue tracker.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

-   [Kristijan Novaković](https://github.com/eldair)
-   [ignace nyamagana butera](https://github.com/nyamsprod)
-   [All Contributors](https://github.com/thephpleague/csv/graphs/contributors)

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
