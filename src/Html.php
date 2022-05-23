<?php

namespace WebTheory\Html;

use WebTheory\Html\Traits\ElementConstructorTrait;

/**
 * @method static string div(string $inner = '', array $attributes = [])
 * @method static string span(string $inner = '', array $attributes = [])
 * @method static string main(string $inner = '', array $attributes = [])
 * @method static string form(string $inner = '', array $attributes = [])
 * @method static string h1(string $inner = '', array $attributes = [])
 * @method static string h2(string $inner = '', array $attributes = [])
 * @method static string h3(string $inner = '', array $attributes = [])
 * @method static string h4(string $inner = '', array $attributes = [])
 * @method static string h5(string $inner = '', array $attributes = [])
 * @method static string h6(string $inner = '', array $attributes = [])
 * @method static string input(array $attributes = [])
 */
class Html
{
    use ElementConstructorTrait {
        tag as public;
        open as public;
        close as public;
        maybeClose as public;
        tagIsVoid as public;
    }

    public static function attributes(array $attributes, bool $trim = true)
    {
        $attributes = static::parseAttributes($attributes);

        return $trim ? ltrim($attributes) : $attributes;
    }

    public static function __callStatic($tag, $args)
    {
        if (static::tagIsVoid($tag)) {
            return static::tag($tag, $args[0] ?? []);
        }

        return static::tag($tag, $args[1] ?? [], $args[0] ?? '');
    }
}
