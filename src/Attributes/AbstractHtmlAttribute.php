<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

abstract class AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     * @var string
     */
    protected $attribute;

    protected const ATTRIBUTE = null;

    public function __toString()
    {
        return $this->parse();
    }

    public function getAttrStr(): string
    {
        $attr = $this::ATTRIBUTE ?? $this->attribute;
        $val = $this->parse();

        return "{$attr}=\"{$val}\"";
    }
}
