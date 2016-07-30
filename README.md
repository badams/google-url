[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/badams/google-url/master.svg?style=flat-square)](https://travis-ci.org/badams/google-url)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/badams/google-url.svg?style=flat-square)](https://scrutinizer-ci.com/g/badams/google-url/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/badams/google-url.svg?style=flat-square)](https://scrutinizer-ci.com/g/badams/google-url)

GoogleUrl
====================
#### An easy to use PHP implementation of [Google's URL Shortener API](https://developers.google.com/url-shortener/)

This project aims provide an easy to use implementation of the Google URL shortener API for PHP developers.


## Installation

Install `badams/google-url` using Composer.

```bash
$ composer require badams/google-url
```

## Basic Usage

```php
use badams\GoogleUrl\GoogleUrl;

$url = new GoogleUrl('YOUR_API_KEY_HERE');

// Shorten
echo $url->shorten('https://github.com')->id;
> https://goo.gl/un5E

// Expand
echo $url->expand($short->id)->longUrl;
> https://github.com;
```

## License

GoogleUrl is open-sourced software licensed under the MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

