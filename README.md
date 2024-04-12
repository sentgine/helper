# Helper

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Latest Stable Version](https://img.shields.io/packagist/v/sentgine/helper.svg)](https://packagist.org/sentgine/helper)
[![Total Downloads](https://img.shields.io/packagist/dt/sentgine/helper.svg)](https://packagist.org/packages/sentgine/helper)

Helper is PHP library providing various helper functions for common tasks.

## Features

- **String Helper Class: Word**: The package includes a versatile string manipulation helper class called `Word`. This class provides a wide range of methods for transforming and manipulating strings, such as converting strings to various casing formats (e.g., PascalCase, kebab-case, snake_case, camelCase, Title Case), extracting substrings, concatenating strings, performing regular expression matches and replacements, converting strings to lowercase or uppercase, trimming whitespace, checking for substring presence, singularizing and pluralizing English words, and more. With the `Word` class, you can streamline common string operations and enhance the efficiency of your PHP projects.

## Requirements
- PHP 8.0 or higher.

## Installation

(1) You can install the package via Composer by running the following command:

```bash
composer require sentgine/helper
```

# Sample Usage of Sentgine\Helper\Word

Below are some examples demonstrating the usage of the `Sentgine\Helper\Word` class for string manipulation operations.

## Basic Usage

```php
use Sentgine\Helper\Word;

// Create a new instance of Word
$word = Word::of('hello world');

// Convert to PascalCase
$result = $word->pascalCase();
// Output: HelloWorld
echo $result;

// Convert to kebab-case
$result = $word->kebabCase();
// Output: hello-world
echo $result;

// Convert to snake_case
$result = $word->snakeCase();
// Output: hello_world
echo $result;

// Convert to camelCase
$result = $word->camelCase();
// Output: helloWorld
echo $result;

// Convert to Title Case
$result = $word->titleCase();
// Output: Hello World
echo $result;

// Sample method chaining
$result = Word::of('hello world')
    ->pascalCase() // Convert to PascalCase
    ->kebabCase()  // Convert to kebab-case
    ->snakeCase()  // Convert to snake_case
    ->camelCase()  // Convert to camelCase
    ->titleCase(); // Convert to Title Case

// Output: Hello World
echo $result;
```

## Changelog
Please see the [CHANGELOG](https://github.com/sentgine/helper/CHANGELOG.md) file for details on what has changed.

## Security
If you discover any security-related issues, please email sentgine@gmail.com instead of using the issue tracker.

## Credits
Helper is built and maintained by Adrian Navaja. Visit my [YOUTUBE](https://www.youtube.com/@sentgine) channel!

## License
The MIT License (MIT). Please see the [LICENSE](https://github.com/sentgine/helper/LICENSE) file for more information.