<?php

namespace WebTheory\Html\Contracts;

interface HtmlMarkupInterface
{
    /**
     *
     */
    public function toHtml(): string;

    /**
     *
     */
    public function __toString();
}
