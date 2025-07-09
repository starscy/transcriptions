<?php

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Starscy\MyFirstPackage\Line;
use Starscy\MyFirstPackage\Transcription;

class TranscriptionTest extends TestCase
{
    protected Transcription $transcription;
    protected function setUp(): void
    {
        $this->transcription = Transcription::load(
            __DIR__ . '/stubs/basic_example.vtt'
        );
    }

    #[Test]
    public function it_load_a__vtt_file_as_a_string()
    {
         $this->assertStringContainsString(
             'here',
             $this->transcription
         );

         $this->assertStringContainsString(
             'example',
             $this->transcription
         );


    }

    #[Test]
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $lines = $this->transcription->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    #[Test]
    public function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $this->assertStringNotContainsString('WEBVTT', $this->transcription);
        $this->assertCount(2, $this->transcription->lines());

    }

    #[Test]
    public function it_render_the_lines_as_html()
    {
        $this->assertEquals(
            '<a href="?time=00:02">here</a>' . "\n" .
            '<a href="?time=00:04">example</a>',
            $this->transcription->htmlLines()
        );

    }
}
