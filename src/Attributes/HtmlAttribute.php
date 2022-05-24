<?php

namespace WebTheory\Html\Attributes;

use Stringable;
use WebTheory\Html\Contracts\HtmlAttributeInterface;

class HtmlAttribute extends AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     * @var string|int|float|bool|null|Stringable
     */
    protected $value = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string|int|float|bool|null|Stringable $value
     *
     * @return $this
     */
    public function setValue($value): HtmlAttribute
    {
        $this->value = $value;

        return $this;
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
