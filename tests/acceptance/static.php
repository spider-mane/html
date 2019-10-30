<?php

use WebTheory\Html\Attributes\ClassList;
use WebTheory\Html\Html;

$age = 24;

$attributes = [
    'id' => $age >= 21 ? 'real-id' : 'fake-id',
    'class' => new ClassList(['dummy-class dummy-class-2']),
];

$content = 'This is a test';

$tag = Html::tag('div', $content, $attributes);

var_dump($tag);
