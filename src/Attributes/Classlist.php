<?php

namespace WebTheory\Html\Attributes;

use WebTheory\Html\Contracts\HtmlAttributeInterface;

class Classlist extends AbstractHtmlAttribute implements HtmlAttributeInterface
{
    /**
     *
     */
    protected $value = [];

    protected const ATTRIBUTE = 'class';

    /**
     *
     */
    public function __construct($value = [])
    {
        $this->set($value);
    }

    /**
     * @return $this
     */
    public function set($classlist): Classlist
    {
        if (is_string($classlist)) {
            $this->value = $this->tokenize($classlist);
        } elseif (is_array($classlist)) {
            $this->value = $classlist;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function add(string $list): Classlist
    {
        $list = $this->tokenize($list);

        foreach ((array) $list as $class) {
            $this->value[] = $class;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function remove($class): Classlist
    {
        while ($this->contains($class)) {
            unset($this->value[array_search($class, $this->value)]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function toggle($class): Classlist
    {
        if ($this->contains($class)) {
            $this->remove($class);
        } else {
            $this->add($class);
        }

        return $this;
    }

    /**
     *
     */
    public function contains($class)
    {
        return in_array($class, $this->value, false);
    }

    /**
     *
     */
    public function parse(): string
    {
        return implode(' ', (array) $this->value);
    }

    /**
     *
     */
    public function tokenize(string $classlist): array
    {
        return explode(' ', $classlist);
    }
}
