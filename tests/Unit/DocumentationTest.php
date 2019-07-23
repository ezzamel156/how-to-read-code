<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentationTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_the_documentation_page_for_a_given_version()
    {
        // \File::shouldReceive('exists')->andReturn(true);
        // \File::shouldReceive('get')->once()->with(resource_path('docs/1.0/example.md'))->andReturn('# Example Page for {{version}}');

        $content = (new \App\Documentation)->get('1.0', 'stub', base_path('tests/helpers/stubs'));
        
        

        $this->assertContains('<p>Here is the documentation stub.</p>', $content);
    }

    /**
     * @test
     */
    public function it_throws_exception_when_file_does_not_exists()
    {
        $this->expectException(\Exception::class);

        (new \App\Documentation)->get('1.0', 'example');
    }
}
