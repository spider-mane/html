<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

abstract class AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     *
     */
    protected $attribute;

    protected const ATTRIBUTE = null;

    /**
     *
     */
    public function __toString()
    {
        return $this->getAttrStr();
    }

    /**
     *
     */
    public function getAttrStr(): string
    {
        $attr = $this::ATTRIBUTE ?? $this->attrubute;
        $val = $this->parse();

        return "{$attr}=\"{$val}\"";
    }
}
