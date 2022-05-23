<?php

namespace WebTheory\Html;

use WebTheory\Html\Attributes\Classlist;
use WebTheory\Html\Attributes\Style;
use WebTheory\Html\Traits\ElementConstructorTrait;

abstract class AbstractHtmlElement
{
    use ElementConstructorTrait;

    /**
     * @var string
     */
    public $id = '';

    /**
     * @var Classlist
     */
    protected $classlist;

    /**
     * @var Style
     */
    protected $styles;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $charset = 'UTF-8';

    public function __construct()
    {
        $this->classlist = new Classlist();
        $this->styles = new Style();
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * @return $this
     */
    public function setCharset($charset): AbstractHtmlElement
    {
        $this->charset = $charset;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return $this
     */
    public function setId(string $id): AbstractHtmlElement
    {
        $this->id = $id;

        return $this;
    }

    public function getClasslist(): Classlist
    {
        return $this->classlist;
    }

    /**
     * @return $this
     */
    public function setClasslist(array $classlist): AbstractHtmlElement
    {
        $this->classlist->set($classlist);

        return $this;
    }

    /**
     * @return $this
     */
    public function addClass(string $class): AbstractHtmlElement
    {
        $this->classlist->add($class);

        return $this;
    }

    /**
     * @return $this
     */
    public function removeClass(string $class): AbstractHtmlElement
    {
        $this->classlist->remove($class);

        return $this;
    }

    public function getStyles(): Style
    {
        return $this->styles;
    }

    /**
     * @return $this
     */
    public function setStyles(array $styles): AbstractHtmlElement
    {
        foreach ($styles as $property => $value) {
            $this->addStyle($property, $value);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addStyle(string $property, string $value): AbstractHtmlElement
    {
        $this->styles->set($property, $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function removeStyle(string $style): AbstractHtmlElement
    {
        $this->styles->remove($style);

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return $this
     */
    public function setAttributes(array $attributes): AbstractHtmlElement
    {
        foreach ($attributes as $key => $value) {
            $this->addAttribute($key, $value);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addAttribute($attribute, $value): AbstractHtmlElement
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    protected function resolveAttributes(): AbstractHtmlElement
    {
        return $this
            ->addAttribute('id', $this->id)
            ->addAttribute('class', $this->classlist->parse())
            ->addAttribute('style', $this->styles->parse());
    }

    public function toHtml(): string
    {
        return $this->resolveAttributes()->renderHtmlMarkup();
    }

    final public function __toString(): string
    {
        return $this->toHtml();
    }

    abstract protected function renderHtmlMarkup(): string;
}
