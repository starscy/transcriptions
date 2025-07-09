<?php

require "vendor/autoload.php";

$path = __DIR__. '/../tests/stubs/basic_example.vtt';

$lines = \Starscy\MyFirstPackage\Transcription::load($path)->lines();

foreach ($lines as $line) {
    var_dump($line->timestamp . ': ' . $line->body);
}
