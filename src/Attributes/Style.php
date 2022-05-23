<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

class Style extends AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     *
     */
    public $value = [];

    protected const ATTRIBUTE = 'style';

    /**
     * @return $this
     */
    public function set($style, $value): Style
    {
        $this->value[$style] = $value;

        return $this;
    }

    /**
     *
     */
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

    /**
     *
     */
    public function contains($style)
    {
        return isset($this->value[$style]);
    }

    /**
     *
     */
    public function parse(): string
    {
        $str = '';

        foreach ($this->value as $style => $value) {
            $str .= "{$style}: {$value}; ";
        }

        return rtrim($str, ' ');
    }

    /**
     *
     */
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
