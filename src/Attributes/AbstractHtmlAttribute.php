<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

abstract class AbstractHtmlAttribute implements HtmlAttributeInterface
{
    protected string $name;

    public function __toString(): string
    {
        return $this->parse();
    }

    public function getAttrStr(): string
    {
        return "{$this->name}=\"{$this->parse()}\"";
    }
}
