<?php

namespace WebTheory\Html\Contracts;

interface HtmlAttributeInterface
{
    public function parse(): string;

    public function tokenize(string $attribute);

    public function getAttrStr(): string;

    public function __toString();
}
