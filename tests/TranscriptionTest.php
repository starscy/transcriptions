<?php

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Starscy\MyFirstPackage\Line;
use Starscy\MyFirstPackage\Transcription;

class TranscriptionTest extends TestCase
{
    #[Test]
    public function it_load_a__vtt_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/basic_example.vtt';

         $this->assertStringContainsString(
             'here',
             (string)Transcription::load($file)
         );

         $this->assertStringContainsString(
             'example',
             (string)Transcription::load($file)
         );


    }

    #[Test]
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/basic_example.vtt';

        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    #[Test]
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic_example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', (string)$transcription);
        $this->assertCount(2, $transcription->lines());

    }

    #[Test]
    public function it_render_the_lines_as_html()
    {
        $file = __DIR__ . '/stubs/basic_example.vtt';

        $transcription = Transcription::load($file);

        $result = $transcription->htmlLines();

        $this->assertEquals(
            '<a href="?time=00:02">here</a>' . "\n" .
            '<a href="?time=00:04">example</a>',
            $result
        );

    }
}
