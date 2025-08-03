# Cipher Library

Lightweight PHP 7.4+ library that provides three classic substitution ciphers (Caesar, AtBash, Bacon) behind a common interface.

## Features

- **CaesarCipher** – configurable shift (± ∞) with correct alphabet wrapping
- **AtBashCipher** – simple mirror substitution
- **BaconCipher** – 24-letter Baconian cipher with configurable spacing
- PSR-4 autoloading & strict types
- PHPUnit 9 tests

---


## Installation

```bash
composer install             # in this repo
# or as a dependency
composer require your-vendor/cipher-library
```

> **Requires:** PHP 7.4 or newer.

---


## Quick start

```php
use Cipher\CaesarCipher;
use Cipher\AtBashCipher;
use Cipher\BaconCipher;

$c1 = new CaesarCipher(3);
echo $c1->encrypt('Hello'); // Khoor

echo (new AtBashCipher())->encrypt('abc'); // zyx

echo (new BaconCipher())->encrypt('ABC'); // AAAAA AAAAB AAABA
```

---

## Running the test

```bash
vendor/bin/phpunit
```

