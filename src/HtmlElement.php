<?php

namespace WebTheory\Html;

use WebTheory\Html\Contracts\HtmlInterface;

class HtmlElement extends AbstractHtmlElement implements HtmlInterface
{
    protected string $tag;

    protected string $innerHtml = '';

    public function __construct(string $tag, ?string $innerHtml = null)
    {
        $this->tag = $tag;
        $this->innerHtml = $innerHtml ?? $this->innerHtml;

        parent::__construct();
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getInnerHtml(): string
    {
        return $this->innerHtml;
    }

    protected function renderHtmlMarkup(): string
    {
        return $this->tag($this->tag, $this->attributes, $this->innerHtml);
    }
}
