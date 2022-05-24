<?php

namespace WebTheory\Html\Contracts;

use Stringable;

interface HtmlInterface extends Stringable
{
    public function toHtml(): string;
}
