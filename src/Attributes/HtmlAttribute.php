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

    /**
     * @param string|int|null $value
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }

    public function parse(): string
    {
        return (string) $this->value;
    }

    public function tokenize(string $attribute): array
    {
        $split = explode('=', $attribute);
        $attribute = $split[0];
        $value = htmlspecialchars_decode(str_replace('"', '', $split[1] ?? ''));

        return [$attribute => $value];
    }
}
