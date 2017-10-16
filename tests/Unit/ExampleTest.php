<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Posts;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   //use DatabaseTransactions;

    public function testBasicTest()
    {
        $first = factory(Posts::class)->create();

        $second = factory(Posts::class)->create([
            'created_at'=> \Carbon\Carbon::now()->subMonth()

        ]);

        $posts = Posts::archives();

        /*$this->assertEquals([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('F'),
                "published" => 1
            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('F'),
                "published" => 1
            ]

        ], $posts);*/
        $this->assertCount(2,$posts);
    }
}
