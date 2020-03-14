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
    protected static function parseAttributes($attributesArray, $options)
    {
        return static::parseAttributesRealSwitch($attributesArray, $options);
    }

    /**
     *
     */
    final private static function parseAttributesReal($attributesArray, $options, &$attrStr = '')
    {
        foreach ($attributesArray as $attr => $val) {

            // don't add empty strings or null values
            if ('' === $val || null === $val) {
                continue;
            }

            // simple attribute
            if (is_string($val) || is_numeric($val)) {
                $attrStr .= static::renderAttribute($attr, $val, true, $options);
                continue;
            }

            // support interface for defining custom parsing schemes
            if ($val instanceof HtmlAttributeInterface) {
                $attrStr .= static::renderAttribute($attr, $val->parse(), true, $options);
                continue;
            }

            // boolean attribute
            if ($val === true) {
                $attrStr .= static::renderAttribute($attr, $attr, true, $options);
                continue;
            }

            // treat numerical keys as boolean values
            if (is_int($attr)) {
                $attrStr .= static::renderAttribute($val, $val, true, $options);
                continue;
            }

            // support for passing an array of boolean values
            if ('@boolean' === $attr) {
                foreach ((array) $val as $bool) {
                    $attrStr .= static::renderAttribute($bool, $bool, true, $options);
                }
                continue;
            }

            // support for converting indexed array to DOMTokenList
            if (is_array($val) && isset($val[0])) {
                $val = implode(' ', array_filter($val));
                $attrStr .= static::renderAttribute($attr, $val, true, $options);
                continue;
            }

            // support for converting associative array to DOMStringMap
            if (is_array($val)) {
                foreach ($val as $set => $setval) {
                    static::parseAttributesReal(["{$attr}-{$set}" => $setval], $options, $attrStr);
                }
                continue;
            }
        }

        return ltrim($attrStr);
    }

    /**
     *
     */
    final private static function parseAttributesRealSwitch($attributesArray, $options, &$attrStr = '')
    {
        foreach ($attributesArray as $attr => $val) {

            switch (true) {
                    // don't add empty strings or null values
                case ('' === $val || null === $val):
                    break;

                    // simple attribute
                case (is_string($val) || is_numeric($val)):
                    $attrStr .= static::renderAttribute($attr, $val, true, $options);
                    break;

                    // support interface for defining custom parsing schemes
                case ($val instanceof HtmlAttributeInterface):
                    $attrStr .= static::renderAttribute($attr, $val->parse(), true, $options);
                    break;

                    // boolean attribute
                case ($val === true):
                    $attrStr .= static::renderAttribute($attr, $attr, true, $options);
                    break;

                    // treat numerical keys as boolean values
                case (is_int($attr)):
                    $attrStr .= static::renderAttribute($val, $val, true, $options);
                    break;

                    // support for passing an array of boolean values
                case ('@boolean' === $attr):
                    foreach ((array) $val as $bool) {
                        $attrStr .= static::renderAttribute($bool, $bool, true, $options);
                    }
                    break;

                    // support for converting indexed array to DOMTokenList
                case (is_array($val) && isset($val[0])):
                    $val = implode(' ', array_filter($val));
                    $attrStr .= static::renderAttribute($attr, $val, true, $options);
                    break;

                    // support for converting associative array to DOMStringMap
                case (is_array($val)):
                    foreach ($val as $set => $setval) {
                        static::parseAttributesRealSwitch(["{$attr}-{$set}" => $setval], $options, $attrStr);
                    }
                    break;
            }
        }

        return ltrim($attrStr);
    }

    /**
     *
     */
    protected static function renderAttribute($attribute, $value, $space = false, $options = [])
    {
        $space = $space ? ' ' : '';

        $flags = $options['flags'] ?? null;
        $encode = $options['encoding'] ?? null;

        $value = htmlspecialchars($value, $flags, $encode, false);

        return "{$space}{$attribute}=\"{$value}\"";
    }

    /**
     *
     */
    protected static function open(string $tag, $attributes = null, $options = [])
    {
        $attributes = isset($attributes) ? ' ' . static::parseAttributes($attributes, $options) : '';

        // $newLine = static::newLine($options['new_line'] ?? false);
        // $indentation = static::indentation($options['indentation'] ?? 0);
        $slash = static::trailingSlash($options['trailing_slash'] ?? false, $tag);

        // return "{$indentation}<{$tag}{$attributes}{$slash}>{$newLine}";
        return "<{$tag}{$attributes}{$slash}>";
    }

    /**
     *
     */
    protected static function close(string $tag, $options = [])
    {
        if (TagSage::isIt('self_closing', $tag)) {
            return '';
        }

        // $newLine = static::newLine($options['new_line'] ?? false);
        // $indentation = static::indentation($options['indentation'] ?? 0);

        // return $indentation . $newLine . "</{$tag}>";
        return "</{$tag}>";
    }

    /**
     *
     */
    protected static function tag(string $tag, ?string $content = '', $attributes = null, $options = [])
    {
        return static::open($tag, $attributes, $options) . $content . static::close($tag, $options);
    }

    /**
     *
     */
    protected static function trailingSlash(bool $addTrailingSlash, string $tag)
    {
        return $addTrailingSlash && TagSage::isIt('self_closing', $tag) ? ' /' : '';
    }

    /**
     *
     */
    protected static function indentation(int $levels)
    {
        $indentation = '';

        if ($levels > 0) {
            $indentation = str_repeat('&nbsp;', $levels);
        }

        return $indentation;
    }

    /**
     *
     */
    protected static function newLine(bool $newLine)
    {
        return true === $newLine ? "\n" : '';
    }
}
