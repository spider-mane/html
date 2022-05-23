<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

class HtmlAttribute extends AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $attribute)
    {
        $this->attribute = $attribute;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function parse(): string
    {
        return (string) $this->value;
    }

    public function tokenize(string $attribute): string
    {
        return $attribute;
    }
}
