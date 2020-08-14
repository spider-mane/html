<?php

namespace WebTheory\Html;

use JsonSerializable;

/**
 * @deprecated version 0.2.0
 */
class HtmlMap implements JsonSerializable
{
    /**
     *
     */
    public $map;

    /**
     *
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * Generates an html string from array of element definitions
     *
     * 'tag' => string
     * 'attributes' => array || string
     * 'content' => string
     * 'children' => array
     *
     * @param array $html_map
     * @param bool $recall
     *
     * @return string
     */
    protected function constructHtml($map = null, $recall = false)
    {
        static $markedUp;

        $html = '';

        if (!$recall) {
            $markedUp = [];
        }

        foreach ($map ?? $this->map as $currentElement => $definition) {

            if (in_array($currentElement, $markedUp)) {
                continue;
            }

            // add values already existing as strings to $html as they may already exist as markup
            if (is_object($definition) && method_exists($definition, '__toString') || is_string($definition)) {
                $html .= $definition;
                $markedUp[] = $currentElement;
                continue;
            }

            $html .= Html::open($definition['tag'], $definition['attributes'] ?? '');
            $html .= $definition['content'] ?? '';

            // store children in array to be passed as $html_map argument in recursive call
            if (!empty($children = $definition['children'] ?? null)) {
                foreach ($children as $child) {
                    $childMap[$child] = $this->map[$child];
                }

                $html .= $this->constructHtml($childMap, true);
            }

            $html .= Html::maybeClose($definition['tag']);
            $markedUp[] = $currentElement;
        }

        // reset static variables if in initial call stack
        if (!$recall) {
            $markedUp = null;
        }

        return $html;
    }

    /**
     *
     */
    public function toHtml()
    {
        return $this->constructHtml();
    }

    /**
     *
     */
    public function toJson()
    {
        return json_encode($this);
    }

    /**
     *
     */
    public function jsonSerialize()
    {
        return $this->map;
    }

    /**
     *
     */
    public function __toString()
    {
        return $this->toHtml();
    }
}
