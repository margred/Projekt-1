<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$sample = new \HAWMS\Sample();
$sample->increase();
echo sprintf("Increase Sample: %d<br>", $sample->getNum());
$sample->increase();
echo sprintf("Increase Sample: %d<br>", $sample->getNum());
$sample->decrease();
echo sprintf("Decrease Sample: %d<br>", $sample->getNum());
echo sprintf("Result: %d\n", $sample->getNum());
