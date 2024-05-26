<?php

use WebTheory\Html\Attributes\Classlist;
use WebTheory\Html\Html;

$age = 24;

$attributes = [
    'id' => $age >= 21 ? 'real-id' : 'fake-id',
    'class' => new Classlist(['dummy-class dummy-class-2']),
];

$content = 'This is a test';

$tag = Html::tag('h1', $attributes, $content);

echo $tag;
echo Html::code(htmlspecialchars($tag));
echo '<hr>';

################################################################################
#
################################################################################

$h1 = Html::h1('This is a magic test', $attributes);

echo $h1;
echo Html::code(htmlspecialchars($h1));
echo '<hr>';

################################################################################
#
################################################################################

$input = Html::input(['type' => 'range']);

echo 'Magic Void Element' . '<br>';
echo $input;
echo '<br>';
echo Html::code(htmlspecialchars($input));
echo '<hr>';

################################################################################
#
################################################################################
