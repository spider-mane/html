<?php

namespace WebTheory\Html;

use WebTheory\Html\Traits\ElementConstructorTrait;

class Html
{
    use ElementConstructorTrait {
        open as public;
        close as public;
        tag as public;
        parseAttributes as public attributes;
    }
}
