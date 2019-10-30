# html

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Clean interface for programmatically creating and manipulating html strings. Useful where desired output depends on various conditions or is otherwise fairly complex, but too brief to justify a template.

This project is still in early development, but probably mostly stable.

## Install

Via Composer

```bash
composer require webtheory/html
```

## Usage

Create one-offs by using the Html static class:

```php
use WebTheory\Html\Html;
use WebTheory\Html\Attributes\ClassList;

$age = 24;

$attributes = [
    'id' => $age >= 21 ? 'real-id' : 'fake-id',
    'class' => new ClassList(['dummy-class dummy-class-2']),
];

$content = 'This is a test';

echo Html::tag('div', $content, $attributes);
```

Or create reusable elements by extending the AbstractHtmlElement class:

```php

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email spider.mane.web@gmail.com instead of using the issue tracker.

## Credits

* [Chris Williams][link-author]
* [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/webtheory/html.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/spider-mane/html/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/spider-mane/html.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/spider-mane/html.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webtheory/html.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/webtheory/html
[link-travis]: https://travis-ci.org/spider-mane/html
[link-scrutinizer]: https://scrutinizer-ci.com/g/spider-mane/html/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/spider-mane/html
[link-downloads]: https://packagist.org/packages/webtheory/html
[link-author]: https://github.com/spider-mane
[link-contributors]: ../../contributors
