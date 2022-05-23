<?php

namespace WebTheory\Html;

use Exception;

class TagSage
{
    /**
     * Array of self closing tags
     */
    protected static $self_closing = [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'param',
        'source',
        'track',
        'wbr',
    ];

    /**
     * Array of whitespace sensitive tags
     */
    protected static $whitespace_sensitive = [
        'textarea',
    ];

    /**
     * Array of standard HTML5 form elements
     */
    protected static $standard_form_element = [
        'button',
        'datalist',
        'fieldset',
        'input',
        'keygen',
        'label',
        'legend',
        'meter',
        'optgroup',
        'option',
        'progress',
        'select',
        'textarea',
    ];

    /**
     * Array of standard HTML5 input types
     */
    protected static $standard_input_type = [
        'button',
        'checkbox',
        'color',
        'date',
        'datetime-local',
        'email',
        'file',
        'hidden',
        'image',
        'month',
        'number',
        'password',
        'radio',
        'range',
        'reset',
        'search',
        'submit',
        'tel',
        'text',
        'time',
        'url',
        'week',
    ];

    public static function isIt(string $query, string $value): bool
    {
        return in_array($value, static::${$query});
    }

    public static function whatAre(string $these): array
    {
        $values = [
            'self_closing_tags' => static::$self_closing,
            'whitespace_sensitive_tags' => static::$whitespace_sensitive,
            'standard_form_elements' => static::$standard_form_element,
            'standard_input_types' => static::$standard_input_type,
        ];

        $response = $values[$these] ?? null;

        if (!$response) {
            throw new Exception("\"{$these}\" is not a valid inquiry.");
        }

        return $response;
    }
}
