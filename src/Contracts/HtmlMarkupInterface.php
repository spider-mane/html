<?php

namespace WebTheory\Html;

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
