<?php

use WebTheory\Html\Attributes\ClassList;
use WebTheory\Html\Html;

$age = 24;

$attributes = [
    'id' => $age >= 21 ? 'real-id' : 'fake-id',
    'class' => new ClassList(['dummy-class dummy-class-2']),
];

$content = 'This is a test';

$tag = Html::tag('h1', $attributes, $content);

echo $tag;
var_dump($tag);
echo '<hr>';

################################################################################
#
################################################################################

$h1 = Html::h1('This is a magic test');

echo $h1;
var_dump($h1);
echo '<hr>';

################################################################################
#
################################################################################

$input = Html::input(['type' => 'range']);

echo 'Magic Void Element' . '<br>';
echo $input;
var_dump($input);
echo '<hr>';

################################################################################
#
################################################################################
