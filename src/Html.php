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

    public static function __callStatic(string $tag, array $args): string
    {
        if (static::tagIsVoid($tag)) {
            $attributes = $args[0] ?? [];
            $html = static::tag($tag, $attributes);
        } else {
            $inner = $args[0] ?? '';
            $attributes = $args[1] ?? [];
            $html = static::tag($tag, $attributes, $inner);
        }

        return $html;
    }

    public static function attributes(array $attributes, bool $trim = true): string
    {
        $attributes = static::parseAttributes($attributes);

        return $trim ? ltrim($attributes) : $attributes;
    }
}
