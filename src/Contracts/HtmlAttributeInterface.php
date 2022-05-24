<?php

namespace WebTheory\Html\Contracts;

use Stringable;

interface HtmlAttributeInterface extends Stringable
{
    public function parse(): string;

    /**
     * @return null|string|int|float|bool|array
     */
    public function tokenize(string $attribute);

    public function getAttrStr(): string;
}
