<?php

namespace WebTheory\Html\Traits;

use WebTheory\Html\Contracts\HtmlAttributeInterface;
use WebTheory\Html\TagSage;

/**
 *
 */
trait ElementConstructorTrait
{
    /**
     *
     */
    protected static function parseAttributes($attributesArray): string
    {
        return static::parseAttributesRealSwitch($attributesArray);
    }

    /**
     *
     */
    protected static function parseAttributesReal($attributesArray, &$attrStr = ''): string
    {
        foreach ($attributesArray as $attr => $val) {

            // don't add empty strings or null values
            if ('' === $val && 'value' !== $attr || null === $val) {
                continue;
            }

            // simple attribute
            if (is_string($val) || is_numeric($val)) {
                $attrStr .= static::renderAttribute($attr, $val, true);
                continue;
            }

            // support interface for defining custom parsing schemes
            if ($val instanceof HtmlAttributeInterface) {
                $attrStr .= static::renderAttribute($attr, $val->parse(), true);
                continue;
            }

            // boolean attribute
            if ($val === true) {
                $attrStr .= static::renderAttribute($attr, $attr, true);
                continue;
            }

            // treat numerical keys as boolean values
            if (is_int($attr)) {
                $attrStr .= static::renderAttribute($val, $val, true);
                continue;
            }

            // support for passing an array of boolean values
            if ('@boolean' === $attr) {
                foreach ((array) $val as $bool) {
                    $attrStr .= static::renderAttribute($bool, $bool, true);
                }
                continue;
            }

            // support for converting indexed array to DOMTokenList
            if (is_array($val) && isset($val[0])) {
                $val = implode(' ', array_filter($val));
                $attrStr .= static::renderAttribute($attr, $val, true);
                continue;
            }

            // support for converting associative array to DOMStringMap
            if (is_array($val)) {
                foreach ($val as $set => $setval) {
                    static::parseAttributesReal(["{$attr}-{$set}" => $setval], $attrStr);
                }
                continue;
            }
        }

        return ltrim($attrStr);
    }

    /**
     *
     */
    protected static function parseAttributesRealSwitch($attributesArray, &$attrStr = ''): string
    {
        foreach ($attributesArray as $attr => $val) {

            switch (true) {
                    // don't add empty strings or null values
                case ('' === $val && 'value' !== $attr || null === $val):
                    break;

                    // simple attribute
                case (is_string($val) || is_numeric($val)):
                    $attrStr .= static::renderAttribute($attr, $val);
                    break;

                    // support interface for defining custom parsing schemes
                case ($val instanceof HtmlAttributeInterface):
                    $attrStr .= static::renderAttribute($attr, $val->parse());
                    break;

                    // boolean attribute
                case ($val === true):
                    $attrStr .= static::renderAttribute($attr, $attr);
                    break;

                    // treat numerical keys as boolean values
                case (is_int($attr)):
                    $attrStr .= static::renderAttribute($val, $val);
                    break;

                    // support for passing an array of boolean values
                case ('@bool' === $attr):
                    foreach ((array) $val as $bool) {
                        $attrStr .= static::renderAttribute($bool, $bool);
                    }
                    break;

                    // support for converting indexed array to DOMTokenList
                case (is_array($val) && isset($val[0])):
                    $val = implode(' ', array_filter($val));
                    $attrStr .= static::renderAttribute($attr, $val);
                    break;

                    // support for converting associative array to DOMStringMap
                case (is_array($val)):
                    foreach ($val as $set => $setval) {
                        static::parseAttributesRealSwitch(["{$attr}-{$set}" => $setval], $attrStr);
                    }
                    break;
            }
        }

        return ltrim($attrStr);
    }

    /**
     *
     */
    protected static function renderAttribute($attribute, $value): string
    {
        $value = static::escAttr($value);

        return " {$attribute}=\"{$value}\"";
    }

    /**
     *
     */
    protected static function escAttr($attribute): string
    {
        return htmlspecialchars($attribute);
    }

    /**
     *
     */
    protected static function tag(string $tag, array $attributes = [], string $inner = ''): string
    {
        return static::open($tag, $attributes) . static::maybeClose($tag, $inner);
    }

    /**
     *
     */
    protected static function open(string $tag, array $attributes = []): string
    {
        $attributes = static::maybeParseAttributes($attributes);
        $slash = static::maybeAddSlash($tag);

        return "<{$tag}{$attributes}{$slash}>";
    }

    /**
     *
     */
    protected static function close(string $tag): string
    {
        return "</{$tag}>";
    }

    /**
     *
     */
    protected static function maybeClose(string $tag, string $inner = ''): string
    {
        return static::tagIsVoid($tag) ? '' : $inner . static::close($tag);
    }

    /**
     *
     */
    protected static function maybeAddSlash(string $tag): string
    {
        return static::tagIsVoid($tag) ? ' /' : '';
    }

    /**
     *
     */
    protected static function maybeParseAttributes(array $attributes): string
    {
        return !empty($attributes) ? ' ' . static::parseAttributes($attributes) : '';
    }

    /**
     *
     */
    protected static function tagIsVoid(string $tag): bool
    {
        return TagSage::isIt('self_closing', $tag);
    }

    /**
     *
     */
    protected static function indentation(int $levels = 0): string
    {
        return str_repeat('&nbsp;', $levels);
    }

    /**
     *
     */
    protected static function newLine(bool $newLine = false): string
    {
        return true === $newLine ? "\n" : '';
    }
}
