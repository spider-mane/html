<?php

namespace WebTheory\Html;

class HtmlElement extends AbstractHtmlElement
{
    protected $tag;

    protected $innerHtml = '';

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
