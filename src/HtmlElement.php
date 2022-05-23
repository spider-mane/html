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

    /**
     * Get the value of tag
     *
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Get the value of innerHtml
     *
     * @return mixed
     */
    public function getInnerHtml()
    {
        return $this->innerHtml;
    }

    protected function renderHtmlMarkup(): string
    {
        return $this->tag($this->tag, $this->attributes, $this->innerHtml);
    }
}
