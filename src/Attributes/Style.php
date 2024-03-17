<?php

namespace WebTheory\Html\Attributes;

use Stringable;
use WebTheory\Html\Contracts\HtmlAttributeInterface;

class Style extends AbstractHtmlAttribute implements HtmlAttributeInterface
{
    protected string $name = 'style';

    protected array $value = [];

    public function __construct(iterable $rules = [])
    {
        foreach ($rules as $property => $value) {
            $this->set($property, $value);
        }
    }

    /**
     * @return $this
     */
    public function set(string|Stringable $property, string|float|null|Stringable $value): Style
    {
        $this->value[$property] = $value;

        return $this;
    }

    public function get($style)
    {
        return $this->value[$style];
    }

    /**
     * @return $this
     */
    public function remove($style): Style
    {
        unset($this->value[$style]);

        return $this;
    }

    public function contains($style): bool
    {
        return isset($this->value[$style]);
    }

    public function parse(): string
    {
        $str = '';

        foreach ($this->value as $style => $value) {
            $str .= "{$style}: {$value}; ";
        }

        return rtrim($str, ' ');
    }

    public function tokenize(string $styles): array
    {
        $styles = explode(';', $styles);
        $value = [];

        foreach ($styles as $style) {
            $style = explode(':', $style);

            $value[ltrim($style[0])] = ltrim($style[1]);
        }

        return $value;
    }
}
